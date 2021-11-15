<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 헤더 -->
    <?php $this->load->view("include/header_other")  ?>
</head>

<body>
    <?php $this->load->view("include/nav")  ?>
    <div class="container">
        <h3 class="mb-5 mt-3">로그인 페이지</h3>

        <form action="/ci3-board/user/u_login" method="get">
            <h4>로그인 하기</h4>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingPassword" name="id">
                <label for="floatingPassword">아이디</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingInput" name="pw">
                <label for="floatingInput">비밀번호</label>
            </div>
            <button type="submit" class="btn btn-primary submit">로그인</button>
        </form>

    </div>


    <!-- 푸터 -->
    <?php $this->load->view("include/footer_other")  ?>
    <!--  -->
</body>


</html>