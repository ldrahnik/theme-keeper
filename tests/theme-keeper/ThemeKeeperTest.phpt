<?php

namespace ThemeKeeper\Tests;

use Nette;
use	Tester;
use	Tester\Assert;

$container = require __DIR__ . '/bootstrap.php';

/**
 * Class ThemeKeeperTest
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\ThemeKeeper\Tests
 *
 * @testCase
 */
class ThemeKeeperTest extends Tester\TestCase
{
	/** @var \ThemeKeeper\ThemeKeeper */
	private $themes;

	/** @var /Container */
	private $container;

	public function __construct($container)
	{
		$this->container = $container;
	}

	protected function setUp()
	{
		$this->themes = $this->container->getService('themes.ThemeKeeper');
	}

	function testServiceConfiguration()
	{
		Assert::type('ThemeKeeper\ThemeKeeper', $this->themes);
	}

	function testAssetsDir()
	{
		Assert::equal('test', $this->themes->getTheme('admin')->getAssetsDir());
	}

	function testGetView()
	{
		Assert::match($this->themes->getTheme('admin')->getView('foo', 'controls'), 'test/controls/foo/default.latte');
	}
}

$test = new ThemeKeeperTest($container);
$test->run();
