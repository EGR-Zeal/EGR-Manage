<?php

if (!empty($args)) {
    $dist_name = str_replace("_", " ", $args[0]);
    $dist_id = $db->query("SELECT id FROM district WHERE name = '$dist_name' LIMIT 1")[0]["id"];
}
if (!empty($dist_id)) {
    $dist = new \models\EGR_District($dist_id);
    // need function get_all_models($model, $where); returns array of models of type $model
    $obj = json_encode($dist, JSON_PRETTY_PRINT);
    $page["body"] = "<pre>" . $obj . "</pre>";
    $page["title"] = $dist->name;
    template("default", $page);
} else {
    require_once "controllers/404.ctrl.php";
}
