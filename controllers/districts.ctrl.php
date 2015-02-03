<?php

$districts = \models\Models::get_all_where("district", "id > 0");
foreach ($districts as $district) {
    $distname = str_replace(" ", "_", $district->name);
    $page["body"] .= <<<EOD
            <a href="$distname">$district->name</a>\n
EOD;
}
$page["title"] = "Districts";
template("default", $page);
