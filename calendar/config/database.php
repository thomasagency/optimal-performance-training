<?php
class Database {
	private static $host 		= 'localhost';
	private static $database 	= 'timetable_db'; 
	private static $username 	= 'root';
	private static $password 	= 'root';
	
	private static $cont = null;
	
	// Init
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	// Connect DB
	public static function connect() {
		if ( null == self::$cont ) {      
			try {
				self::$cont = new PDO('mysql:host=' . self::$host . ';' . 'dbname=' . self::$database, self::$username, self::$password);  
			} catch(PDOException $e) {
				die($e->getMessage());  
			}
		}

		return self::$cont;
	}
	
	// Disconnect DB
	public static function disconnect() {
		self::$cont = null;
	}
}
?>