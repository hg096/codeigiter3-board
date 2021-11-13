<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 헤더 -->
    <?php $this->load->view("include/header_other")  ?>

</head>

<body>
    <h3>가입 페이지</h3>


    <div class="container">
        <form action="/ci3-board/action/register" method="post">
            <h4>회원가입 하기</h4>
            <p>이메일</p><input type="email" name="email"><br />
            <p>아이디</p><input type="text" name="id"><br />
            <p>비밀번호</p><input type="password" name="pw"><br />
            <p>비밀번호 재입력</p><input type="password" name="pwc"><br />
            <input type="submit" value="회원가입" class="submit">
        </form>
    </div>



    <!-- 푸터 -->
    <?php $this->load->view("include/footer_other")  ?>
    <!--  -->
</body>


</html>