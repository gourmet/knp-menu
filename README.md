# KnpMenu

[![Build Status](https://travis-ci.org/gourmet/knp-menu.svg?branch=master)](https://travis-ci.org/gourmet/knp-menu)
[![Total Downloads](https://poser.pugx.org/gourmet/knp-menu/downloads.svg)](https://packagist.org/packages/gourmet/knp-menu)
[![License](https://poser.pugx.org/gourmet/knp-menu/license.svg)](https://packagist.org/packages/gourmet/knp-menu)

Use [KnpMenu] with [CakePHP 3].

## What's included?

- MenuComponent
- MenuHelper

## Install

Using [Composer]:

```
composer require gourmet/knp-menu:~0.4
```

You then need to load the plugin. In `boostrap.php`, something like:

```php
\Cake\Core\Plugin::load('Gourmet/KnpMenu');
```

and add the following to your `App\Controller\AppController`:

```php
public $components = ['Gourmet/KnpMenu.Menu'];
public $helpers = ['Gourmet/KnpMenu.Menu'];
```

## Usage

It's fairly simple. The concept is you `get` a menu, and you `addChild` to it from anywhere at anytime at the
controller or view layer. At the view layer, you can also render any defined menu.

### Get a menu

```php
$menu = $this->Menu->get('my_menu');
```

### Add child to menu

```php
// using an array for URL and child's name as title
$menu->addChild('Dashboard', ['uri' => ['controller' => 'Users', 'action' => 'dashboard']]);
// using a named route for URL and custom title
$menu->addChild('Dashboard', ['route' => 'dashboard', 'label' => 'My Account']);
```
### Render a menu

*Only available at the view layer*

```php
// by default, renders as a list
echo $this->Menu->render('my_menu');
```

Of course, you can set your own renderer (defaults to `\Gourmet\KnpMenu\Menu\Renderer\ListRenderer`) and
matcher (defaults to `\Gourmet\KnpMenu\Menu\Matcher\Matcher`) by passing them as options:

```php
echo $this->Menu->render('my_menu', [
    'matcher' => '\Custom\Matcher',
    'renderer' => new \Custom\Renderer(...)
]);
```

For more, please check the official [KnpMenu] repo and documentation.

## Patches & Features

* Fork
* Mod, fix
* Test - this is important, so it's not unintentionally broken
* Commit - do not mess with license, todo, version, etc. (if you do change any, bump them into commits of
their own that I can ignore when I pull)
* Pull request - bonus point for topic branches

## Bugs & Feedback

http://github.com/gourmet/knp-menu/issues

## License

Copyright (c) 2015, Jad Bitar and licensed under [The MIT License][mit].

[CakePHP 3]:http://cakephp.org
[Composer]:http://getcomposer.org
[mit]:http://www.opensource.org/licenses/mit-license.php
[KnpMenu]:https://github.com/KnpLabs/KnpMenu
