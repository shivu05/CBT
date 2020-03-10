<?php

/**
 * Description of Exam_detail
 *
 * @author Shiv
 */
class Exam_detail extends CI_Model {

    private $_exam_table = 'exam_details';

    function get_exams_list() {
        $result_set = $this->db->get($this->_exam_table);
        $result = $result_set->result_array();
        $result['TOTAL_REC'] = $result_set->num_rows();
        return $result;
    }

    function check_exam_title_exists($title = '') {
        $this->db->where('exam_title', trim($title));
        $n = $this->db->get($this->_exam_table)->num_rows();
        if ($n > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function save_exam_details($post_values) {
        return $this->db->insert($this->_exam_table, $post_values);
    }

}
