<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FinishTravel extends CI_Controller
{

    //private $travelMbti = ['ESTP'=>''];

    function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form']);

        $this->load->model('ResultTravel_model');
        $this->load->model("finishTravel_model");
    }

    public function index($mbti = "")
    {

        // $arrWhere["RT_idx"] = $this->input->get("resultIdx");
        // $arrWhere["RT_section"] = $this->input->get("resultSection");
        // 		
        // if(empty($arrWhere["RT_idx"])){
        // //redirect("main");
        // }
        // if(empty($arrWhere["RT_section"])){
        // //redirect("main");
        // }
        // 		
        // $result = $this->ResultTravel_model-> getDbData_where($arrWhere);
        // 		
        // if( empty($result) ){
        // //redirect("main");
        // }
        // 		
        // 		
        // $result['RT_mbti']; //mbti 결과값


        // 데이터 정리
        $select = [
            "select" => "*",
            "from" => "_TEMPLATE_TRAVEL",
            "like" => "TT_mbti",
            "search" => $mbti,
        ];

        //$sqlData['arrWhere'] = ['TT_mbti' =>]

        // 디비에서 조회하기
        $result = $this->finishTravel_model->select_data($select);
        $results = $result[0];
        // echo "<pre>";
        // print_r($results);
        // 결과값 뿌리기
        $this->load->view('finishTravel_v', $results);
    }
}