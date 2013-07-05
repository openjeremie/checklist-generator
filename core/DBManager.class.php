<?php

// This class handle Database connection and is error safe
class DBManager extends PDO {

	// Output the exception catched
	public static function exception_handler($ex) {
		die("PDO : ". $ex->getMessage());
	}

	public function __construct($url, $user='', $pwd='', $opt=array()) {
		set_exception_handler(array(__CLASS__, 'exception_handler'));

		parent::__construct($url, $user, $pwd, $opt);

		restore_exception_handler();
	}
}
