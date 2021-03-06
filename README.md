### Strongly recommend use [Kappa/ThemesManager](https://github.com/Kappa-org/ThemesManager). ###
If you use `Modules` structure [Kappa/ThemesManager](https://github.com/Kappa-org/ThemesManager) is more effective if not that is still better. Forgot on this package it was just attempt. Is deprecated and will not be more developed.


ldrahnik/~~theme-keeper~~
======

[![Build Status](https://travis-ci.org/ldrahnik/theme-keeper.svg)](https://travis-ci.org/ldrahnik/theme-keeper)
[![Latest stable](https://img.shields.io/packagist/v/ldrahnik/theme-keeper.svg)](https://packagist.org/packages/ldrahnik/theme-keeper)
[![Downloads total](https://img.shields.io/packagist/dt/ldrahnik/theme-keeper.svg?style=flat-square)](https://packagist.org/packages/ldrahnik/theme-keeper)

Keeper of app themes.

Requirements
------------

ldrahnik/theme-keeper requires PHP 5.4 or higher.

- [Nette Framework](https://github.com/nette/nette)
- [view-keeper](https://github.com/ldrahnik/view-keeper)

Installation
------------

Install theme keeper to your project using  [Composer](http://getcomposer.org/):

```sh
$ composer require ldrahnik/theme-keeper
```

Usage
-----

Register extension in config file

```sh
extensions:
	themes: ThemeKeeper\DI\ThemeKeeperExtension
```

Example
-------

```sh
themes:
	default:
		themeDir: %themesDir%/<themeName>
		assetsDir: <themeDir>/assets
		views:
			controls: <themeDir>/controls/<name>/<view>
			presenters: <themeDir>/presenters/<name>/<view>
			layouts: <themeDir>/@<view>
```

```php
	/**
	* @var \ThemeKeeper\ThemeKeeper 
	* @inject 
	*/
	private $themes;
	
	public function __construct(ThemeKeeper\ThemeKeeper $themes)
    {
		$this->themes = $themes;
    }
    
    public function render()
    {
    	$this->template->setFile($this->themes->getView($this->name, 'controls'));
		$this->template->render();
		// you can cast getView without getTheme('default') because default name is automatically default
		// theme for short use as that, if is not set up name 'default', is choosen first theme in order
    }
```

Is able to set up path via these patterns (don't count patterns through view-keeper - substitution is done successively)
``` sh
	<themeName>
	<assetsDir>
	<themeDir>
```

Summary
-------

- Template-keeper uses View-keeper but view-keeper as extension have still good use, for example Mail templates are the same for entire app.
- Crossing from small app with [view-keeper](https://github.com/ldrahnik/view-keeper) to something bigger is not hard because is possible to let code as it's, just use another service.
