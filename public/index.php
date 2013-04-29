<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
ini_set('display_errors', '0');     # don't show any errors...
error_reporting(E_ALL | E_STRICT);  # ...but do log them
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';

define('BASEDIR', __DIR__ . '/../');

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
