<?php

namespace models;

class Models {

    public function school($district, $school) {
        global $db;
        $id = $db->query("SELECT school.id AS id FROM school JOIN district ON(school.district = district.id) WHERE district.name = '$district' AND school.name = '$school' LIMIT 1")[0]["id"];
        return new EGR_School($id);
    }

    public function plans($district, $school) {
        global $db;
        $school_object = Models::school($district, $school);
        $plan_ids = $db->query("SELECT id FROM plan WHERE school = '$school_object->id'");
        $plans = [];
        foreach ($plan_ids as $plan) {
            $plans[] = new EGR_Plan($plan["id"]);
        }
        return $plans;
    }

    function get_all_where($type, $condition) {
        global $db;
        $arr = [];
        $res = $db->query("SELECT id FROM $type WHERE $condition");
        $class = "models\EGR_" . ucfirst($type);
        foreach ($res as $object) {
            $arr[] = new $class($object["id"]);
        }
        return $arr;
    }

}
