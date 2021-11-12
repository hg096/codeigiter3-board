<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 헤더 -->
    <?php $this->load->view("include/header_other")  ?>

</head>

<body>
    <h3>수정 페이지</h3>

    <div class="container">
        <form action="/ci3-board/index.php/action/modify" method="post">

            <h4>게시물작성 하기</h4>
            <p>제목</p><textarea type="text" name="title" rows="5" cols="55"><?php echo $title ?></textarea><br />
            <p>내용</p><textarea type="text" name="content" rows="5" cols="55"><?php echo $content ?></textarea><br />
            <input type="submit" value="작성완료" class="submit">

        </form>
    </div>


    <!-- 푸터 -->
    <?php $this->load->view("include/footer_other")  ?>
    <!--  -->
</body>


</html>