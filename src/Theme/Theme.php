<?php

namespace ThemeKeeper\Theme;

use ViewKeeper\ViewKeeper;

/**
 * Class Arrays
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\ThemeKeeper\Utils
 */
class Theme {

	/** @var ViewKeeper */
	private $viewKeeper;

	/** @var array */
	private $config;

	public function __construct($config)
	{
		$this->config = $config;
	}

	/**
	 * @return ViewKeeper
	 */
	private function getViewKeeper()
	{
		if($this->viewKeeper === null) {
			$this->viewKeeper = new ViewKeeper($this->config['views']);
		}
		return $this->viewKeeper;
	}

	public function getAssetsDir()
	{
		return $this->config['assetsDir'];
	}

	public function getView($name, $mask, $view = 'default', $suffix = 'latte')
	{
		return $this->getViewKeeper()->getView($name, $mask, $view, $suffix);
	}
}