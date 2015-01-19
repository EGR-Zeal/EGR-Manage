<?php

if (!empty($args[0])) {
    $dist_name = str_replace("_", " ", $args[0]);
    $dist_id = $db->query("SELECT id FROM district WHERE name = '$dist_name' LIMIT 1")[0]["id"];
    show_schools($dist_id, $dist_name);
}

function show_schools($dist_id, $dist_name) {
    if (!empty($dist_id)) {
        $schools = \models\get_all_where("school", "district = '$dist_id'");
        // need function get_all_models($model, $where); returns array of models of type $model
        $obj = json_encode($schools, JSON_PRETTY_PRINT);
        $page["body"] = "<pre>" . $obj . "</pre>";
        $page["title"] = $dist_name;
        template("default", $page);
    } else {
        require_once "controllers/404.ctrl.php";
    }
}
