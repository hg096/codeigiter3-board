<?php

class Action extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("action_model");
    }

    // 데이터 추가
    function insert_data_into_table()
    {
        // $this->모델파일이름->함수이름(매개변수);
        echo $this->action_model->insert_table_data();
    }

    // 모든 데이터 조회
    public function get_all_data()
    {
        $data = $this->action_model->select_all_data();
        echo "<pre>";
        print_r($data);
    }

    public function update_data()
    {
        if ($this->action_model->update_table_data()) {
            echo "<h3> 업데이트 완료!! </h3>";
        }
    }

    public function delete_single_user()
    {
        echo $this->action_model->delete_specific_user();
    }

    public function codition()
    {
        // $data = $this->action_model->get_where_condition_query();
        // $data = $this->action_model->get_and_condition();
        $data = $this->action_model->get_where_in();
        echo "<pre>";
        print_r($data);
    }
}
