<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site extends CI_Controller
{
    // 데이터 출력
    // echo "<pre>";
    // print_r($);

    public function __construct()
    {
        parent::__construct();
        $this->load->model("action_model"); // 조회수 증가에 사용
        $this->load->helper('form'); //이게 있어야 form_open폼 사용가능
        $this->load->library("pagination");
    }

    public function index()
    {
        $config = array();
        $config["base_url"] = base_url();
        $config["total_rows"] = $this->action_model->get_count("board");
        $config["per_page"] = 5;
        $config["uri_segment"] = 1;

        //   start add boostrap class and styles
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo처음';
        $config['last_link'] = '마지막&raquo';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['prev_link'] = '&laquo이전';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['next_link'] = '다음&raquo';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        //   end add boostrap class and styles

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(1)) ? $this->uri->segment(1) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['board'] = $this->action_model->get_pagination($config["per_page"], $page, "board");

        $this->load->view('site/home_page', $data);
    }

    public function join()
    {
        $this->load->view("site/Register_v");
    }
    public function login()
    {
        $this->load->view("site/Login_v");
    }

    public function b_write()
    {
        $this->load->view("site/Write_v");
    }
    public function b_modify($idx = "")
    {
        // 데이터 정리
        $data = [
            "select" => "*", "from" => "board", "where" => "b_idx", "search" => $idx
        ];
        $read =  $this->action_model->select_data($data);

        if (empty($read) || empty($idx)) {
            redirect();
        }

        $read = $read[0];

        $this->load->view("site/Modify_v", $read);
    }
    public function b_read($idx = "")
    {
        // 데이터 정리
        $data = [
            "select" => "*", "from" => "board", "where" => "b_idx", "search" => $idx
        ];
        $read =  $this->action_model->select_data($data);

        $data = [
            "select" => "*", "from" => "reply", "where" => "r_board_idx", "search" => $idx
        ];
        $reply =  $this->action_model->select_data($data);

        if (empty($read) || empty($idx)) {
            redirect();
        }

        // 조회수 증가
        $hit = $read[0]["b_hit"] + 1;
        $data = [
            "where" => "b_idx", "search" => $idx, "from" => "board", "data" => ["b_hit" => $hit]
        ];
        $result = $this->action_model->update_data($data);
        $read = $read[0];

        $this->load->view("site/Read_v", [
            "reply" => $reply, "read" => $read
        ]);
    }
}