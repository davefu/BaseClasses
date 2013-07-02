<?php

namespace Base;

/**
 * @author Daniel Robenek <danrob@seznam.cz>
 */
interface ICrudRepository {

	/**
	 * @return \Nette\Database\Table\Selection
	 */
	function table();

	/**
	 * @return \Nette\Database\Table\Selection
	 */
	function findAll();

	/**
	 * Get row of given ID
	 * @param int $id ID
	 * @return \Nette\Database\Row|false
	 */
	function find($id);

	/**
	 * Creates entity in database
	 * @param array $data
	 * @return \Nette\Database\Row
	 * @throws \Base\RepositoryException
	 */
	function create($data);

	/**
	 * Updates entity in database
	 * @param int $id
	 * @param array $data
	 * @return \Nette\Database\Row
	 * @throws \Base\RepositoryException
	 */
	public function update($id, $data);

	/**
	 * Delete entity from database
	 * @param int $id
	 * @return \Nette\Database\Row
	 * @throws \Base\RepositoryException
	 */
	public function delete($id);
}
