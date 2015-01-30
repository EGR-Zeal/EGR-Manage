<?php

$page["body"] = "<pre>" . json_encode($args, JSON_PRETTY_PRINT) . "</pre>";
$page["title"] = "Test";
template("default", $page);
