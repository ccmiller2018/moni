<?php
/**
 * Generated by Haxe 4.1.1
 */

namespace haxe\ds\_List;

use \php\_Boot\HxAnon;
use \php\Boot;

class ListKeyValueIterator {
	/**
	 * @var ListNode
	 */
	public $head;
	/**
	 * @var int
	 */
	public $idx;

	/**
	 * @param ListNode $head
	 * 
	 * @return void
	 */
	public function __construct ($head) {
		#/opt/haxe/std/haxe/ds/List.hx:300: characters 3-19
		$this->head = $head;
		#/opt/haxe/std/haxe/ds/List.hx:301: characters 3-15
		$this->idx = 0;
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/opt/haxe/std/haxe/ds/List.hx:305: characters 3-22
		return $this->head !== null;
	}

	/**
	 * @return object
	 */
	public function next () {
		#/opt/haxe/std/haxe/ds/List.hx:309: characters 3-23
		$val = $this->head->item;
		#/opt/haxe/std/haxe/ds/List.hx:310: characters 3-19
		$this->head = $this->head->next;
		#/opt/haxe/std/haxe/ds/List.hx:311: characters 3-34
		return new HxAnon([
			"value" => $val,
			"key" => $this->idx++,
		]);
	}
}

Boot::registerClass(ListKeyValueIterator::class, 'haxe.ds._List.ListKeyValueIterator');