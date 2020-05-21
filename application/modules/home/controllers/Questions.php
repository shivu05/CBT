<?php

class Questions extends SHV_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout->title = "Question papers";
        $this->load->model('home/question');
    }

    function create_question_paper() {
        $this->scripts_include->includePlugins(array('ckeditor'), 'js');
        $data = array();
        $data['subjects'] = $this->question->get_subjects_list();
        $data['exams'] = $this->question->get_exams_list();
        $this->layout->data = $data;
        $this->layout->render();
    }

    function generate_questions_form() {
        if ($this->input->is_ajax_request()) {
            $data['no_of_questions'] = $this->input->post('no_of_qp');
            $this->layout->data = $data;
            echo $this->layout->render(null, true);
        }
    }

    function save_questions() {
        $is_complete = $this->question->save_question_paper();
        if ($is_complete) {
            echo 'Question paper added successfully';
        } else {
            echo 'Failed to add Question paper';
        }
    }

    function show_question_paper() {
        $id = 1;
    }

}
