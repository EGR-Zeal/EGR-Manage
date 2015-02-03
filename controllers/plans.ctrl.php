<?php

$district = str_replace("_", " ", $args["dist_name"]);
$school = str_replace("_", " ", $args["school_name"]);
$plans = models\Models::plans($district, $school);
foreach($plans as $key => $plan){
$page["body"] .= <<<EOD
        
EOD;
}
template("default", $page);
