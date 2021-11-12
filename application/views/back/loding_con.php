<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoadingTravel extends CI_Controller
{

    private $travelMbti = [
        "ESTP" => "mood-maker", "INFJ" => "mood-maker", "INFP" => "lonely", "ISTP" => "lonely", "ISFJ" => "manager", "ISTJ" => "manager", "ENTJ" => "leader", "ESTJ" => "leader", "ESFJ" => "ok-man", "ISFP" => "ok-man", "ENTP" => "native", "ISTP" => "native", "INTJ" => "problem-solver", "INTP" => "problem-solver", "ENFP" => "passion", "ESFP" => "passion", "ESFP" => "passion"
    ];

    function __construct()
    {
        parent::__construct();

        $this->load->helper(['url', 'form']);
        $this->load->model('ResultTravel_model');
    }

    public function index()
    {

        $mbti = $this->input->post("result");

        if (empty($mbti)) {
            redirect();
        }

        $data['RT_mbti'] = $mbti;
        $data["RT_section"] = rand(2553, 999999);
        $data["RT_date"] = date("Y-m-d H:i:s");

        $data["RT_idx"] = $this->ResultTravel_model->insertDbDataId($data);

        $data["type"] =  $this->travelMbti[$data['RT_mbti']];

        $this->load->view('loadingTravel_v', $data);
    }

    public function asd()
    {
    }
}