<?php

namespace Base;

/**
 * @author Daniel Robenek <daniel.robenek@me.com>
 */
class TemplatableControl extends \Base\Control {

	protected $templateName = null;
	protected $templatePaths = array();
	protected $templateUrl;

	public function setTemplatePaths(array $paths) {
		$this->templatePaths = $paths;
	}

	public function setTemplatePath($path) {
		$this->templatePaths = array($path);
	}

	public function setTemplateName($name) {
		$this->templateName = $name;
	}

	public function getTemplatePaths() {
		return $this->templatePaths;
	}

	public function setTemplateUrl($templateUrl) {
		$this->templateUrl = $templateUrl;
	}

	protected function setFileToTemplate($template) {
		if (!($template instanceof \Nette\Templating\IFileTemplate)) {
			return;
		}

		$fileNames = array();
		if ($this->templateName !== null) {
			foreach ($this->templatePaths as $path) {
				$fileNames[] = $path . '/' . $this->templateName . '.latte';
			}
			$fileNames[] = dirname(\Nette\Reflection\ClassType::from($this)->getFileName()) . '/' . $this->templateName . '.latte';
		}
		if ($this->templateFile !== null) {
			$fileNames[] = $this->templateFile;
		}

		foreach ($fileNames as $file) {
			if (file_exists($file)) {
				$template->setFile($file);
				if ($this->templateUrl === null) {
					throw new \Nette\InvalidStateException("Template URL not assigned to control {$this->lookupPath('Nette\Application\IPresenter')}!");
				}
				$template->templatePath = $this->templateUrl;
				$template->templateDir = dirname($file);
				return;
			}
		}
		throw new \Nette\InvalidStateException('Non of template files found: ' . implode(', ', $fileNames));
	}

}
