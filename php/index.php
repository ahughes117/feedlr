<?php

//remove for production version
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", "1");  

require_once ('feedlr.php');

$feedlr = new Feedlr();

$feedlr->create_feed("Just a title here", "<p>A little bit of description</p>", "null", "null", "null");

$feedlr->add_entry("title", "<p>content goes here</p>", "null", "blah", "Alex", "https://ahughes.org", "null", "null");

echo $feedlr->convert_to_atom(); 