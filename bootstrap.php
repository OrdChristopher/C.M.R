<?php
  namespace Application;
  
  $composer = require ( realpath ( __DIR__  . '/protected/vendor/autoload.php' ) );
  
  $bootstrap = new Bootstrap ( true, true );
  
  $bootstrap->doctype ( );
  $bootstrap->html ( );
  $bootstrap->head ( 'Blog Template rendered with XMLWriter:PHP.', array (
    array (
      'name' => 'charset',
      'content' => 'utf-8'
    ),
    array (
      'name' => 'viewport',
      'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no'
    ),
    array (
      'name' => 'description',
      'content' => ''
    ),
    array (
      'name' => 'author',
      'content' => ''
    ),
  ), array (
    array (
      'hypertext_reference' => 'public/css/autoload.css'
    )
  ) );
  $bootstrap->blog ( array (
    array (
      'Technology',
      '#'
    ),
    array (
      'Design',
      '#'
    ),
    array (
      'Business',
      '#'
    ),
    array (
      'Politics',
      '#'
    ),
    array (
      'Science',
      '#'
    ),
    array (
      'Health',
      '#'
    ),
    array (
      'Travel',
      '#'
    )
  ) );