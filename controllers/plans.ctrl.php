<?php

$dist_name = str_replace("_", " ", $args["dist_name"]);
$dist_id = $db->query("SELECT id FROM district WHERE name = '$dist_name' LIMIT 1")[0]["id"];
$school_name = str_replace("_", " ", $args["school_name"]);
$school_id = $db->query("SELECT id FROM school WHERE district = '$dist_id' AND name = '$school_name' LIMIT 1")[0]["id"];
$plans = $db->query("SELECT * FROM plan WHERE school = '$school_id'");
$page["body"] .= <<<EOD
                <a href="./plans">Plans</a>
EOD;
template("default", $page);
