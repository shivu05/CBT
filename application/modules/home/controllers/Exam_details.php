<?php

/**
 * Description of Exam_details
 *
 * @author Shiv
 */
class Exam_details extends SHV_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout->title = "Exam Details ";
        $this->load->model('home/exam_detail');
    }

    function index() {
        $this->scripts_include->includePlugins(array('datatables', 'jq_validation'), 'js');
        $this->scripts_include->includePlugins(array('datatables'), 'css');
        $data = array();
        $this->layout->data = $data;
        $this->layout->render();
    }

    public function fetch_exam_data() {
        if ($this->input->is_ajax_request()) {
            $data = $this->exam_detail->get_exams_list();
            $total_rec = $data['TOTAL_REC'];
            unset($data['TOTAL_REC']);
            echo json_encode(array("sEcho" => 0, "iTotalRecords" => $total_rec, "iTotalDisplayRecords" => $total_rec, 'data' => $data));
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    public function check_exam_title() {
        if ($this->input->is_ajax_request()) {
            $exam_title = $this->input->post('exam_title');
            $is_exists = $this->exam_detail->check_exam_title_exists($exam_title);
            echo json_encode($is_exists);
        } else {
            $this->layout->render(array('error' => '401'));
        }
    }

    public function save_exam_data() {
        $post_values = $this->input->post();
        $is_inserted = $this->exam_detail->save_exam_details($post_values);
        if ($is_inserted) {
            echo json_encode(array('status' => 'true'));
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

}
