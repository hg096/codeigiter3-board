<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Site_model extends CI_Model
{
    // 수동 접속
    // public function __construct()
    // {
    //     parent::__construct();
    //     // 직접 데이터베이스 접속 방식을 변경가능
    //     // $this->test = $this->load->database("test", TRUE);
    //     $this->load->database();
    // }

    function run_my_query()
    {
        return "Site_model.run_my_query의 값";
    }
}