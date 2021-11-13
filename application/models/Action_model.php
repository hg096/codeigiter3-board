<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Action_model extends CI_Model
{

    // 수동 접속
    public function __construct()
    {
        parent::__construct();
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

    // 데이터 업데이트
    public function update_data($update)
    {
        $this->db->where($update["where"], $update["search"]);
        $this->db->update($update["from"], $update["data"]);

        return True;
    }

    // 데이터 삭제
    public function delete_data($delete)
    {
        // $delete["data"] = ["u_id" => 5];
        return $this->db->delete($delete["tbl"], $delete["data"]);
    }
}
