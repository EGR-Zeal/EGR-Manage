<?php

namespace models;

class EGR_Kit extends EGR_Model {

    public function add_component($id = "new", $qty = 1) {
        global $db;
        if ($id === "new") {
            $id = $db->query("INSERT INTO component(name) VALUES('Untitled Component')");
        } else if (intval($id) > 0) {
            $component = $db->query("SELECT * FROM component WHERE id = '" . $id . "'");
            if (count($component) > 0) {
                $db->query("INSERT INTO kit_component(kit, component, qty) VALUES('" . $this->id . "', '" . $id . "', '" . $qty . "')");
            } else {
                error_log("Kit->add_component failed. Component '" . $id . "' does not exist.");
                return false;
            }
        } else {
            error_log("Kit->add_component failed. Incorrectly formatted ID: '" . $id . "'.");
            return false;
        }
    }

    public function qty_needed() {
        global $db;
        $courses = $db->query("SELECT course FROM course_kit WHERE kit = '" . $this->id . "'");
        if (count($courses) > 0) {
            $students_in_courses = 0;
            foreach($courses as $course){
                $students_in_course = $db->query("SELECT COUNT(*) AS number FROM enrollment JOIN class ON(class.id = enrollment.class) WHERE class.course = '" . $course["course"] . "'");
                $students_in_courses += intval($students_in_course["number"]);
            }
            return $students_in_courses;
        } else {
            return 0;
        }
    }

    public function components() {
        global $db;
        $coms = $db->query("SELECT * FROM kit_component WHERE kit = '" . $this->id . "'");
        foreach ($coms as $key => $com) {
            $c = new EGR_Component($com['component']);
            $c->qty = $com['qty'];
            $coms[$key] = $c;
        }
        $this->components = $coms;
    }

}
