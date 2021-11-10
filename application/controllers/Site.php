<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("site_model");
    }

    public function index()
    {
        // http://localhost/ci3/
        $this->load->view("site/home_page");
    }

    public function write()
    {
        $this->load->view("site/Write_v");
    }

    public function modify()
    {
        $this->load->view("site/Modify_v");
    }
    public function join()
    {
        $this->load->view("site/Register_v");
    }
    public function login()
    {
        $this->load->view("site/Login_v");
    }
}