<?php

namespace Base;

/**
 * @author Daniel Robenek <danrob@seznam.cz>
 */
class IP extends \Nette\Object {

	/** @var string */
	protected $binaryIp;

	function __construct($ip) {
		$this->binaryIp = inet_pton($ip);
	}

	/**
	 * Return IPv4/IPv6 address in dot-form (11.55.99.88 or FE80:0000:0000:0000:0202:B3FF:FE1E:8329) 
	 */
	public function getIP() {
		return inet_ntop($this->binaryIp);
	}

	/**
	 * Return IPv4/IPv6 address binary form
	 */
	public function getBinaryIP() {
		return $this->binaryIp;
	}

	/**
	 * Return IPv4/IPv6 address hexa form (8/32 charactets)
	 */
	public function getHexIP() {
		return strtoupper(bin2hex($this->binaryIp));
	}

}
