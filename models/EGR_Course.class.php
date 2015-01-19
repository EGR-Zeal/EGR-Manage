<?php

namespace models;

class EGR_Course extends EGR_Model {

    public function add_kit($id = "new") {
        global $db;
        if ($id === "new") {
            $kit = new EGR_Kit();
            $kit->set("name", $this->name . " Kit");
            $id = $kit->id;
        } else if (intval($id) > 0) {
            //check kit exists
            $kit = $db->query("SELECT * FROM kit WHERE id = '" . $id . "'");
            //add kit and course id to course_kit
            if (count($kit) > 0) {
                $db->query("INSERT INTO course_kit(course, kit) VALUES('" . $this->id . "','" . $id . "')");
                // this will fail if the entry already exists due to a multi-field unique index on the course_kit table
            } else {
                error_log("Kit with ID '" . $id . "' not found.");
            }
        } else {
            error_log("Invalid ID value '" . $id . "' supplied as kit ID.");
            return false;
        }
    }

}
