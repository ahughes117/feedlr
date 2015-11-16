<?php

/**
 * The feed class, containing the feed functionality
 * 
 */
class Feed {

    public $title;
    public $description;
    public $link;
    public $feed_link;
    public $entries;
    public $date;

    public static function convert_to_atom($feed) {
        try {
            if (!($feed instanceof Feed))
                throw new Exception();

            $content = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
                <feed xml:lang=\"en-US\" xmlns=\"http://www.w3.org/2005/Atom\">
                <title type=\"text\">{$feed->title}</title>
                <subtitle type=\"text\">{$feed->description}</subtitle>
                
                <updated>{$feed->date}</updated>
                
                <link rel=\"alternate\" type=\"text/html\" href=\"{$feed->link}\" />
                <id>{$feed->feed_link}</id>
                <link rel=\"self\" type=\"application/atom+xml\" href=\"{$feed->feed_link}\" />";

            foreach ($feed->entries as $e) {
                $content .= Entry::convert_to_atom($e);
            }
            $content .= "</feed>";
            return $content;
        } catch (Exception $ex) {
            return false;
        }
    }

}

class Entry {

    public $title;
    public $content;
    public $link;
    public $uuid;
    public $author_name;
    public $author_uri;
    public $date_created;
    public $date_modified;

    public static function convert_to_atom($entry) {
        try {
            if (!($entry instanceof Entry))
                throw new Exception();

            $content = "
                <entry>
                    <author>
                        <name>{$entry->author_name}</name>
                        <uri>{$entry->author_uri}</uri>
                    </author>
                    <title type=\"html\"><![CDATA[{$entry->title}]></title>
                    <id>{$entry->link}</id>
                    <updated>{$entry->date_modified}</updated>
                    <published>{$entry->date_created}</published>
                    
                    <content type=\"html\" xml:base=\"{$entry->link}\">
                        <![CDATA[{$entry->content}]]>
                    </content>
                </entry>";

            return $content;
        } catch (Exception $ex) {
            return false;
        }
    }

}
