ldrahnik/theme-keeper
======

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

Example of usage

```sh
themes:
	default:
		themeDir: foo
		assetsDir: foo
		views:
			controls: <themeDir>/<theme>/controls/<name>/<view>
			presenters: <themeDir>/<theme>/presenters/<name>/<view>
			layouts: <themeDir>/<theme>/@<view>
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
    	$this->template->setFile($this->themes->getTheme('admin')->getView($this->name, 'controls'));
		$this->template->render();
    }
```

Is able to set up path via these patterns (don't count patterns through view-keeper - substitution is done successively)
``` sh
	<theme>        	# theme name, 'default' in example usage
	<assetsDir>
	<themeDir>
```


Summary
-------

Template-keeper use View-keeper but still have good use view-keeper as extension, for example Mails templates are the same for entire app.