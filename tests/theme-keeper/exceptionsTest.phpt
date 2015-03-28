<?php

namespace ThemeKeeper\Tests;

use	Tester;
use	Tester\Assert;

$container = require __DIR__ . '/bootstrap.php';

/**
 * Class exceptionTest
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\ThemeKeeper\Tests
 *
 * @testCase
 */
class exceptionsTest extends Tester\TestCase
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

	function testThemeNotFound()
	{
		Assert::exception(function() {
			$this->themes->getTheme('adminn')->getView('foo', 'controls');
		}, 'ThemeKeeper\ThemeNotFound');
	}

	function testInvalidParameter()
	{
		Assert::exception(function() {
			$this->themes->getTheme('')->getView('foo', 'controls');
		}, 'ThemeKeeper\InvalidParameter');
	}
}

$test = new exceptionsTest($container);
$test->run();
