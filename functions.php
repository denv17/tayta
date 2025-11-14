<?php

/**
 * Tayta Theme Entry Point
 * 
 * @package Tayta
 */

namespace App;

use Timber\Timber;

// Load Composer dependencies
require_once __DIR__ . '/vendor/autoload.php';

// Initialize the framework
require_once __DIR__ . '/src/bootstrap.php';

// Initialize Timber
Timber::init();

// Initialize the application
new TaytaStarter();
