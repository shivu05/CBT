<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Subject
 *
 * @author Himansu
 */
class Subject extends CI_Model {

    private $_db_table = 'subjects';

    function get_subjects_list() {
        $result_set = $this->db->get($this->_db_table);
        $result = $result_set->result_array();
        $result['TOTAL_REC'] = $result_set->num_rows();
        return $result;
    }

}
