<?php
/**
 * Created by deepoon.com
 * User: xiaobin<zxbin.1990@gmail.com>
 * Date: 16-5-27 下午12:59 
 */
class RedisSession{

	//静态成员变量 保存全局实例
	private static $_instance = null;

	//the redis object
	private $_redis = null;

	//防止外界实例化
	private function __construct($host = '511ad9aaf37c4d7a.m.cnqda.kvstore.aliyuncs.com', $port = 6379, $db = 15)
	{
		if(!extension_loaded('redis'))
		    throw new \Exception("Redis Extension needed!");

		$this->_redis = new Redis();

		//connnect to the redis
		$this->_redis->connect($host, $port) or die("Can't connect to the Redis!");
		$this->_redis->auth("asdQWE123");
	}

	//静态工厂方法 返回此类的唯一实例
	public static function getInstance()
	{
		if(!(self::$_instance instanceof self))
		{
			self::$_instance = new self;
		}
		return self::$_instance;
	}

	/**
	 * 开始使用该驱动的session
	 */
	function init(&$sessionObject,$sessionid=null)
	{
	    //set in my handler
	    ini_set('session.save_handler', 'user');
	    ini_set('session.cookie_domain', '.deepoon.com');
	    session_set_save_handler(
	    	array(&$sessionObject, 'open'),
	        array(&$sessionObject, 'close'),
	        array(&$sessionObject, 'read'),
	        array(&$sessionObject, 'write'),
	        array(&$sessionObject, 'destroy'),
	        array(&$sessionObject, 'gc')
	    );

	    // the following prevents unexpected effects when using objects as save handlers
	    register_shutdown_function('session_write_close');
	    // proceed to set and retrieve values by key from $_SESSION
	    if($sessionid){
	        session_id($sessionid);
	    }
	    session_start();
	    return session_id();
	}

	function setcode($sess_id,$code){
	     $this->_redis->setex($sess_id.'|code',300,$code);
	}
	function getcode($sess_id){
	    return $this->_redis->get($sess_id.'|code');
	}

	function setinfo($sessinfo,$time=3600,$code){
	     $this->_redis->setex($sessinfo,$time,$code);
	}
	function getinfo($sessinfo){
	    return $this->_redis->get($sessinfo);
	}

	function open ($save_path, $session_name)
	    // open the session.
	{
	    // do nothing
	    return TRUE;

	} // open

	function close ()
	    // close the session.
	{
	    return $this->gc();

	} // close

	function read ($session_id)
	    // read any data for this session.
	{
	    return $this->_redis->get($session_id);

	} // read

	function write ($session_id, $session_data)
	    // write session data to redis.
	{
	    $this->_redis->setnx($session_id, $session_data);

	    //Be careful,we must be the life time all right.
	    $this->_redis->expire($session_id, /*get_cfg_var("session.gc_maxlifetime")*/3600 * 2);
	    return TRUE;

	} // write

	function destroy ($session_id)
	    // destroy the specified session.
	{
	    $this->_redis->delete($session_id);
	    return TRUE;

	} // destroy

	function gc ()
	    // perform garbage collection.
	{
	    return TRUE;

	} // gc

	function __destruct ()
	    // ensure session data is written out before classes are destroyed
	    // (see http://bugs.php.net/bug.php?id=33772 for details)
	{
	    @session_write_close();

	} // __destruct

	//创建__clone方法防止对象被复制克隆
	public function __clone()
	{
		trigger_error('Clone is not allow!',E_USER_ERROR);
	}
}