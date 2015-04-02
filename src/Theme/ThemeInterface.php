<?php

namespace ThemeKeeper\Theme;


/**
 * Interface ThemeInterface
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\ThemeKeeper\Utils
 */
interface ThemeInterface {


	public function getThemeDir();

	public function getAssetsDir();

	public function getView($name, $mask, $view = 'default', $suffix = 'latte');
}