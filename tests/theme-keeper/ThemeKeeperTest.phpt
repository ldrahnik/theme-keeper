<?php

namespace ThemeKeeper\Tests;

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

	function testThemeDir()
	{
		Assert::equal('theme/admin', $this->themes->getTheme('admin')->getThemeDir());
	}

	function testGetView()
	{
		Assert::match('theme/admin/controls/foo/default.latte', $this->themes->getTheme('admin')->getView('foo', 'controls'));
	}

	function testGetDefaultTheme()
	{
		Assert::equal('test', $this->themes->getTheme()->getAssetsDir());
		Assert::equal('test', $this->themes->getAssetsDir());

		Assert::equal('theme/admin', $this->themes->getThemeDir());
		Assert::equal('theme/admin', $this->themes->getTheme()->getThemeDir());

		Assert::match('theme/admin/controls/foo/default.latte', $this->themes->getView('foo', 'controls'));
		Assert::match('theme/admin/controls/foo/default.latte', $this->themes->getTheme()->getView('foo', 'controls'));
	}
}

$test = new ThemeKeeperTest($container);
$test->run();
