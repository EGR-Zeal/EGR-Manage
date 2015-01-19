<?php

/*
 * header
 * title
 * head
 * body
 */
header("HTTP/1.0 404 Not Found");
$page["title"] = <<<EOD
    Oops! This is embarrassing...
EOD;
$page["body"] = <<<EOD
    <h1>404! Sorry, we can't find the page you're looking for.</h1>
EOD;
template("default", $page);
