<?php

/**
 * Description: Singleton Database
 * @author Mugs and Coffee
 * @written Norberto Q. Libago Jr.
 * @since Friday, March 24, 2013
 * @version 1.0.0
 * 
 *  Instructions:
 *  	1) To call:
 *  			Mdldatabase::get_instance();
 *  	2) global $all_tables  returns all tables i the database
 * 
 */

define('DBSERVER', 'LOCALHOST');
define('DBNAME', 'patternsdb');
define('DBUSER', 'root');
define('DBPASSWORD', '');

class Mdldatabase{
	
	public static $mTables = null;
	private static $instance = null;
	private static $_mConnection = NULL;
	private static $_mIsConnected = false;
	private static $_mError = null;

	/**
	 * This makes the class a singleton
	 */
	private function __construct() {
	}

	/**
	 * Keeps the class unclonable
	 */
	public function __clone() {
	}

	public static function get_instance() {
		if(! self::$instance instanceof self) {
			self::$instance = new self();
		}

		if(self::$_mIsConnected == false)
			self::_connectdb();

		if(self::$_mError != null)
			echo self::$_mError;
		
		if(self::$mTables==null)
			self::_gettables();
			
		return self::$instance;
	}

	private static function _connectdb(){
		self::$_mConnection = mysqli_connect(DBSERVER, DBUSER, DBPASSWORD, DBNAME);

		if ( !mysqli_connect_errno(self::$_mConnection) ){
			self::$_mIsConnected = true;
		}else{
			mysqli_close(self::$_mConnection);
			self::$_mError = mysqli_connect_error();
			self::$_mIsConnected = false;
		}

	}
	
	private static function _gettables(){
		global $all_tables;
		
		if(empty($all_tables))
			$all_tables = self::_generatetables();
		
		
	}
	
	private static function _generatetables(){
		$result = mysqli_query(self::$_mConnection, 'SHOW TABLES FROM `' . DBNAME . '`');

		if(!$result){
			self::$_mError = mysql_error();
			return null;
		}else
			return mysqli_fetch_array($result);
	}
	
	function __destruct(){
		mysqli_close(self::$_mConnection);
	}
}