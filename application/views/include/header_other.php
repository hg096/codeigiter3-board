    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ci3-board</title>
    <style></style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="/ci3-board">메인</a>
                    <a class="nav-link" href="/ci3-board/index.php/site/boardwrite">작성</a>
                    <a class="nav-link" href="/ci3-board/index.php/site/boardmodify">수정</a>
                    <a class="nav-link" href="/ci3-board/index.php/site/join">가입</a>

                    <?php
                    session_start(); // 세션을 사용하려면 상단에 필요함
                    if (isset($_SESSION['user_id']) == false) { ?>
                    <a class="nav-link" href="/ci3-board/index.php/site/login">로그인</a>
                    <?php
                    } else {
                    ?>
                    <a class="nav-link" href="/ci3-board/index.php/action/logout">로그아웃</a>
                    <a class="nav-link" href="/ci3-board/index.php/action/withdrawal">회원탈퇴</a>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </nav>