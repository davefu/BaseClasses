<?php

namespace Base;

/**
 * @author Daniel Robenek <danrob@seznam.cz>
 */
interface ILink {

	/**
	 * Creates link by definition
	 * @param string optional parameters
	 * @return string
	 * 
	 * Examples:
	 * 	$link->create(5);
	 * 	$link->create();
	 * 	$link->create('parametervalue', 14, $s);
	 */
	function create();
}
