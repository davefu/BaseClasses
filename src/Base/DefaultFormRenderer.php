<?php

namespace Base;

use Nette;

/**
 * @author Daniel Robenek <daniel.robenek@me.com>
 */
class DefaultFormRenderer extends \Nette\Forms\Rendering\DefaultFormRenderer {

	/** @var bool Render error messages? */
	protected $renderErrors;

	function __construct($renderErrors = true) {
		$this->renderErrors = $renderErrors;
	}

	public function renderErrors(Nette\Forms\IControl $control = NULL) {
		if ($this->renderErrors) {
			return parent::renderErrors($control);
		}
	}

} 