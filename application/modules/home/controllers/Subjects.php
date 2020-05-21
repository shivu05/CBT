<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Subjects
 *
 * @author Himansu
 */
class Subjects extends SHV_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout->title = "Subject details";
        $this->load->model('home/subject');
    }

    public function index() {
        $this->scripts_include->includePlugins(array('datatables', 'jq_validation'), 'js');
        $this->scripts_include->includePlugins(array('datatables'), 'css');
        $data = array();
        $this->layout->data = $data;
        $this->layout->render();
    }

    public function fetch_subject_data() {
        if ($this->input->is_ajax_request()) {
            $data = $this->subject->get_subjects_list();
            $total_rec = $data['TOTAL_REC'];
            unset($data['TOTAL_REC']);
            echo json_encode(array("sEcho" => 0, "iTotalRecords" => $total_rec, "iTotalDisplayRecords" => $total_rec, 'data' => $data));
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    function check_if_data_exists() {
        if ($this->input->is_ajax_request()) {
            $column_name = $this->input->post('column_name');
            $column_value = $this->input->post($column_name);
            $is_exists = $this->subject->check_if_coulmn_data_exists($column_name, $column_value);
            echo json_encode($is_exists);
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    function save_subject() {
        $post_val = $this->input->post();
        $is_inserted = $this->subject->save($post_val);
        if ($is_inserted) {
            echo json_encode(array('status' => 'true'));
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

}
