<?php

/**
 * Main template - Index
 * 
 * @package Tayta
 */

$context = Timber\Timber::context();
$context['posts'] = Timber\Timber::get_posts();
$context['is_front_page'] = is_front_page();

Timber\Timber::render('index.twig', $context);
