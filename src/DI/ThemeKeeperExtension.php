<?php

namespace ThemeKeeper\DI;

use Nette\DI\CompilerExtension;
use ThemeKeeper\Theme\Theme;
use UrlMatcher\Utils\Arrays;


/**
 * Class ThemeKeeperExtension
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\ThemeKeeper\DI
 */
class ThemeKeeperExtension extends CompilerExtension
{
	private $defaults = [
		'themeDir' => null,
		'assetsDir' => null,
		'views' => []
	];

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->getConfig();

		foreach ($config as $name => $configuration) {
			if($configuration) {
				$config[$name] = new Theme($name, Arrays::merge_only_exist_keys($this->defaults, $configuration));
			} else {
				$config[$name] = new Theme($name, $this->defaults);
			}
		}
		$builder->addDefinition($this->prefix('ThemeKeeper'))
			->setClass('ThemeKeeper\ThemeKeeper',
				array($config)
			);
	}
}