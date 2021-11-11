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
    }

    public function index()
    {
        $arrWhere["RT_idx"] = $this->input->get("resultIdx");
        $arrWhere["RT_section"] = $this->input->get("resultSection");

        if (empty($arrWhere["RT_idx"])) {
            //redirect("main");
        }
        if (empty($arrWhere["RT_section"])) {
            //redirect("main");
        }

        $result = $this->ResultTravel_model->getDbData_where($arrWhere);

        if (empty($result)) {
            //redirect("main");
        }

        $this->load->view('finishTravel_v', $result);
    }
}