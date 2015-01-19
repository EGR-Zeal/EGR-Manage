<?php

namespace models;

class EGR_School extends EGR_Model {

    public function populateTotalSpots() {
        global $db;
        $classes = $db->query("SELECT id FROM class WHERE cost > 0 AND status = 'active' AND school = '" . $this->id . "'");
        $spots = 0;
        $enrl = 0;
        foreach ($classes as $class) {
            $cls = new EGR_Class($class["id"]);
            $spots += intval($cls->capacity);
            $enrl += intval($cls->enrollment());
        }
        $this->activeSpots = $spots;
        $this->activeEnrollments = $enrl;
    }

}