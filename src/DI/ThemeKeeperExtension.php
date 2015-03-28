<?php

namespace ThemeKeeper\DI;

use Nette\DI\CompilerExtension;
use ThemeKeeper\Theme\Theme;
use ThemeKeeper\Utils\Arrays;


/**
 * Class ThemeKeeperExtension
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\ThemeKeeper\DI
 */
class ThemeKeeperExtension extends CompilerExtension
{
	private $defaults = [
		'assetsDir' => null,
		'filters' => [],
		'views' => []
	];

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->getConfig();

		foreach ($config as $name => $configuration) {
			$config[$name] = new Theme(Arrays::merge($configuration, $this->defaults));
		}
		$builder->addDefinition($this->prefix('ThemeKeeper'))
			->setClass('ThemeKeeper\ThemeKeeper',
				array($config)
			);
	}
}