<?php

class Action extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("action_model");
    }

    // 가입
    function register()
    {
        $nickname = $this->db->escape_str($this->security->xss_clean($_POST['nickname']));
        $id = $this->db->escape_str($this->security->xss_clean($_POST['id']));
        $pw = $this->db->escape_str($this->security->xss_clean($_POST['pw']));
        $pwc = $this->db->escape_str($this->security->xss_clean($_POST['pwc']));

        if ($nickname == NULL || $id == NULL || $pw == NULL || $pwc == NULL) {
            echo ("<script>alert('빈칸을 모두 채워주세요.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }
        if ($pw != $pwc) {
            echo ("<script>alert('비밀번호를 같게 입력해주세요.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }

        $sql = "SELECT * FROM `auth` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            echo ("<script>alert('이미 있는 아이디입니다.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }
        $pw_hash = strtoupper(hash("sha256", $pw));
        // $userpw = password_hash($_POST['b_pw'], PASSWORD_BCRYPT); // 나중에 암호화 방식 변경

        // 데이터 정리
        $tbl = 'auth';
        $data = array(
            "nickname" => $nickname,
            "id" => $id,
            "pw" => $pw_hash,
        );

        // $this->모델파일이름->함수이름(매개변수);
        echo $this->action_model->insert_data($tbl, $data);

        // $sql = "INSERT INTO auth(nickname, id, pw)
        // VALUES('$nickname','$id','$pw_hash')";
        // $result = $this->db->query($sql);
        // if ($result == false) {
        //     echo ("<script>alert('오류가 발생했습니다, 관리자에게 문의해주세요.')</script>");
        //     echo ("<script>history.back();</script>");
        //     exit();
        // }


        // session_start();
        // $_SESSION['user_id'] = $id;
        // $_SESSION['user_nickname'] = $nickname;
        // $_SESSION['user_status'] = 1;
        echo ("<script>alert('가입이 완료되었습니다.')</script>");
        echo ("<script>location.href='/ci3-board/';</script>");
        exit();
    }

    // 로그인
    function login()
    {
        $id = $this->db->escape_str($this->security->xss_clean($_POST['id']));
        $pw = $this->db->escape_str($this->security->xss_clean($_POST['pw']));



        $sql = "SELECT * FROM `auth` WHERE `id`='$id'";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $pw = strtoupper(hash("sha256", $pw));
            $sql = "SELECT * FROM `auth` WHERE `pw`='$pw'";
            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {
                // 인증성공, 세션생성 및 로그생성

                $query = $this->db->query("SELECT * FROM `auth` WHERE `id`='$id'");
                foreach ($query->result() as $row) {
                    $id = $row->id;
                    $nickname = $row->nickname;
                }

                // 로그인 성공
                // session_destroy();
                session_start();
                $_SESSION['user_id'] = $id;
                $_SESSION["user_nickname"] = $nickname;
                $_SESSION['user_status'] = 1;

                echo ("<script>alert('안녕하세요, " . $_SESSION['user_nickname'] . "님')</script>");
                echo ("<script>location.href='/ci3-board/';</script>");
                exit();
            } else {
                echo ("<script>alert('비밀번호가 틀립니다.')</script>");
                echo ("<script>history.back();</script>");
                exit();
            }
        } else {
            echo ("<script>alert('아이디가 틀립니다.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }
    }
    function logout()
    {
        session_start();
        session_destroy();
        echo ("<script>alert('로그아웃 되었습니다.')</script>");
        echo ("<script>location.href='/ci3-board';</script>");
    }
    function withdrawal()
    {
        session_start();
        $user_id = $_SESSION['user_id'];

        $sql1 = "DELETE FROM auth WHERE `id` = '$user_id'";
        $sql2 = "DELETE FROM post WHERE `uploader_id` = '$user_id'";
        $sql3 = "DELETE FROM comment WHERE `uploader_id` = '$user_id'";

        $result1 = $this->db->query($sql1);
        $result2 = $this->db->query($sql2);
        $result3 = $this->db->query($sql3);

        if (($result1 || $result2 || $result3) == false) {
            echo ("<script>alert('오류가 발생했습니다, 관리자에게 문의해주세요.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }
        session_destroy();

        echo ("<script>alert('계정을 삭제했습니다.')</script>");
        echo ("<script>location.href='/ci3-board';</script>");
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