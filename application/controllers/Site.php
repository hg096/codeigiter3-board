<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("action_model");
        $this->load->model("site_model");
        $this->load->helper('form'); //이게 있어야 form_open폼 사용가능
        $this->load->helper('url');
    }

    public function index()
    {
        // 데이터 정리
        $data = [
            "select" => "*", "from" => "board"
        ];
        $board =  $this->action_model->select_data($data);
        // echo "<pre>";
        // print_r(["board" => $board]);

        // http://localhost/ci3/
        $this->load->view("site/home_page", ["board" => $board]);
    }
    public function join()
    {
        $this->load->view("site/Register_v");
    }
    public function login()
    {
        $this->load->view("site/Login_v");
    }

    public function write()
    {
        $this->load->view("site/Write_v");
    }
    public function modify($idx = "")
    {
        // 데이터 정리
        $data = [
            "select" => "*", "from" => "board", "where" => "b_idx", "search" => $idx
        ];
        $read =  $this->action_model->select_data($data);

        if (empty($read) || empty($idx)) {
            redirect();
        }
        // echo "<pre>";
        // print_r($read);
        $read = $read[0];

        $this->load->view("site/Modify_v", $read);
    }
    public function read($idx = "")
    {
        // 데이터 정리
        $data = [
            "select" => "*", "from" => "board", "where" => "b_idx", "search" => $idx
        ];
        $read =  $this->action_model->select_data($data);

        if (empty($read) || empty($idx)) {
            redirect();
        }
        // echo "<pre>";
        // print_r($read);
        $read = $read[0];

        $this->load->view("site/Read_v", $read);
    }
}
