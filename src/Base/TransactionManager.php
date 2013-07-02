<?php

namespace Base;

/**
 * @author Daniel Robenek <danrob@seznam.cz>
 */
class TransactionManager extends \Nette\Object implements \Base\ITransactionManager {

	const TYPE_NONE = 0;
	const TYPE_COMMIT = 1;
	const TYPE_ROLLBACK = 2;

	/** @var \Nette\Database\Connection */
	protected $conn;

	/** @var int Current depth of nested transactions */
	protected $depth = 0;

	/** @var int Last commit/rollback operation type */
	protected $type = self::TYPE_NONE;

	function __construct(\Nette\Database\Connection $conn) {
		$this->conn = $conn;
	}

	public function begin() {
		if ($this->depth === 0) {
			$this->type = self::TYPE_NONE;
			$this->conn->beginTransaction();
		}
		$this->depth++;
	}

	public function commit() {
		if ($this->type === self::TYPE_ROLLBACK) {
			throw new \Nette\NotSupportedException('Nested transactions are not supported!');
		}
		if ($this->depth === 1) {
			$this->conn->commit();
		}
		$this->type = self::TYPE_COMMIT;
		$this->depth--;
	}

	public function rollback() {
		if ($this->depth === 1) {
			$this->conn->rollBack();
		}
		$this->type = self::TYPE_ROLLBACK;
		$this->depth--;
	}

}
