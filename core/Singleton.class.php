<?php

class Singleton
{
	protected static $instance = null;
	protected function __construct() {}

	protected function __clone() {
		throw new Exception("Can't clone a Singleton");
	}

	public static function getInstance() {
		if (!isset(static::$instance)) {
			static::$instance = new static;
		}
		return static::$instance;
	}
}
