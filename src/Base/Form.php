<?php

namespace Base;

use Nette\Forms\IFormRenderer;

/**
 * @author Daniel Robenek <danrob@seznam.cz>
 */
class Form extends \Nette\Application\UI\Form {

	/** @var bool Transform errors into presenter flash messages? */
	protected $transformErrors = true;

	/** @var bool Were errors transformed? */
	protected $errorsTransformed = false;

	/** @var IFormRenderer */
	protected $renderer;

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

	/**
	 * Sets form renderer.
	 * @return self
	 */
	public function setRenderer(IFormRenderer $renderer = null) {
		$this->renderer = $renderer;
		return $this;
	}


	/**
	 * Returns form renderer.
	 * @return IFormRenderer
	 */
	public function getRenderer() {
		if ($this->renderer === NULL) {
			$this->renderer = new DefaultFormRenderer(!$this->transformErrors);
		}
		return $this->renderer;
	}


	public function transformErrors() {
		if (!$this->hasErrors() || !$this->transformErrors || $this->errorsTransformed) {
			return;
		}
		$this->errorsTransformed = true;
		foreach ($this->getErrors() as $error) {
			$this->presenter->flashMessage($error, 'error');
		}
	}

}
