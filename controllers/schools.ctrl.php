<?php

$dist_name = str_replace("_", " ", $args["dist_name"]);
$district = models\Models::district($dist_name);
$schools = models\Models::get_all_where("school", "district = '$district->id'");
foreach ($schools as $school) {
    $page["body"] .= "<a href='" . str_replace(" ", "_", $school->name) . "'>" . $school->name . "</a>\n";
}
$page["title"] = $district->name;
template("default", $page);
