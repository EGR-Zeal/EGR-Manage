<?php

$districts = $db->query("SELECT name, id FROM district WHERE id > 0 ORDER BY name");
$page["body"] = "";
foreach ($districts as $district) {
    $distname = str_replace(" ", "_", $district["name"]);
    $page["body"] .= <<<EOD
            <a href="district/{$distname}">{$district["name"]}</a>\n
EOD;
}
$page["title"] = "Districts";
template("default", $page);
