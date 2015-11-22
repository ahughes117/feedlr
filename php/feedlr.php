<?php

//Only for debugging, comment for production version
//error_reporting(E_ALL | E_STRICT);
//ini_set("display_errors", "1");  

require_once ('feed.php');

class Feedlr {

    public $feed;

    /**
     * Creates a feed container, meaning it will contain all the feeds.
     * Dates are converted from any valid format of a PHP date here.
     * 
     * @param type $title
     * @param type $description
     * @param type $link
     * @param type $feed_link
     * @param type $date
     */
    public function create_feed($title, $description, $link, $feed_link, $date) {
        $feed = new Feed();

        $feed->title = htmlspecialchars($title);
        $feed->description = htmlspecialchars($description);
        $feed->link = $link;
        $feed->feed_link = $feed_link;
        $feed->date = date('Y-m-d\TH:i:s', strtotime($date)) . 'Z';

        $feed->entries = array();

        $this->feed = $feed;
    }

    /**
     * Adds an entry to the existing feed.
     * Again, dates are converted from any valid format of a PHP date here.
     * 
     * @param type $title
     * @param type $content
     * @param type $link
     * @param type $uuid
     * @param type $author_name
     * @param type $author_uri
     * @param type $date_created
     * @param type $date_modified
     */
    public function add_entry($title, $content, $link, $uuid, $author_name, $author_uri, $date_created, $date_modified) {
        $entry = new Entry();

        $entry->title = $title;
        $entry->content = $content;
        $entry->link = $link;
        $entry->uuid = $uuid;
        $entry->author_name = $author_name;
        $entry->author_uri = $author_uri;
        $entry->date_created = date('Y-m-d\TH:i:s', strtotime($date_created)) . 'Z';
        $entry->date_modified = date('Y-m-d\TH:i:s', strtotime($date_modified)) . 'Z';

        $this->feed->entries [] = $entry;
    }

    public function convert_to_atom() {
        return Feed::convert_to_atom($this->feed);
    }

}
