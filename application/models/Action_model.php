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

    // 데이터 넣기
    function insert_data($tbl, $data)
    {
        $this->db->insert($tbl, $data);
        return True;
    }

    // 데이터 조회
    public function select_data($select)
    {

        if (isset($select['selects']) == true) {
            $this->db->select($select['selects']);
        } else {
            $this->db->select("*");
        }
        if (isset($select['from']) == true) {
            $this->db->from($select['from']);
        }
        if (isset($select['where']) == true) {
            $this->db->where($select['where'], $select['search']);
        }
        if (isset($select['where_in']) == true) {
            $this->db->where_in($select['where'], $select['search']);
        }
        if (isset($select['like']) == true) {
            $this->db->like($select['like'], $select['search']);
        }
        if (isset($select['not_like']) == true) {
            $this->db->not_like($select['not_like'], $select['search']);
        }

        $query = $this->db->get();
        // return $result = $query->result();
        return $result = $query->result_array();
    }


    public function update_data($update)
    {

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

        $this->db->where($update["column"], $update["num"]);
        $this->db->update($update["tbl"], $update["data"]);

        return True;
    }

    public function delete_data($delete)
    {
        // 디비의 컬럼 값과 인덱스 값
        // $delete["data"] = [
        //     "u_id" => 5
        // ];

        return $this->db->delete($delete["tbl"], $delete["data"]);
    }

    // 
    // 

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

        // 검색 컬럼과 조건이 들어감
        // $this->db->like("u_email", ".com");

        $query = $this->db->get();

        return $result = $query->result();
    }

    public function get_user_message()
    {
        // join tbl_users => id, match user_id inside tbl_messages
        $this->db->select("*");
        $this->db->from("users");
        $this->db->join("messages as m_message", "user.u_id = message.u_user_id");
        $query = $this->db->get();
        return $result = $query->result();
    }
}