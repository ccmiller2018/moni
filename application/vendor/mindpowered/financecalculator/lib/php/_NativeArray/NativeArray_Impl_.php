<?php
/**
 * Generated by Haxe 4.1.1
 */

namespace php\_NativeArray;

use \php\Boot;
use \php\_NativeIndexedArray\NativeIndexedArrayIterator;

final class NativeArray_Impl_ {
	/**
	 * @return mixed
	 */
	public static function _new () {
		#/opt/haxe/std/php/NativeArray.hx:33: character 2
		$this1 = [];
		return $this1;
	}

	/**
	 * @param mixed $this
	 * @param bool $key
	 * 
	 * @return mixed
	 */
	public static function getByBool ($this, $key) ;

	/**
	 * @param mixed $this
	 * @param float $key
	 * 
	 * @return mixed
	 */
	public static function getByFloat ($this, $key) ;

	/**
	 * @param mixed $this
	 * @param int $key
	 * 
	 * @return mixed
	 */
	public static function getByInt ($this, $key) ;

	/**
	 * @param mixed $this
	 * @param string $key
	 * 
	 * @return mixed
	 */
	public static function getByString ($this, $key) ;

	/**
	 * @param mixed $this
	 * 
	 * @return NativeIndexedArrayIterator
	 */
	public static function iterator ($this1) {
		#/opt/haxe/std/php/NativeArray.hx:53: characters 10-46
		return new NativeIndexedArrayIterator(array_values($this1));
	}

	/**
	 * @param mixed $this
	 * 
	 * @return NativeArrayKeyValueIterator
	 */
	public static function keyValueIterator ($this1) {
		#/opt/haxe/std/php/NativeArray.hx:56: characters 3-47
		return new NativeArrayKeyValueIterator($this1);
	}

	/**
	 * @param mixed $this
	 * @param bool $key
	 * @param mixed $val
	 * 
	 * @return mixed
	 */
	public static function setByBool ($this, $key, $val) ;

	/**
	 * @param mixed $this
	 * @param float $key
	 * @param mixed $val
	 * 
	 * @return mixed
	 */
	public static function setByFloat ($this, $key, $val) ;

	/**
	 * @param mixed $this
	 * @param int $key
	 * @param mixed $val
	 * 
	 * @return mixed
	 */
	public static function setByInt ($this, $key, $val) ;

	/**
	 * @param mixed $this
	 * @param string $key
	 * @param mixed $val
	 * 
	 * @return mixed
	 */
	public static function setByString ($this, $key, $val) ;
}

Boot::registerClass(NativeArray_Impl_::class, 'php._NativeArray.NativeArray_Impl_');
