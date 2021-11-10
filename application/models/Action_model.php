<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Action_model extends CI_Model
{

    // 수동 접속
    public function __construct()
    {
        parent::__construct();
        $this->load->model("action_model");
    }

    // 가입
    function insert_data($tbl, $data)
    {
        $this->db->insert($tbl, $data);
        return True;
    }

    // 모든 데이터 조회
    public function select_all_data()
    {
        $tbl = 'users';

        // 방법 1
        $this->db->select("*");
        $this->db->from($tbl);
        $query = $this->db->get();
        // return $result = $query->result();
        return $result = $query->result_array();

        // 방법 2
        // $this->db->select("u_name,u_email");
        // $this->db->from($tbl);
        // $query = $this->db->get();
        // return $result = $query->result();

        // 방법 3
        // $this->db->select("*");
        // $this->db->from($tbl);
        // $this->db->where("u_id", "1"); // u_id에서 1의 값
        // $query = $this->db->get();
        // return $result = $query->row_array(); // row_array, row 하나의 데이터만 받아올 때 사용

        // 방법 4 
        // $this->db->select("*");
        // $this->db->from($tbl);
        // $this->db->where(array(
        //     "u_id" => 2,
        //     "u_email" => "이메일@메일.com",
        // )); // u_email에서 이메일@메일.com같은 이름
        // $query = $this->db->get();
        // return $result = $query->result();


        // $result['colum'] = "u_id";
        // $result['num'] = 1;
        // $result['tbl'] = "u_id";
        // $result['updateData'] =[
        //                         "u_name" => "이름변경2",
        //                         "u_email" => "이메일변경2@메일.com",
        //                         "u_phone_num" => "123321",
        //                     ]
        // $this->update_table_data($result);

    }


    public function update_table_data()
    {

        // $colum = "u_id";
        // $num = 1;
        // $tbl = "users";
        // $data = array(
        //     "u_name" => "이름변경2",
        //     "u_email" => "이메일변경2@메일.com",
        //     "u_phone_num" => "123321",
        // );
        // $this->db->where($colum, $num);
        // $this->db->update($tbl, $data);

        $total = [
            "colum" => "u_id",
            "num" => 1,
            "tbl" => "users",
            "data" => array(
                "u_name" => "이름변경2",
                "u_email" => "이메일변경2@메일.com",
                "u_phone_num" => "123321",
            ),
        ];

        $total["colum"] = "u_id";

        $this->db->where($total["colum"], $total["num"]);
        $this->db->update($total["tbl"], $total["data"]);

        return True;
    }

    public function delete_specific_user()
    {

        $total = [
            "colum" => "u_id",
            "num" => 5,
            "tbl" => "users",

        ];

        // 방법 1
        // $this->db->where($total["colum"], $total["num"]);
        // return $this->db->delete($total["tbl"]);

        // 방법 2
        return $this->db->delete($total["tbl"], [
            "u_id" => 4
        ]);
    }

    public function get_where_condition_query()
    {
        $total = [
            "colum" => "u_salary",
            "value" => 4000,
            "tbl" => "users",

        ];


        $this->db->select("*");
        $this->db->from($total["tbl"]);
        // $this->db->where("u_salary >=", 3000); 
        $this->db->where("$total[colum] >=", $total["value"]);
        $query = $this->db->get();
        return $result = $query->result();
    }

    public function get_and_condition()
    {

        $total = [

            "tbl" => "users",

        ];

        $this->db->select("*");
        $this->db->from($total["tbl"]);
        $this->db->where([
            "u_id" => 2,
            "u_email" => "이메일@메일.com",
        ]);
        $query = $this->db->get();
        return $result = $query->result();
    }

    public function get_where_in()
    {
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where_in("u_salary", [3000, 3500, 4000]);
        $query = $this->db->get();

        return $result = $query->result();
    }
}