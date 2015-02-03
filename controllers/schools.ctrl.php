<?php

$dist_name = str_replace("_", " ", $args["dist_name"]);
$dist_id = $db->query("SELECT id FROM district WHERE name = '$dist_name' LIMIT 1")[0]["id"];
$schools = models\Models::get_all_where("school", "district = '$dist_id'");
foreach ($schools as $school) {
    $page["body"] .= "<a href='" . str_replace(" ", "_", $school->name) . "'>" . $school->name . "</a>\n";
}
$page["title"] = $dist_name;
template("default", $page);
