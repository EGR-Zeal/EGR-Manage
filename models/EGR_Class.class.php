<?php

namespace models;

class EGR_Class extends EGR_Model {

    public function enrollment() {
        global $db;
        $enrl = $db->query("SELECT COUNT(*) AS enrl FROM enrollment WHERE class = '" . $this->id . "'");
        return intval($enrl[0]["enrl"]);
    }

}