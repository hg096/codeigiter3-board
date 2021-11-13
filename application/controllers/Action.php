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
        $email = $this->db->escape_str($this->security->xss_clean($_POST['email']));
        $id = $this->db->escape_str($this->security->xss_clean($_POST['id']));
        $pw = $this->db->escape_str($this->security->xss_clean($_POST['pw']));
        $pwc = $this->db->escape_str($this->security->xss_clean($_POST['pwc']));

        if ($email == NULL || $id == NULL || $pw == NULL || $pwc == NULL) {
            echo ("<script>alert('빈칸을 모두 채워주세요.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }
        if ($pw != $pwc) {
            echo ("<script>alert('비밀번호가 일치하지 않습니다.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }
        // 중복아이디 확인 데이터 정리
        $data = [
            "select" => "u_id", "from" => "user", "where" => "u_id", "search" => $id
        ];
        $query =  $this->action_model->select_data($data);
        if (!empty($query)) {
            echo ("<script>alert('이미 있는 아이디입니다.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }
        $pw_hash = strtoupper(hash("sha256", $pw));
        // $userpw = password_hash($_POST['b_pw'], PASSWORD_BCRYPT); // 나중에 암호화 방식 변경
        $time = date("Y-m-d H:i:s", time());

        // 데이터 정리
        $tbl = 'auth';
        $data = [
            "u_email" => $email, "u_id" => $id, "u_pw" => $pw_hash, "u_date" => $time
        ];

        // $this->모델파일이름->함수이름(매개변수);
        $result = $this->action_model->insert_data($tbl, $data);

        if (empty($result)) {
            echo ("<script>alert('회원가입에 실패했습니다.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        } else {
            echo ("<script>alert('가입이 완료되었습니다.')</script>");
            echo ("<script>location.href='/ci3-board/';</script>");
            exit();
        }
    }
    // 로그인
    function login()
    {
        $id = $this->db->escape_str($this->security->xss_clean($_GET['id']));
        $pw = $this->db->escape_str($this->security->xss_clean($_GET['pw']));

        $sql = "SELECT * FROM `user` WHERE `u_id`='$id'";
        $query = $this->db->query($sql);
        $pw = strtoupper(hash("sha256", $pw));
        $sql2 = "SELECT * FROM `user` WHERE `u_pw`='$pw'";
        $query2 = $this->db->query($sql2);

        // 아이디, 비밀번호 확인
        if (!empty($query && $query2)) {

            // 로그인 성공
            // session_destroy();
            session_start();
            $_SESSION['user_id'] = $id;

            echo ("<script>alert('안녕하세요, " . $_SESSION['user_nickname'] . "님')</script>");
            echo ("<script>location.href='/ci3-board/';</script>");
            exit();
        } else {
            echo ("<script>alert('아이디와 비밀번호가 틀립니다.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }
    }
    // 로그아웃
    function logout()
    {
        session_start();
        session_destroy();
        echo ("<script>alert('로그아웃 되었습니다.')</script>");
        echo ("<script>location.href='/ci3-board';</script>");
    }
    // 계정 삭제
    function withdrawal()
    {
        session_start();
        $user_id = $_SESSION['user_id'];

        // 작성한 기록 모두 지우기
        $sql1 = "DELETE FROM user WHERE `u_id` = '$user_id'";
        $sql2 = "DELETE FROM board WHERE `u_id` = '$user_id'";
        $sql3 = "DELETE FROM reply WHERE `u_id` = '$user_id'";

        $result1 = $this->db->query($sql1);
        $result2 = $this->db->query($sql2);
        $result3 = $this->db->query($sql3);

        if (empty($result1 || $result2 || $result3)) {
            echo ("<script>alert('계정 삭제에 실패했습니다.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }
        session_destroy();

        echo ("<script>alert('계정을 삭제했습니다.')</script>");
        echo ("<script>location.href='/ci3-board';</script>");
    }


    // =====================
    // 게시물 작성
    function write()
    {
        $title = $this->db->escape_str($this->security->xss_clean($_POST['title']));
        $content = $this->db->escape_str($this->security->xss_clean($_POST['content']));

        if ($title == NULL || $content == NULL) {
            echo ("<script>alert('빈칸을 모두 채워주세요.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }

        session_start();
        $user_id = $_SESSION['user_id'];
        $time = date("Y-m-d H:i:s", time());

        // 데이터 정리
        $tbl = 'board';
        $data = [
            "b_name" => $user_id, "b_title" => $title, "b_content" => $content, "b_date" => $time,
        ];

        // $this->모델파일이름->함수이름(매개변수);
        $result = $this->action_model->insert_data($tbl, $data);
        if (empty($result)) {
            echo ("<script>alert('오류가 발생했습니다, 관리자에게 문의해주세요.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }

        echo ("<script>alert('게시물이 작성되었습니다.')</script>");
        echo ("<script>location.href='/ci3-board/';</script>");
        exit();
    }
    // 게시물 수정
    function modify($b_idx)
    {
        $title = $this->db->escape_str($this->security->xss_clean($_POST['title']));
        $content = $this->db->escape_str($this->security->xss_clean($_POST['content']));

        if ($title == NULL || $content == NULL) {
            echo ("<script>alert('빈칸을 모두 채워주세요.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }
        $time = date("Y-m-d H:i:s", time());

        // $this->db->where($update["where"], $update["search"]);
        // $this->db->update($update["from"], $update["data"]);

        // 데이터 정리
        $data = [
            "where" => "b_index", "search" => $b_idx, "from" => "board", "data" => ["b_title" => $title, "b_content" => $content, "b_date" => $time,]
        ];

        // $this->모델파일이름->함수이름(매개변수);
        $result = $this->action_model->update_data($data);
        if (empty($result)) {
            echo ("<script>alert('게시물 수정에 실패했습니다.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }

        echo ("<script>alert('게시물이 수정되었습니다.')</script>");
        echo ("<script>location.href='/ci3-board/';</script>");
        exit();
    }
}
