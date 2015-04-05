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
class Theme implements ThemeInterface {

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
		return $this->parseMask($this->config['themeDir']);
	}

	public function getAssetsDir()
	{
		return $this->parseMask($this->config['assetsDir']);
	}

	public function getView($name, $mask, $view = 'default', $suffix = 'latte')
	{
		return $this->parseViewMask($this->getViewKeeper()->getView($name, $mask, $view, $suffix));
	}

	private function parseMask($mask)
	{
		$matcher = new Matcher(
			$mask,
			[
				'themeName' => $this->name
			]
		);
		return $matcher->parse();
	}

	private function parseViewMask($mask)
	{
		$matcher = new Matcher(
			$mask,
			[
				'themeName' => $this->name,
				'themeDir' => $this->getThemeDir(),
				'assetsDir' => $this->getAssetsDir()
			]
		);
		return $matcher->parse();
	}

}