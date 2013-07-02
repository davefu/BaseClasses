<?php

namespace Base;

/**
 * @author Daniel Robenek <danrob@seznam.cz>
 */
interface ITransactionManager {

	function begin();

	function commit();

	function rollback();
}
