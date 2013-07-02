<?php

namespace Base;

/**
 * @author Daniel Robenek <danrob@seznam.cz>
 */
class Link extends \Nette\Object implements ILink {

	/** @var \Nette\Application\UI\Control */
	protected $control;

	/** @var string */
	protected $destination;

	/** @var array */
	protected $args;

	/** @var array */
	protected $optionalArgs;

	/**
	 * @param \Nette\Application\UI\Control $control Link control
	 * @param string|array $destination Destination like "this", ":Admin:Show:default", or array("update!", "id" => 5)
	 * @param string|array $optionalArgs Arguments that could be specified in create method
	 * 
	 * Examples:
	 * 	new Link($presenter, 'this')->create(); // same as $presenter->link('this')
	 * 	new Link($presenter, array(':Admin:Show:default', 'fullscreen' => true), 'id')->create(5); // same as $presenter->link(':Admin:Show:default', array('fullscreen' => true, 'id' => 5))
	 * 	new Link($presenter, 'sort!', array('column', 'order'))->create('id', 'asc'); // same as $presenter->link('sort!', array('column' => 'id', 'order' => 'asc'))
	 */
	function __construct(\Nette\Application\UI\Control $control, $destination, $optionalArgs = array()) {
		$this->control = $control;
		if (is_array($destination)) {
			$this->destination = array_shift($destination);
			$this->args = $destination;
		} else {
			$this->destination = $destination;
			$this->args = array();
		}
		$this->optionalArgs = (array) $optionalArgs;
	}

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
	public function create() {
		$num = func_num_args();
		if ($num > count($this->optionalArgs))
			throw new \Nette\InvalidArgumentException('Invalid optional args number count');
		$args = $this->args;
		for ($i = 0; $i < $num; $i++)
			$args[$this->optionalArgs[$i]] = func_get_arg($i);

		return $this->control->link($this->destination, $args);
	}

}
