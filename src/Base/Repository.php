<?php

namespace Base;

/**
 * @author Daniel Robenek <danrob@seznam.cz>
 */
abstract class Repository extends \Nette\Object {

	/** @var \Nette\Database\Connection */
	protected $conn;

	function __construct(\Nette\Database\Connection $conn) {
		$this->conn = $conn;
	}

	public function getConnection() {
		return $this->conn;
	}

}
