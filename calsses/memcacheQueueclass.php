<?php
/**
 * PHP memcache ������
 * @author LKK/lianq.net
 * @create  on 19:22 2014/3/24
 * @version 0.3
 * @�޸�˵��:
 * 1.������֮ǰ��AB����ֵ˼·,ʹ����������Ĺ���,��д�˴���.
 * 2.����Ĭ���Ƚ��ȳ�,�������˷����ȡ����.
 * 3.��л����FoxHunter����ı������.
 * @example:
 * $obj = new memcacheQueue('duilie');
 * $obj->add('1asdf');
 * $obj->getQueueLength();
 * $obj->read(10);
 * $obj->get(8);
 */
class memcacheQueue{
	public static   $client;            //memcache�ͻ�������
	public          $access;            //�����Ƿ�ɸ���
	private         $expire;            //����ʱ��,��,1~2592000,��30����
	private         $sleepTime;         //�ȴ�����ʱ��,΢��
	private         $queueName;         //��������,Ψһֵ
	private         $retryNum;          //���Դ���,= 10 * ���۲�����
	public          $currentHead;       //��ǰ����ֵ
	public          $currentTail;       //��ǰ��βֵ
 
	const   MAXNUM      = 20000;                //��������,��������10K
	const   HEAD_KEY    = '_lkkQueueHead_';     //������kye
	const   TAIL_KEY    = '_lkkQueueTail_';     //����βkey
	const   VALU_KEY    = '_lkkQueueValu_';     //����ֵkey
	const   LOCK_KEY    = '_lkkQueueLock_';     //������key
 
	/**
	 * ���캯��
	 * @param string $queueName  ��������
	 * @param int $expire ����ʱ��
	 * @param array $config  memcache����
	 * 
	 * @return <type>
	 */
	public function __construct($queueName ='',$expire=0,$config =''){
		if(empty($config)){
			self::$client = memcache_pconnect('127.0.0.1',11211);
		}elseif(is_array($config)){//array('host'=>'127.0.0.1','port'=>'11211')
			self::$client = memcache_pconnect($config['host'],$config['port']);
		}elseif(is_string($config)){//"127.0.0.1:11211"
			$tmp = explode(':',$config);
			$conf['host'] = isset($tmp[0]) ? $tmp[0] : '127.0.0.1';
			$conf['port'] = isset($tmp[1]) ? $tmp[1] : '11211';
			self::$client = memcache_pconnect($conf['host'],$conf['port']);
		}
		if(!self::$client) return false;
		 
		ignore_user_abort(true);//���ͻ��Ͽ�����,�������ִ��
		set_time_limit(0);//ȡ���ű�ִ����ʱ����
		 
		$this->access = false;
		$this->sleepTime = 1000;
		$expire = empty($expire) ? 3600 : intval($expire)+1;
		$this->expire = $expire;
		$this->queueName = $queueName;
		$this->retryNum = 1000;
		 
		$this->head_key = $this->queueName . self::HEAD_KEY;
		$this->tail_key = $this->queueName . self::TAIL_KEY;
		$this->lock_key = $this->queueName . self::LOCK_KEY;
		 
		$this->_initSetHeadNTail();
	}
	 
	/**
	 * ��ʼ�����ö�����βֵ
	 */
	private function _initSetHeadNTail(){
		//��ǰ�����׵���ֵ
		$this->currentHead = memcache_get(self::$client, $this->head_key);
		if($this->currentHead === false) $this->currentHead =0;
		 
		//��ǰ����β����ֵ
		$this->currentTail = memcache_get(self::$client, $this->tail_key);
		if($this->currentTail === false) $this->currentTail =0;
	}
	 
	/**
	 * ��ȡ��Ԫ��ʱ,�ı�����׵���ֵ
	 * @param int $step ����ֵ
	 */
	private function _changeHead($step=1){
		$this->currentHead += $step;
		memcache_set(self::$client, $this->head_key,$this->currentHead,false,$this->expire);
	}
	 
	/**
	 * �����Ԫ��ʱ,�ı����β����ֵ
	 * @param int $step ����ֵ
	 * @param bool $reverse �Ƿ���
	 * @return null
	 */
	private function _changeTail($step=1, $reverse =false){
		if(!$reverse){
			$this->currentTail += $step;
		}else{
			$this->currentTail -= $step;
		}
		 
		memcache_set(self::$client, $this->tail_key,$this->currentTail,false,$this->expire);
	}
	 
	/**
	 * �����Ƿ�Ϊ��
	 * @return bool
	 */
	private function _isEmpty(){
		return (bool)($this->currentHead === $this->currentTail);
	}
	 
	/**
	 * �����Ƿ�����
	 * @return bool
	 */
	private function _isFull(){
		$len = $this->currentTail - $this->currentHead;
		return (bool)($len === self::MAXNUM);
	}
	 
