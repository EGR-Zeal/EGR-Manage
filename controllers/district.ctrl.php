<?php

if (!empty($args["dist_name"])) {
    $dist_name = str_replace("_", " ", $args["dist_name"]);
    $dist_id = $db->query("SELECT id FROM district WHERE name = '$dist_name' LIMIT 1")[0]["id"];
    if (empty($args["school_name"])) {
        show_schools($dist_id, $dist_name);
    } else {
        $school_name = str_replace("_", " ", $args["school_name"]);
        $school_id = $db->query("SELECT id FROM school WHERE district = '$dist_id' AND name = '$school_name' LIMIT 1")[0]["id"];
        $page["body"] .= <<<EOD
                <a href="./plans">Plans</a>
EOD;
        template("default", $page);
    }
} else {
    header("Location: http://egrobotics.com/dev/app/districts/");
}

function show_schools($dist_id, $dist_name) {
    if (!empty($dist_id)) {
        $schools = \models\get_all_where("school", "district = '$dist_id'");
        // need function get_all_models($model, $where); returns array of models of type $model
        foreach ($schools as $school) {
            $page["body"] .= "<a href='" . str_replace(" ", "_", $school->name) . "'>" . $school->name . "</a>\n";
        }
        $page["title"] = $dist_name;
        template("default", $page);
    } else {
        require_once "controllers/404.ctrl.php";
    }
}
