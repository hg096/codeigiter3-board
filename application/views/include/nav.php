<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/ci3-board">게시판</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="/ci3-board">메인</a>



                <!-- <a class="nav-link" href="/ci3-board/site/b_modify">수정</a> -->

                <?php
                session_start(); // 세션을 사용하려면 상단에 필요함
                if (isset($_SESSION['user_id']) == false) { ?>
                <a class="nav-link" href="/ci3-board/user/join">가입</a>
                <a class="nav-link" href="/ci3-board/user/login">로그인</a>
                <?php
                } else {
                ?>
                <a class="nav-link" href="/ci3-board/board/write">작성</a>
                <a class="nav-link" href="/ci3-board/user/u_logout">로그아웃</a>
                <a class="nav-link" href="/ci3-board/user/u_withdrawal">회원탈퇴</a>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</nav>