	/**
	 * ���м���
	 */
	private function _getLock(){
		if($this->access === false){
			while(!memcache_add(self::$client, $this->lock_key, 1, false, $this->expire) ){
				usleep($this->sleepTime);
				@$i++;
				if($i > $this->retryNum){//���Եȴ�N��
					return false;
					break;
				}
			}
			 
			$this->_initSetHeadNTail();
			return $this->access = true;
		}
		 
		return $this->access;
	}
	 
	/**
	 * ���н���
	 */
	private function _unLock(){
		memcache_delete(self::$client, $this->lock_key, 0);
		$this->access = false;
	}
	 
	/**
	 * ��ȡ��ǰ���еĳ���
	 * �ó���Ϊ���۳���,ĳЩԪ�����ڹ���ʧЧ����ʧ,��ʵ����<=�ó���
	 * @return int
	 */
	public function getQueueLength(){
		$this->_initSetHeadNTail();
		return intval($this->currentTail - $this->currentHead);
	}
		 
	/**
	 * ��Ӷ�������
	 * @param void $data Ҫ��ӵ�����
	 * @return bool
	 */
	public function add($data){
		if(!$this->_getLock()) return false;
		 
		if($this->_isFull()){
			$this->_unLock();
			return false;
		}
		 
		$value_key = $this->queueName . self::VALU_KEY . strval($this->currentTail +1);
		$result = memcache_set(self::$client, $value_key, $data, MEMCACHE_COMPRESSED, $this->expire);
		if($result){
			$this->_changeTail();
		}
		 
		$this->_unLock();
		return $result;
	}
	 
	/**
	 * ��ȡ��������
	 * @param int $length Ҫ��ȡ�ĳ���(�����ȡʹ�ø���)
	 * @return array
	 */
	public function read($length=0){
		if(!is_numeric($length)) return false;
		$this->_initSetHeadNTail();
		 
		if($this->_isEmpty()){
			return false;
		}
		 
		if(empty($length)) $length = self::MAXNUM;//Ĭ������
		$keyArr = array();
		if($length >0){//�����ȡ(�Ӷ����������β)
			$tmpMin = $this->currentHead;
			$tmpMax = $tmpMin + $length;
			for($i= $tmpMin; $i<=$tmpMax; $i++){
				$keyArr[] = $this->queueName . self::VALU_KEY . $i;
			}
		}else{//�����ȡ(�Ӷ���β�������)
			$tmpMax = $this->currentTail;
			$tmpMin = $tmpMax + $length;
			for($i= $tmpMax; $i >$tmpMin; $i--){
				$keyArr[] = $this->queueName . self::VALU_KEY . $i;
			}
		}
		 
		$result = @memcache_get(self::$client, $keyArr);
		 
		return $result;
	}
	 
	/**
	 * ȡ����������
	 * @param int $length Ҫȡ���ĳ���(�����ȡʹ�ø���)
	 * @return array
	 */
	public function get($length=0){
		if(!is_numeric($length)) return false;
		if(!$this->_getLock()) return false;
		 
		if($this->_isEmpty()){
			$this->_unLock();
			return false;
		}
		 
		if(empty($length)) $length = self::MAXNUM;//Ĭ������
		$length = intval($length);
		$keyArr = array();
		if($length >0){//�����ȡ(�Ӷ����������β)
			$tmpMin = $this->currentHead;
			$tmpMax = $tmpMin + $length;
			for($i= $tmpMin; $i<=$tmpMax; $i++){
				$keyArr[] = $this->queueName . self::VALU_KEY . $i;
			}
			$this->_changeHead($length);
		}else{//�����ȡ(�Ӷ���β�������)
			$tmpMax = $this->currentTail;
			$tmpMin = $tmpMax + $length;
			for($i= $tmpMax; $i >$tmpMin; $i--){
				$keyArr[] = $this->queueName . self::VALU_KEY . $i;
			}
			$this->_changeTail(abs($length), true);
		}
		$result = @memcache_get(self::$client, $keyArr);
		 
		foreach($keyArr as $v){//ȡ��֮��ɾ��
			@memcache_delete(self::$client, $v, 0);
		}
		 
		$this->_unLock();
		 
		return $result;
	}
	 
	/**
	 * ��ն���
	 */
	public function clear(){
		if(!$this->_getLock()) return false;
		 
		if($this->_isEmpty()){
			$this->_unLock();
			return false;
		}
		 
		$tmpMin = $this->currentHead--;
		$tmpMax = $this->currentTail++;
 
		for($i= $tmpMin; $i<=$tmpMax; $i++){
			$tmpKey = $this->queueName . self::VALU_KEY . $i;
			@memcache_delete(self::$client, $tmpKey, 0);
		}
		 
		$this->currentTail = $this->currentHead = 0;
		memcache_set(self::$client, $this->head_key,$this->currentHead,false,$this->expire);
		memcache_set(self::$client, $this->tail_key,$this->currentTail,false,$this->expire);
		 
		$this->_unLock();
	}
	 
	/*
	 * �������memcache��������
	 */
	public function memFlush(){
		memcache_flush(self::$client);
	}
 
}//end class