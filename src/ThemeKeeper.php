<?php

namespace ThemeKeeper;

use ThemeKeeper\Theme\Theme;

/**
 * Class ViewKeeper
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\ThemeKeeper
 */
class ThemeKeeper
{

	/** @var array */
	private $themes;

	public function __construct($themes)
	{
		$this->themes = $themes;
	}

	/**
	 * @param $name
	 * @return Theme
	 *
	 * @throws ThemeNotFound
	 * @throws InvalidParameter
	 */
	public function getTheme($name)
	{
		if ($name === '') {
			throw new InvalidParameter("Invalid parameter name '{$name}'.");
		}
		if(!isset($this->themes[$name])) {
			throw new ThemeNotFound("Theme '{$name}' not found.");
		}
		return $this->themes[$name];
	}

	public function getThemeDir()
	{
		$default = $this->getDefaultTheme();
		if(!$default) {
			throw new ThemeNotFound("Default theme not found.");
		}
		return $default->getThemeDir();
	}

	public function getAssetsDir()
	{
		$default = $this->getDefaultTheme();
		if(!$default) {
			throw new ThemeNotFound("Default theme not found.");
		}
		return $default->getAssetsDir();
	}

	public function getView($name, $mask, $view = 'default', $suffix = 'latte')
	{
		$default = $this->getDefaultTheme();
		if(!$default) {
			throw new ThemeNotFound("Default theme not found.");
		}
		return $this->getDefaultTheme()->getView($name, $mask, $view, $suffix);
	}

	/**
	 * @return Theme|null
	 */
	public function getDefaultTheme()
	{
		if(isset($this->themes['default'])) {
			return $this->themes['default'];
		} else if(!empty($this->themes)) {
			return reset($this->themes);
		}
		return null;
	}
}