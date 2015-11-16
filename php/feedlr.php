<?php

//remove for production version
//error_reporting(E_ALL | E_STRICT);
//ini_set("display_errors", "1");  

require_once ('src/feed.php');

class Feedlr {

    public $feed;

    public function create_feed($title, $description, $link, $feed_link, $date) {
        $feed = new Feed();

        $feed->title = $title;
        $feed->description = $description;
        $feed->link = $link;
        $feed->feed_link = $feed_link;
        $feed->date = $date;

        $feed->entries = array();

        $this->feed = $feed;
    }

    public function add_entry($title, $content, $link, $uuid, $author_name, $author_uri, $date_created, $date_modified) {
        $entry = new Entry();

        $entry->title = $title;
        $entry->content = $content;
        $entry->link = $link;
        $entry->uuid = $uuid;
        $entry->author_name = $author_name;
        $entry->author_uri = $author_uri;
        $entry->date_created = $date_created;
        $entry->date_modified = $date_modified;

        $this->feed->entries [] = $entry;
    }

    public function convert_to_atom() {
        return Feed::convert_to_atom($this->feed);
    }

}
