<?php

namespace ThemeKeeper\Theme;

use UrlMatcher\Matcher;
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

	/** @var string */
	private $name;

	public function __construct($name, $config)
	{
		$this->name = $name;
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

	public function getThemeDir()
	{
		return $this->config['themeDir'];
	}

	public function getAssetsDir()
	{
		return $this->config['assetsDir'];
	}

	public function getView($name, $mask, $view = 'default', $suffix = 'latte')
	{
		$mask = $this->getViewKeeper()->getView($name, $mask, $view, $suffix);

		$matcher = new Matcher(
			$mask,
			[
				'theme' => $this->name,
				'assetsDir' => $this->config['assetsDir'],
				'themeDir' => $this->config['themeDir']
			]
		);
		return $matcher->parse();
	}
}