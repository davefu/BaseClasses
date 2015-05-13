<?php

namespace Base;

/**
 * @author Daniel Robenek <danrob@seznam.cz>
 */
abstract class EntityRepository extends \Base\Repository {

	public function getTableName() {
		$tableName = $this->reflection->getName();
		$index = strrpos($tableName, '\\');
		if ($index !== false) {
			$tableName = \Nette\Utils\Strings::substring($tableName, $index + 1);
		}
		return lcfirst($tableName);
	}

	/**
	 * Create table selection for current entity type
	 * @return \Nette\Database\Table\Selection
	 */
	public function table() {
		return $this->conn->table($this->getTableName());
	}

	/**
	 * Create table selection for current entity type
	 * @return \Nette\Database\Table\Selection
	 */
	public function findAll() {
		return $this->table();
	}

	/**
	 * Get row of given ID
	 * @param int $id ID
	 * @return \Nette\Database\Row|false
	 */
	public function find($id) {
		return $this->table()->get($id);
	}

	/**
	 * Creates entity in database
	 * @param array $data
	 * @return \Nette\Database\Row
	 * @throws \Base\RepositoryException
	 */
	public function create($data) {
		$entity = $this->table()->insert($data);
		if ($entity === false)
			throw new RepositoryException(); // todo:
		return $entity;
	}

	/**
	 * Updates entity in database
	 * @param int $id
	 * @param array $data
	 * @return \Nette\Database\Row
	 * @throws \Base\RepositoryException
	 */
	public function update($id, $data) {
		$entity = $this->find($id);
		if ($entity === false)
			throw new RepositoryException('Entity ' . $this->getTableName() . ' with ID ' . $id . ' not found!');
		
		$count = $entity->update($data);
		if ($count === false)
			throw new RepositoryException(); // todo:
		return $entity;
	}

	/**
	 * Delete entity from database
	 * @param int $id
	 * @return \Nette\Database\Row
	 * @throws \Base\RepositoryException
	 */
	public function delete($id) {
		$row = $this->find($id);
		if ($row === false)
			throw new RepositoryException('Entity ' . $this->getTableName() . ' with ID ' . $id . ' not found!');
		$entity = $row->delete();
		if ($entity === false)
			throw new RepositoryException(); // todo:
		return $entity;
	}

}