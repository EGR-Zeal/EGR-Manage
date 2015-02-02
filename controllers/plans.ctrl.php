<?php

$district = str_replace("_", " ", $args["dist_name"]);
$school = str_replace("_", " ", $args["school_name"]);
$plans = models\Models::plans($district, $school);
$page["body"] .= "<pre>" . json_encode($plans, JSON_PRETTY_PRINT) . "</pre>";
template("default", $page);
