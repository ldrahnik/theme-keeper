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
	private $themes = [];

	public function __construct($themes)
	{
		$this->themes = $themes;
	}

	/**
	 * Return theme with $name or with name 'default', if not set up, return first in order.
	 *
	 * @param $name
	 * @return Theme
	 *
	 * @throws ThemeNotFound
	 * @throws InvalidParameter
	 */
	public function getTheme($name = null)
	{
		if($name === null) {
			return $this->getDefaultTheme();
		} else if ($name === '') {
			throw new InvalidParameter("Invalid parameter name '{$name}'.");
		}
		if(!isset($this->themes[$name])) {
			throw new ThemeNotFound("Theme '{$name}' not found.");
		}
		return $this->themes[$name];
	}

	/**
	 * Support for transition from View-keeper.
	 *
	 * @deprecated Use getTheme() function for get default theme instead.
	 */
	public function getThemeDir()
	{
		$default = $this->getDefaultTheme();
		if(!$default) {
			throw new ThemeNotFound("Default theme not found.");
		}
		return $default->getThemeDir();
	}

	/**
	 * Support for transition from View-keeper.
	 *
	 * @deprecated Use getTheme() function for get default theme instead.
	 */
	public function getAssetsDir()
	{
		$default = $this->getDefaultTheme();
		if(!$default) {
			throw new ThemeNotFound("Default theme not found.");
		}
		return $default->getAssetsDir();
	}

	/**
	 *
	 * Support for transition from View-keeper.
	 *
	 * @deprecated Use getTheme() function for get default theme instead.
	 *
	 * @param $name
	 * @param $mask
	 * @param string $view
	 * @param string $suffix
	 * @return string
	 */
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
	private function getDefaultTheme()
	{
		if(isset($this->themes['default'])) {
			return $this->themes['default'];
		} else if(!empty($this->themes)) {
			return reset($this->themes);
		}
		return null;
	}
}