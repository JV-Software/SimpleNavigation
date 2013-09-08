## Simple Navigation for PHP

[![Build Status](https://travis-ci.org/JV-Software/SimpleNavigation.png?branch=master)](https://travis-ci.org/JV-Software/SimpleNavigation)

Super simple class for rendering navigation from an array of items.

### Installation

#### With Composer

Simply require the library on your `composer.json` file:

```
"require": {
    "jvs/simplenavigation": "dev-master"
}
```

And run `composer install` or `composer update` if you already installed some
packages.

#### Without Composer

1. Download the zip file
2. Extract to your project folder
3. Make sure to require the main class `require_once 'lib/JVS/SimpleNavigation.php';`

### Usage

`SimpleNavigation` provides a simple `make` function that expects an array with the menu items you want to render, it can be a simple array:

```php
$simpleNav = new JVS\SimpleNavigation;
$navItems = array('Home', 'About Us', 'Blog');

echo $simpleNav->make($navItems);
```

Which outputs:

```html
<ul>
    <li><a href="#">Home</a></li>
    <li><a href="#">About Us</a></li>
    <li><a href="#">Blog</a></li>
</ul>
```

A multi-dimensional array with key/value pairs representing the label and url of the item:

```php
$simpleNav = new JVS\SimpleNavigation;
$navItems = array(
    'Home'     => 'http://www.example.com/',
    'About Us' => 'http://www.example.com/about.php',
    'Blog'     => 'http://www.example.com/blog.php',
);

echo $simpleNav->make($navItems);
```

Which outputs:

```html
<ul>
    <li><a href="http://www.example.com/">Home</a></li>
    <li><a href="http://www.example.com/about.php">About Us</a></li>
    <li><a href="http://www.example.com/blog.php">Blog</a></li>
</ul>
```

Or a fully nested array of arrays:

```php
$simpleNav = new JVS\SimpleNavigation;
$navItems = array(
    'Home'     => 'http://www.example.com/',
    'About Us' => array(
        'Our Company' => 'http://www.example.com/about/company.php',
        'Our Team'    => 'http://www.example.com/about/team.php',
    ),
    'Blog'     => 'http://www.example.com/blog.php',
);

echo $simpleNav->make($navItems);
```

Which outputs:

```html
<ul>
    <li><a href="http://www.example.com/">Home</a></li>
    <li>
        <a href="http://www.example.com/about.php">About Us</a>
        <ul>
            <li><a href="http://www.example.com/about/company.php"></a></li>
            <li><a href="http://www.example.com/about/team.php"></a></li>
        </ul>  
    </li>
    <li><a href="http://www.example.com/blog.php">Blog</a></li>
</ul>
```

That's all there is to it for now.

### Contributing

Feel free to submit bugs or pull requests, just make sure to include unit tests if relevant.
