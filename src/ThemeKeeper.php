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
}