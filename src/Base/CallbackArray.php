<?php

namespace Base;

/**
 * @author Daniel Robenek <danrob@seznam.cz>
 */
class CallbackArray extends \Nette\Object {

	/** @var \Nette\Callback[] */
	protected $callbacks = array();

	public function add($callback) {
		$this->callbacks[] = callback($callback);
	}

	public function __invoke() {
		$args = func_get_args();
		foreach ($this->callbacks as $callback)
			$callback->invokeArgs($args);
	}

	public function invoke() {
		$args = func_get_args();
		foreach ($this->callbacks as $callback)
			$callback->invokeArgs($args);
	}

}
