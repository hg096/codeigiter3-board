<?php class Reply extends CI_Controller
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

    // 댓글 작성
    function r_reply()
    {
        $b_idx = $this->db->escape_str($this->security->xss_clean($_POST['b_idx']));
        $reply = $this->db->escape_str($this->security->xss_clean($_POST['reply']));
        $time = date("Y-m-d H:i:s", time());

        if ($reply == NULL) {
            echo ("<script>alert('빈칸을 모두 채워주세요.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }

        session_start();
        if (isset($_SESSION['user_id'])) {
            $b_user_id = $_SESSION['user_id'];
        }

        // 데이터 정리
        $tbl = 'reply';
        $data = [
            "r_board_idx" => $b_idx, "r_user_id" => $b_user_id,  "r_content" => $reply, "r_date" => $time
        ];

        // $this->모델파일이름->함수이름(매개변수);
        $result = $this->action_model->insert_data($tbl, $data);
        if (
            $result == false
        ) {
            echo ("<script>alert('댓글 작성을 실패했습니다.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }

        echo ("<script>alert('댓글을 작성했습니다.')</script>");
        echo ("<script>history.back();</script>");
    }
}