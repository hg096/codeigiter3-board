<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 헤더 -->
    <?php $this->load->view("include/header_other")  ?>

</head>

<body>
    <h3>로그인 페이지</h3>

    <form action="/ci3-board/action/login" method="get">
        <h4>로그인 하기</h4>
        <p>아이디</p><input type="text" name="id"><br />
        <p>비밀번호</p><input type="password" name="pw"><br />
        <input type="submit" value="로그인" class="submit">
    </form>




    <!-- 푸터 -->
    <?php $this->load->view("include/footer_other")  ?>
    <!--  -->
</body>


</html>