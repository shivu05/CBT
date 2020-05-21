<?php

class Question extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    private $_subject_tab = 'subjects';
    private $_exams_tab = 'exam_details';

    function get_subjects_list($where = null) {
        if ($where) {
            $this->db->where($where);
        }
        $this->db->order_by('subject_id', 'DESC');
        return $this->db->get($this->_subject_tab)->result_array();
    }

    function get_exams_list($where = null) {
        if ($where) {
            $this->db->where($where);
        }
        $this->db->order_by('exam_id', 'DESC');
        return $this->db->get($this->_exams_tab)->result_array();
    }

    function save_question_paper() {
        $this->db->trans_begin();
        $n = $this->input->post('no_of_questions', true);

        $question_paper_details = array(
            'subject_id' => $this->input->post('subject_id'),
            'exam_id' => $this->input->post('exam_id'),
            'no_of_questions' => $this->input->post('no_of_questions'),
            'exam_duration' => $this->input->post('exam_duration')
        );
        $qpd_id = $this->_save_question_paper_details($question_paper_details);
        for ($i = 0; $i < $n; $i++) {
            $qp = $this->db->escape($this->input->post('question_box_' . $i . ''));
            $question = array(
                'qpd_id' => $qpd_id,
                'question_text' => $qp,
                'no_of_choices' => 4,
            );
            $question_id = $this->_save_question($question);
            //get answers for question
            $choices = array('a', 'b', 'c', 'd');
            foreach ($choices as $char) {
                $option = $this->input->post('q' . $i . '_ans_' . $char);
                $correct_option = $this->input->post('q' . $i . '_correct_ans');
                $is_right_ans = (strtolower('q' . $i . '_ans_' . $char) == strtolower($correct_option)) ? true : false;
                $answers_array = array(
                    'question_id' => $question_id,
                    'choice_desc' => $option
                );
                $last_choice_id = $this->_save_choice_for_qp($answers_array);
                if ($is_right_ans) {
                    $choice_answer = array(
                        'choice_id' => $last_choice_id,
                        'question_id' => $question_id
                    );
                    $this->_save_answer_choice($choice_answer);
                }
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    private function _save_question_paper_details($post_values = null) {
        if ($post_values) {
            $this->db->insert('question_paper_details', $post_values);
            return $this->db->insert_id();
        }
        return false;
    }

    private function _save_question($post_values = NULL) {
        if ($post_values) {
            $this->db->insert('questions_list', $post_values);
            return $this->db->insert_id();
        }
        return false;
    }

    private function _save_choice_for_qp($post_values = NULL) {
        if ($post_values) {
            $this->db->insert('choices_list', $post_values);
            return $this->db->insert_id();
        }
        return false;
    }

    private function _save_answer_choice($post_values = NULL) {
        if ($post_values) {
            return $this->db->insert('answer_table', $post_values);
        }
        return false;
    }

}
