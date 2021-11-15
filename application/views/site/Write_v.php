<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 헤더 -->
    <?php $this->load->view("include/header_other")  ?>

</head>

<body>
    <?php $this->load->view("include/nav")  ?>

    <div class="container">
        <br>
        <h3>작성 페이지</h3>
        <br>
        <h4 class="mb-5">게시물 작성하기</h4>
        <form action="/ci3-board/board/b_write" method="post">

            <div class="form-floating mb-3">
                <textarea class="form-control" id="floatingTextarea1" style="height: 100px" name="title"></textarea>
                <label for="floatingTextarea1">제목</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" id="floatingTextarea2" style="height: 150px" name="content"></textarea>
                <label for="floatingTextarea2">내용</label>
            </div>
            <button type="submit" class="btn btn-primary submit">작성완료</button>
        </form>
    </div>


    <!-- 푸터 -->
    <?php $this->load->view("include/footer_other")  ?>
    <!--  -->
</body>


</html>