<?php
  namespace Application;

  class Relationship extends Estr {

    protected $alternate; //provides a link to an alternate version of the document (i.e. print page, translated or mirror). example: <link rel="alternate" type="application/atom+xml" title="w3schools news" href="/blog/news/atom">
    protected $author; //provides a link to the author of the document
    protected $bookmark; //permanent url used for bookmarking
    protected $dns_prefetch; //specifies that the browser should preemptively perform dns resolution for the target resource's origin
    protected $external; //indicates that the referenced document is not part of the same site as the current document
    protected $help; //provides a link to a help document. example: <link rel="help" href="/help/">
    protected $icon; //imports an icon to represent the document. example: <link rel="icon" href="/favicon.ico" type="image/x-icon">
    protected $license; //provides a link to copyright information for the document
    protected $next; //provides a link to the next document in the series
    protected $nofollow; //links to an unendorsed document, like a paid link. ("nofollow" is used by google, to specify that the google search spider should not follow that link)
    protected $noopener; //requires that any browsing context created by following the hyperlink must not have an opener browsing context
    protected $noreferrer; //requires that the browser should not send an http referer header if the user follows the hyperlink
    protected $pingback; //provides the address of the pingback server that handles pingbacks to the current document
    protected $preconnect; //specifies that the browser should preemptively connect to the target resource's origin.
    protected $prefetch; //specifies that the browser should preemptively fetch and cache the target resource as it is likely to be required for a follow-up navigation
    protected $preload; //specifies that the browser agent must preemptively fetch and cache the target resource for current navigation according to the destination given by the "as" attribute (and the priority associated with that destination).
    protected $prev; //indicates that the document is a part of a series, and that the previous document in the series is the referenced document / the previous document in a selection
    protected $search; //links to a search tool for the document / provides a link to a resource that can be used to search through the current document and its related pages.
    protected $stylesheet; //imports a style sheet
    protected $tag; //a tag (keyword) for the current document
    
  }
