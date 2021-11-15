<?php class Board extends CI_Controller
{
    // 데이터 출력
    // echo "<pre>";
    // print_r($);

    public function __construct()
    {
        parent::__construct();
        $this->load->model("action_model");
        $this->load->helper('form'); //이게 있어야 form_open폼 사용가능
        $this->load->library("pagination");
    }

    public function index()
    {
        $config = array();
        $config["base_url"] = base_url();
        $config["total_rows"] = $this->action_model->get_count("board");
        $config["per_page"] = 5;
        $config["uri_segment"] = 1;

        //   start add boostrap class and styles
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo처음';
        $config['last_link'] = '마지막&raquo';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['prev_link'] = '&laquo이전';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['next_link'] = '다음&raquo';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        //   end add boostrap class and styles

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(1)) ? $this->uri->segment(1) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['board'] = $this->action_model->get_pagination($config["per_page"], $page, "board");

        $this->load->view('site/home_page', $data);
    }
    public function write()
    {
        $this->load->view("site/Write_v");
    }
    public function modify($idx = "")
    {
        // 데이터 정리
        $data = [
            "select" => "*", "from" => "board", "where" => "b_idx", "search" => $idx
        ];
        $read =  $this->action_model->select_data($data);

        if (empty($read) || empty($idx)) {
            redirect();
        }

        $read = $read[0];

        $this->load->view("site/Modify_v", $read);
    }
    public function read($idx = "")
    {
        // 데이터 정리
        $data = [
            "select" => "*", "from" => "board", "where" => "b_idx", "search" => $idx
        ];
        $read =  $this->action_model->select_data($data);

        $data = [
            "select" => "*", "from" => "reply", "where" => "r_board_idx", "search" => $idx
        ];
        $reply =  $this->action_model->select_data($data);

        if (empty($read) || empty($idx)) {
            redirect();
        }

        // 조회수 증가
        $hit = $read[0]["b_hit"] + 1;
        $data = [
            "where" => "b_idx", "search" => $idx, "from" => "board", "data" => ["b_hit" => $hit]
        ];
        $result = $this->action_model->update_data($data);
        $read = $read[0];

        $this->load->view("site/Read_v", [
            "reply" => $reply, "read" => $read
        ]);
    }


    // 게시물 작성
    function b_write()
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
            "b_user_id" => $user_id, "b_title" => $title, "b_content" => $content, "b_date" => $time, "b_hit" => 0
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
    function b_modify($b_idx)
    {
        $title = $this->db->escape_str($this->security->xss_clean($_POST['title']));
        $content = $this->db->escape_str($this->security->xss_clean($_POST['content']));

        if ($title == NULL || $content == NULL) {
            echo ("<script>alert('빈칸을 모두 채워주세요.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }
        $time = date("Y-m-d H:i:s", time());

        // 데이터 정리
        $data = [
            "where" => "b_idx", "search" => $b_idx, "from" => "board", "data" => ["b_title" => $title, "b_content" => $content, "b_date" => $time,]
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
    // 게시물 삭제
    function b_delete($b_idx)
    {
        // 데이터 정리
        $data = [
            "from" => "board", "data" => ["b_idx" => $b_idx]
        ];
        // $this->모델파일이름->함수이름(매개변수);
        $result = $this->action_model->delete_data($data);
        $sql = "alter table board auto_increment = 1";
        $query = $this->db->query($sql);

        if (empty($result)) {
            echo ("<script>alert('게시물 삭제에 실패했습니다.')</script>");
            echo ("<script>history.back();</script>");
            exit();
        }
        echo ("<script>alert('게시물을 삭제했습니다.')</script>");
        echo ("<script>location.href='/ci3-board';</script>");
    }
}