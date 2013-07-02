<?php

namespace Base;

/**
 * @author Daniel Robenek <danrob@seznam.cz>
 */
abstract class Control extends \Nette\Application\UI\Control {

	/** @var string */
	protected $templateFile = null;

	public function __construct(\Nette\ComponentModel\IContainer $parent = NULL, $name = NULL) {
		parent::__construct($parent, $name);
		$this->startup();
	}

	protected function startup() {
		
	}

	public function setTemplateFile($file) {
		$this->templateFile = $file;
	}

	public function setTemplateName($name) {
		$this->templateFile = dirname(\Nette\Reflection\ClassType::from($this)->getFileName()) . '/' . $name . '.latte';
	}

	protected function createTemplate($class = NULL) {
		$template = parent::createTemplate($class);
		$this->setFileToTemplate($template);
		return $template;
	}

	protected function setFileToTemplate($template) {
		if ($this->templateFile !== null && $template instanceof \Nette\Templating\IFileTemplate) {
			$template->setFile($this->templateFile);
		}
	}

	/**
	 * @return \SystemContainer|\Nette\DI\Container 
	 */
	protected function getContext() {
		return $this->getPresenter()->getContext();
	}

	protected function invalidateOrRedirect($snippet = null, $link = 'this') {
		if ($this->presenter->isAjax()) {
			$this->invalidateControl($snippet);
		} else {
			$this->redirect($link);
		}
	}

}
