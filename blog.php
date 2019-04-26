<?php
  namespace Application;
  
  $composer = require ( realpath ( __DIR__  . '/protected/vendor/autoload.php' ) );
  
  $xmlwriter = new \XMLWriter ( );
  $xmlwriter->openURI ( 'php://output' );
  $xmlwriter->setIndent ( true );
  $xmlwriter->writeDtd ( 'html' ); //doctype
  $xmlwriter->startElement ( 'html' );
    $xmlwriter->writeAttribute ( 'lang', 'en' );
    
    function meta ( $name, $content ) {
      global $xmlwriter;
      
      $xmlwriter->startElement ( 'meta' );
        $xmlwriter->writeAttribute ( 'name', $name );
        $xmlwriter->writeAttribute ( 'content', $content );
      $xmlwriter->endElement ( ); //meta
    }
    
    function head ( $charset, $viewport, $description, $author, $title ) {
      global $xmlwriter;
      
      $xmlwriter->startElement ( 'head' );
        $xmlwriter->writeComment ( 'Meta Data' );
        meta ( 'charset', $charset );
        meta ( 'viewport', $viewport );
        meta ( 'description', $description );
        meta ( 'author', $author );
        $xmlwriter->startElement ( 'title' );
          $xmlwriter->text ( $title );
        $xmlwriter->endElement ( ); //title
        $xmlwriter->writeComment ( 'CSS' );
        $xmlwriter->startElement ( 'link' );
          $xmlwriter->writeAttribute ( 'rel', 'stylesheet' );
          $xmlwriter->writeAttribute ( 'href', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' );
          $xmlwriter->writeAttribute ( 'integrity', 'sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' );
          $xmlwriter->writeAttribute ( 'crossorigin', 'anonymous' );
        $xmlwriter->endElement ( ); //link
        $xmlwriter->startElement ( 'link' );
          $xmlwriter->writeAttribute ( 'rel', 'stylesheet' );
          $xmlwriter->writeAttribute ( 'href', 'http://getbootstrap.com/docs/4.1/examples/blog/blog.css' );
        $xmlwriter->endElement ( ); //link
        $xmlwriter->startElement ( 'link' );
          $xmlwriter->writeAttribute ( 'rel', 'stylesheet' );
          $xmlwriter->writeAttribute ( 'href', 'https://fonts.googleapis.com/css?family=Playfair+Display:700,900' );
        $xmlwriter->endElement ( ); //link
      $xmlwriter->endElement ( ); //head
    }
    
    head ( 'utf-8', 'width=device-width, initial-scale=1, shrink-to-fit=no', '', '', 'Blog Template rendered with XMLWriter:PHP.' );
    
    $xmlwriter->startElement ( 'body' );
      $xmlwriter->startElement ( 'div' );
        $xmlwriter->writeAttribute ( 'class', 'container' );
        $xmlwriter->startElement ( 'header' );
          $xmlwriter->writeAttribute ( 'class', 'blog-header py-3' );
          $xmlwriter->startElement ( 'div' );
            $xmlwriter->writeAttribute ( 'class', 'row flex-nowrap justify-content-between align-items-center' );
            $xmlwriter->startElement ( 'div' );
              $xmlwriter->writeAttribute ( 'class', 'col-4 pt-1' );
              $xmlwriter->startElement ( 'a' );
                $xmlwriter->writeAttribute ( 'class', 'text-muted' );
                $xmlwriter->writeAttribute ( 'href', '#' );
                $xmlwriter->text ( 'Subscribe' );
              $xmlwriter->endElement ( ); //a
            $xmlwriter->endElement ( ); //div
            $xmlwriter->startElement ( 'div' );
              $xmlwriter->writeAttribute ( 'class', 'col-4 text-center' );
              $xmlwriter->startElement ( 'a' );
                $xmlwriter->writeAttribute ( 'class', 'blog-header-logo text-dark' );
                $xmlwriter->writeAttribute ( 'href', '#' );
                $xmlwriter->text ( 'Large' );
              $xmlwriter->endElement ( ); //a
            $xmlwriter->endElement ( ); //div
            $xmlwriter->startElement ( 'div' );
              $xmlwriter->writeAttribute ( 'class', 'col-4 d-flex justify-content-end align-items-center' );
              $xmlwriter->startElement ( 'a' );
                $xmlwriter->writeAttribute ( 'class', 'text-muted' );
                $xmlwriter->writeAttribute ( 'href', '#' );
                $xmlwriter->startElement ( 'svg' );
                  $xmlwriter->writeAttribute ( 'xmlns', 'http://www.w3.org/2000/svg' );
                  $xmlwriter->writeAttribute ( 'width', '20' );
                  $xmlwriter->writeAttribute ( 'height', '20' );
                  $xmlwriter->writeAttribute ( 'viewBox', '0 0 24 24' );
                  $xmlwriter->writeAttribute ( 'fill', 'none' );
                  $xmlwriter->writeAttribute ( 'stroke', 'currentColor' );
                  $xmlwriter->writeAttribute ( 'stroke-width', '2' );
                  $xmlwriter->writeAttribute ( 'stroke-linecap', 'round' );
                  $xmlwriter->writeAttribute ( 'stroke-linejoin', 'round' );
                  $xmlwriter->writeAttribute ( 'class', 'mx-3' );
                  $xmlwriter->startElement ( 'circle' );
                    $xmlwriter->writeAttribute ( 'cx', '10.5' );
                    $xmlwriter->writeAttribute ( 'cy', '10.5' );
                    $xmlwriter->writeAttribute ( 'r', '7.5' );
                    $xmlwriter->text ( '' );
                  $xmlwriter->endElement ( ); //circle
                  $xmlwriter->startElement ( 'line' );
                    $xmlwriter->writeAttribute ( 'x1', '21' );
                    $xmlwriter->writeAttribute ( 'y1', '21' );
                    $xmlwriter->writeAttribute ( 'x2', '15.8' );
                    $xmlwriter->writeAttribute ( 'y2', '15.8' );
                    $xmlwriter->text ( '' );
                  $xmlwriter->endElement ( ); //line
                $xmlwriter->endElement ( ); //svg
              $xmlwriter->endElement ( ); //a
              $xmlwriter->startElement ( 'a' );
                $xmlwriter->writeAttribute ( 'class', 'btn btn-sm btn-outline-secondary' );
                $xmlwriter->writeAttribute ( 'href', '#' );
                $xmlwriter->text ( 'Sign up' );
              $xmlwriter->endElement ( ); //a
            $xmlwriter->endElement ( ); //div
          $xmlwriter->endElement ( ); //div
        $xmlwriter->endElement ( ); //header
        $xmlwriter->startElement ( 'div' );
          $xmlwriter->writeAttribute ( 'class', 'nav-scroller py-1 mb-2' );
          $xmlwriter->startElement ( 'nav' );
            $xmlwriter->writeAttribute ( 'class', 'nav d-flex justify-content-between' );
            $xmlwriter->startElement ( 'a' );
              $xmlwriter->writeAttribute ( 'class', 'p-2 text-muted' );
              $xmlwriter->writeAttribute ( 'href', '#' );
              $xmlwriter->text ( 'World' );
            $xmlwriter->endElement ( ); //a
            $xmlwriter->startElement ( 'a' );
              $xmlwriter->writeAttribute ( 'class', 'p-2 text-muted' );
              $xmlwriter->writeAttribute ( 'href', '#' );
              $xmlwriter->text ( 'U.S.' );
            $xmlwriter->endElement ( ); //a
            $xmlwriter->startElement ( 'a' );
              $xmlwriter->writeAttribute ( 'class', 'p-2 text-muted' );
              $xmlwriter->writeAttribute ( 'href', '#' );
              $xmlwriter->text ( 'Technology' );
            $xmlwriter->endElement ( ); //a
            $xmlwriter->startElement ( 'a' );
              $xmlwriter->writeAttribute ( 'class', 'p-2 text-muted' );
              $xmlwriter->writeAttribute ( 'href', '#' );
              $xmlwriter->text ( 'Design' );
            $xmlwriter->endElement ( ); //a
            $xmlwriter->startElement ( 'a' );
              $xmlwriter->writeAttribute ( 'class', 'p-2 text-muted' );
              $xmlwriter->writeAttribute ( 'href', '#' );
              $xmlwriter->text ( 'Culture' );
            $xmlwriter->endElement ( ); //a
            $xmlwriter->startElement ( 'a' );
              $xmlwriter->writeAttribute ( 'class', 'p-2 text-muted' );
              $xmlwriter->writeAttribute ( 'href', '#' );
              $xmlwriter->text ( 'Business' );
            $xmlwriter->endElement ( ); //a
            $xmlwriter->startElement ( 'a' );
              $xmlwriter->writeAttribute ( 'class', 'p-2 text-muted' );
              $xmlwriter->writeAttribute ( 'href', '#' );
              $xmlwriter->text ( 'Politics' );
            $xmlwriter->endElement ( ); //a
            $xmlwriter->startElement ( 'a' );
              $xmlwriter->writeAttribute ( 'class', 'p-2 text-muted' );
              $xmlwriter->writeAttribute ( 'href', '#' );
              $xmlwriter->text ( 'Opinion' );
            $xmlwriter->endElement ( ); //a
            $xmlwriter->startElement ( 'a' );
              $xmlwriter->writeAttribute ( 'class', 'p-2 text-muted' );
              $xmlwriter->writeAttribute ( 'href', '#' );
              $xmlwriter->text ( 'Science' );
            $xmlwriter->endElement ( ); //a
            $xmlwriter->startElement ( 'a' );
              $xmlwriter->writeAttribute ( 'class', 'p-2 text-muted' );
              $xmlwriter->writeAttribute ( 'href', '#' );
              $xmlwriter->text ( 'Health' );
            $xmlwriter->endElement ( ); //a
            $xmlwriter->startElement ( 'a' );
              $xmlwriter->writeAttribute ( 'class', 'p-2 text-muted' );
              $xmlwriter->writeAttribute ( 'href', '#' );
              $xmlwriter->text ( 'Style' );
            $xmlwriter->endElement ( ); //a
            $xmlwriter->startElement ( 'a' );
              $xmlwriter->writeAttribute ( 'class', 'p-2 text-muted' );
              $xmlwriter->writeAttribute ( 'href', '#' );
              $xmlwriter->text ( 'Travel' );
            $xmlwriter->endElement ( ); //a
          $xmlwriter->endElement ( ); //nav
        $xmlwriter->endElement ( ); //div
        $xmlwriter->startElement ( 'div' );
          $xmlwriter->writeAttribute ( 'class', 'jumbotron p-3 p-md-5 text-white rounded bg-dark' );
          $xmlwriter->startElement ( 'div' );
            $xmlwriter->writeAttribute ( 'class', 'col-md-6 px-0' );
            $xmlwriter->startElement ( 'h1' );
              $xmlwriter->writeAttribute ( 'class', 'display-4 font-italic' );
              $xmlwriter->text ( 'Title of a longer featured blog post' );
            $xmlwriter->endElement ( ); //h1
            $xmlwriter->startElement ( 'p' );
              $xmlwriter->writeAttribute ( 'class', 'lead my-3' );
              $xmlwriter->text ( 'Multiple lines of text that form the lede, informing new readers quickly and efficiently about what\'s most interesting in this post\'s contents.' );
            $xmlwriter->endElement ( ); //p
            $xmlwriter->startElement ( 'p' );
              $xmlwriter->writeAttribute ( 'class', 'lead mb-0' );
              $xmlwriter->startElement ( 'a' );
                $xmlwriter->writeAttribute ( 'class', 'text-white font-weight-bold' );
                $xmlwriter->writeAttribute ( 'href', '#' );
                $xmlwriter->text ( 'Continue reading...' );
              $xmlwriter->endElement ( ); //a
            $xmlwriter->endElement ( ); //p
          $xmlwriter->endElement ( ); //div
        $xmlwriter->endElement ( ); //div
        $xmlwriter->startElement ( 'div' );
          $xmlwriter->writeAttribute ( 'class', 'row mb-2' );
          $xmlwriter->startElement ( 'div' );
            $xmlwriter->writeAttribute ( 'class', 'col-md-6' );
            $xmlwriter->startElement ( 'div' );
            $xmlwriter->writeAttribute ( 'class', 'card flex-md-row mb-4 shadow-sm h-md-250' );
              $xmlwriter->startElement ( 'div' );
                $xmlwriter->writeAttribute ( 'class', 'card-body d-flex flex-column align-items-start' );
                $xmlwriter->startElement ( 'strong' );
                  $xmlwriter->writeAttribute ( 'class', 'd-inline-block mb-2 text-primary' );
                  $xmlwriter->text ( 'World' );
                $xmlwriter->endElement ( ); //strong
                $xmlwriter->startElement ( 'h3' );
                  $xmlwriter->writeAttribute ( 'class', 'mb-0' );
                  $xmlwriter->startElement ( 'a' );
                    $xmlwriter->writeAttribute ( 'class', 'text-dark' );
                    $xmlwriter->writeAttribute ( 'href', '#' );
                    $xmlwriter->text ( 'Featured post' );
                  $xmlwriter->endElement ( ); //a
                $xmlwriter->endElement ( ); //h3
                $xmlwriter->startElement ( 'div' );
                  $xmlwriter->writeAttribute ( 'class', 'mb-1 text-muted' );
                  $xmlwriter->text ( '29 September 2018' );
                $xmlwriter->endElement ( ); //div
                $xmlwriter->startElement ( 'p' );
                  $xmlwriter->writeAttribute ( 'class', 'card-text mb-auto' );
                  $xmlwriter->text ( 'This is a wider card with supporting text below as a natural lead-in to additional content.' );
                $xmlwriter->endElement ( ); //p
                $xmlwriter->startElement ( 'a' );
                  $xmlwriter->writeAttribute ( 'href', '#' );
                  $xmlwriter->text ( 'Continue reading' );
                $xmlwriter->endElement ( ); //a
              $xmlwriter->endElement ( ); //div
              $xmlwriter->startElement ( 'img' );
                $xmlwriter->writeAttribute ( 'class', 'card-img-right flex-auto d-none d-lg-block' );
                $xmlwriter->writeAttribute ( 'data-src', 'holder.js/200x250?theme=thumb' );
                $xmlwriter->writeAttribute ( 'alt', 'Card image cap' );
              $xmlwriter->endElement ( ); //img
            $xmlwriter->endElement ( ); //div
          $xmlwriter->endElement ( ); //div
          $xmlwriter->startElement ( 'div' );
            $xmlwriter->writeAttribute ( 'class', 'col-md-6' );
            $xmlwriter->startElement ( 'div' );
            $xmlwriter->writeAttribute ( 'class', 'card flex-md-row mb-4 shadow-sm h-md-250' );
              $xmlwriter->startElement ( 'div' );
                $xmlwriter->writeAttribute ( 'class', 'card-body d-flex flex-column align-items-start' );
                $xmlwriter->startElement ( 'strong' );
                  $xmlwriter->writeAttribute ( 'class', 'd-inline-block mb-2 text-success' );
                  $xmlwriter->text ( 'Design' );
                $xmlwriter->endElement ( ); //strong
                $xmlwriter->startElement ( 'h3' );
                  $xmlwriter->writeAttribute ( 'class', 'mb-0' );
                  $xmlwriter->startElement ( 'a' );
                    $xmlwriter->writeAttribute ( 'class', 'text-dark' );
                    $xmlwriter->writeAttribute ( 'href', '#' );
                    $xmlwriter->text ( 'Post title' );
                  $xmlwriter->endElement ( ); //a
                $xmlwriter->endElement ( ); //h3
                $xmlwriter->startElement ( 'div' );
                  $xmlwriter->writeAttribute ( 'class', 'mb-1 text-muted' );
                  $xmlwriter->text ( '28 September 2018' );
                $xmlwriter->endElement ( ); //div
                $xmlwriter->startElement ( 'p' );
                  $xmlwriter->writeAttribute ( 'class', 'card-text mb-auto' );
                  $xmlwriter->text ( 'This is a wider card with supporting text below as a natural lead-in to additional content.' );
                $xmlwriter->endElement ( ); //p
                $xmlwriter->startElement ( 'a' );
                  $xmlwriter->writeAttribute ( 'href', '#' );
                  $xmlwriter->text ( 'Continue reading' );
                $xmlwriter->endElement ( ); //a
              $xmlwriter->endElement ( ); //div
              $xmlwriter->startElement ( 'img' );
                $xmlwriter->writeAttribute ( 'class', 'card-img-right flex-auto d-none d-lg-block' );
                $xmlwriter->writeAttribute ( 'data-src', 'holder.js/200x250?theme=thumb' );
                $xmlwriter->writeAttribute ( 'alt', 'Card image cap' );
              $xmlwriter->endElement ( ); //img
            $xmlwriter->endElement ( ); //div
          $xmlwriter->endElement ( ); //div
        $xmlwriter->endElement ( ); //div
      $xmlwriter->endElement ( ); //div.container
      $xmlwriter->writeComment ( 'JavaScript' );
      $xmlwriter->startElement ( 'script' );
        $xmlwriter->writeAttribute ( 'src', 'https://code.jquery.com/jquery-3.3.1.slim.min.js' );
        $xmlwriter->writeAttribute ( 'integrity', 'sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' );
        $xmlwriter->writeAttribute ( 'crossorigin', 'anonymous' );
        $xmlwriter->text ( '' );
      $xmlwriter->endElement ( ); //script
      $xmlwriter->startElement ( 'script' );
        $xmlwriter->writeAttribute ( 'src', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' );
        $xmlwriter->writeAttribute ( 'integrity', 'sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' );
        $xmlwriter->writeAttribute ( 'crossorigin', 'anonymous' );
        $xmlwriter->text ( '' );
      $xmlwriter->endElement ( ); //script
      $xmlwriter->startElement ( 'script' );
        $xmlwriter->writeAttribute ( 'src', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' );
        $xmlwriter->writeAttribute ( 'integrity', 'sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' );
        $xmlwriter->writeAttribute ( 'crossorigin', 'anonymous' );
        $xmlwriter->text ( '' );
      $xmlwriter->endElement ( ); //script
      $xmlwriter->startElement ( 'script' );
        $xmlwriter->writeAttribute ( 'src', 'https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.min.js' );
        $xmlwriter->writeAttribute ( 'crossorigin', 'anonymous' );
        $xmlwriter->text ( '' );
      $xmlwriter->endElement ( ); //script
      $xmlwriter->startElement ( 'script' );
        $xmlwriter->text ( 'Holder.addTheme(\'thumb\', { bg: \'#55595c\', fg: \'#eceeef\', text: \'Thumbnail\' });' );
      $xmlwriter->endElement ( ); //script
    $xmlwriter->endElement ( ); //body
  $xmlwriter->endElement ( ); //html
  
  $xmlwriter->flush ( );
  unset ( $xmlwriter );