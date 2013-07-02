<?php

namespace Base;

/**
 * @author Daniel Robenek <danrob@seznam.cz>
 */
class Form extends \Nette\Application\UI\Form {

	protected $transformErrors = true;

	public function __construct($parent = null, $name = null) {
		parent::__construct($parent, $name);
		$this->monitor('Nette\Application\UI\PresenterComponent');
		$this->setup();
	}

	protected function setup() {
		
	}

	protected function attached($component) {
		parent::attached($component);
		if ($component instanceof \Nette\Application\UI\PresenterComponent) {
			$this->onError[] = callback($this, 'transformErrors');
		}
	}

	public function getTransformErrors() {
		return $this->transformErrors;
	}

	public function setTransformErrors($transformErrors) {
		$this->transformErrors = $transformErrors;
	}

	public function transformErrors() {
		if (!$this->hasErrors() || !$this->transformErrors)
			return;
		$this->transformErrors = false;
		foreach ($this->getErrors() as $error) {
			$this->presenter->flashMessage($error, 'error');
		}
	}

}
