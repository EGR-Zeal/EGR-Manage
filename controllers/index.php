<?php

$controllers = [
    "districts" => "districts",
    "districts/{dist_name}" => "schools",
    "districts/{dist_name}/{school_name}" => "plans",
    "districts/{dist_name}/{school_name}/plan/new" => "newplan",
    "districts/{dist_name}/{school_name}/plan/new/save" => "saveplan"
];