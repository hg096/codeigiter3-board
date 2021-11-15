<?php class User extends CI_Controller
{
    // 데이터 출력
    // echo "<pre>";
    // print_r($);

    public function __construct()
    {
        parent::__construct();
        $this->load->model("action_model");
        $this->load->helper('form'); //이게 있어야 form_open폼 사용가능

    }

    public function join()
    {
        $this->load->view("site/Register_v");
    }
    public function login()
    {
        $this->load->view("site/Login_v");
    }


    // =============

    // 가입
    function u_register()
    {
        $email = $this->db->escape_str($this->security->xss_clean($_POST['email']));
        $id = $this->db->escape_str($this->security->xss_clean($_POST['id']));
        $pw = $this->db->escape_str($this->security->xss_clean($_POST['pw']));
        $pwc = $this->db->escape_str($this->security->xss_clean($_POST['pwc']));

        if (
            $email == NULL || $id == NULL || $pw == NULL || $pwc == NULL
        ) {
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

        // $pw_hash = strtoupper(hash("sha256", $pw));
        $pw_hash = password_hash($pw, PASSWORD_BCRYPT); // 암호화 방식 변경
        $time = date("Y-m-d H:i:s", time());

        // 데이터 정리
        $tbl = 'user';
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
    function u_login()
    {
        $id = $this->db->escape_str($this->security->xss_clean($_GET['id']));
        $pw = $this->db->escape_str($this->security->xss_clean($_GET['pw']));

        // 디비의 비밀번호를 가져오고
        $data = [
            "select" => "*", "from" => "user", "where" => "u_id", "search" => $id
        ];
        $dbpw =  $this->action_model->select_data($data);
        $dbpw = $dbpw[0]["u_pw"];

        // 아이디, 비밀번호 확인
        if (!empty($dbpw) && password_verify($pw, $dbpw)) {

            // 로그인 성공
            // session_destroy();
            session_start();
            $_SESSION['user_id'] = $id;

            $pw_hash = password_hash($pw, PASSWORD_BCRYPT); // 암호화 방식 변경
            // 데이터 정리
            $data = [
                "where" => "u_id", "search" => $id, "from" => "user", "data" => ["u_pw" => $pw_hash]
            ];
            // $this->모델파일이름->함수이름(매개변수);
            $result = $this->action_model->update_data($data);

            echo ("<script>alert('안녕하세요, " . $_SESSION['user_id'] . "님')</script>");
            echo ("<script>location.href='/ci3-board/';</script>");


            exit();
        } else {
            echo ("<script>alert('아이디또는 비밀번호가 틀립니다.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }
    }
    // 로그아웃
    function u_logout()
    {
        session_start();
        session_destroy();
        echo ("<script>alert('로그아웃 되었습니다.')</script>");
        echo ("<script>location.href='/ci3-board';</script>");
    }
    // 계정 삭제
    function u_withdrawal()
    {
        session_start();
        $user_id = $_SESSION['user_id'];

        // 작성한 기록 모두 지우기
        $sql1 = "DELETE FROM user WHERE `u_id` = '$user_id'";
        $sql2 = "DELETE FROM board WHERE `u_id` = '$user_id'";
        $sql3 = "DELETE FROM reply WHERE `u_id` = '$user_id'";
        $sql4 = "alter table user auto_increment = 1";
        $sql5 = "alter table board auto_increment = 1";
        $sql6 = "alter table reply auto_increment = 1";


        $result1 = $this->db->query($sql1);
        $result2 = $this->db->query($sql2);
        $result3 = $this->db->query($sql3);
        $query = $this->db->query($sql4);
        $query = $this->db->query($sql5);
        $query = $this->db->query($sql6);


        // 엠티 체크를 유저만 하는 이유: 가입만하고 게시물과 댓글을 안쓸수도 있어서
        if (empty($result1)) {
            echo ("<script>alert('계정 삭제에 실패했습니다.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }
        session_destroy();

        echo ("<script>alert('계정을 삭제했습니다.')</script>");
        echo ("<script>location.href='/ci3-board';</script>");
    }
}