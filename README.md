[![Build Status](https://travis-ci.org/Vyygir/front-end-renderer.svg?branch=master)](https://travis-ci.org/Vyygir/front-end-renderer)

# Front End Renderer #

The Front End Renderer (`FER`)is a set of classes that help you to dynamically generate your 
front-end builds (typically static HTML, CSS, etc) using one entry-point. What this 
means is that your front-end build can act like a dynamically generated system, enabled 
by route definitons in your entry-point.

Any templates or parts that you want to load in are stored in a `templates` directory on 
the root, and any parts in an adjacent `parts` directory. These can then be loaded in 
based on the routes that you've defined.

## Installation ##

There are two options for installing and using `FER` in your project (as per below). 
Bear in mind that, wherever your entry-point file is (e.g. `index.php`) then you'll 
also need a server configuration file in the root (e.g. `.htaccess`) to enable pretty 
links. An example `.htaccess` file has been included in the repository.

### Composer ###
Add `"vyygir/front-end-renderer": "*"` to your `composer.json` required libraries, and 
then run `composer install`.

### Manual ###
Download the repository and copy the `src/FER/` directory into your build. You'll have 
to manually include the files in this folder.

## Options ##

When creating a new `FER` instance, you can also pass in an array of options. The 
current options available are:

| Name          | Type     | Value                                |
| ------------- | -------- | ------------------------------------ |
| templates_dir | `string` | The directory to load templates from |
| paths_dir     | `string` | The directory to load paths from     |

## Examples ##

All of these examples work on the premise that you're using Composer's autoloader.

### Basic ###

```php
<?php
// autoload anything from the installed Composer packages (including FER)
require_once 'vendor/autoload.php';

// create the FER instance
$renderer = new FER\Renderer;

// create the initial route
$renderer->addRoute('/', 'home.php');

// buffer everything loaded in and output it
$renderer->buffer();
echo $renderer->render();
```

### With parts ###

Parts are just additional bits of code that you can load around the main table, like the 
header and footer.

```php
<?php
// autoload anything from the installed Composer packages (including FER)
require_once 'vendor/autoload.php';

// create the FER instance
$renderer = new FER\Renderer;

// create the initial route
$renderer->addRoute('/', 'home.php');

// add the header before the main template, and the footer after
$renderer->addPart('header.php', $renderer::PART_BEFORE);
$renderer->addPart('footer.php', $renderer::PART_AFTER);

// buffer everything loaded in and output it
$renderer->buffer();
echo $renderer->render();
```

### Different directories ###

```php
<?php
// autoload anything from the installed Composer packages (including FER)
require_once 'vendor/autoload.php';

// create the FER instance with options
$renderer = new FER\Renderer(array(
	'templates_dir' => 'build/templates',
	'parts_dir' => 'build/parts'
));

// create the initial route
$renderer->addRoute('/', 'home.php');

// buffer everything loaded in and output it
$renderer->buffer();
echo $renderer->render();
```

## Issues ##

If you run into any issues or bugs, then feel free to create a _concise and 
descriptive_ issue on the issues area of the repository.

## Development ##

Development from my end may be slow and changes changes or updates may be irregular, 
but if you want to request a feature, report an issue, or submit a pull request then 
please feel free to and I'll respond as soon as I'm available to.