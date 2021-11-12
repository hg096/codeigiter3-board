<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FinishTravel extends CI_Controller
{

    function __construct()
    {

        parent::__construct();

        $this->load->helper(['url', 'form']);

        $this->load->model('ResultTravel_model');
        $this->load->model("finishTravel_model");
    }

    public function index($type = "")
    {

        if (empty($type)) {
            redirect();
        }

        // 데이터 정리
        $select = [
            "select" => "*",
            "from" => "_TEMPLATE_TRAVEL",
            "where" => "TT_type",
            "search" => $type,
        ];

        // 디비에서 조회하기
        $result = $this->finishTravel_model->select_data($select);
        $results = $result[0];

        // 결과값 뿌리기
        $this->load->view('finishTravel_v', $results);
    }
}