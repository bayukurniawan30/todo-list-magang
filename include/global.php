<?php
    // Set Timezone
    date_default_timezone_set("Asia/Makassar");

    define('APP_TITLE', 'ToDo List');
    define('DS', DIRECTORY_SEPARATOR);

    function shortDescription($text, $long = 25)
    {
        $desc    = strip_tags(html_entity_decode($text));
        $subdesc = strlen($desc);
        if($subdesc <= $long) {
            echo $desc;
        }
        else {
            echo substr($desc,0,$long)."..."; 
        }
    }
?>