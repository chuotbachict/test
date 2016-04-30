<?php

class A {
	// public static function who() {
	// 	return __CLASS__;
	// }
	public static function test() {
		echo static::who();
	}
	public static function foo() {
		echo self::who();
	}
}

class B extends A {
	public static function who() {
		return __CLASS__;
	}
	public static function test() {
		parent::foo();
	}
}

class C extends B {
	public static function who() {
		return __CLASS__;
	}
	// public static function test() {
	// 	echo static::who();
	// }
}

C::test();