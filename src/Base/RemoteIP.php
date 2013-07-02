<?php

namespace Base;

/**
 * @author Daniel Robenek <danrob@seznam.cz>
 */
class RemoteIP extends IP {

	function __construct() {
		parent::__construct($_SERVER['REMOTE_ADDR']);
	}

}
