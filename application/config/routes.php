<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'login';
$route['logout'] = 'login/logout';
$route['dashboard'] = "home/Dashboard/index";

$route['admin-dashboard'] = "home/dashboard/admin";
$route['exams-list'] = "home/exam_details/index";
$route['fetch-exam-data'] = "home/exam_details/fetch_exam_data";
$route['check_exam_title'] = "home/exam_details/check_exam_title";
$route['save_exam_data'] = "home/exam_details/save_exam_data";
$route['subjects-list'] = "home/subjects/index";
$route['fetch-subject-data'] = "home/subjects/fetch_subject_data";
$route['save_subject'] = "home/subjects/save_subject";
$route['check_if_data_exists'] = "home/subjects/check_if_data_exists";
$route['create_qp'] = "home/questions/create_question_paper";
$route['generate_questions'] = "home/questions/generate_questions_form";
$route['save_questions'] = "home/questions/save_questions";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
