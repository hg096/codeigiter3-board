<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 헤더 -->
    <?php $this->load->view("include/header_other")  ?>
    <?php
    // print_r($_SESSION);
    ?>
</head>

<body>
    <h3>상세 페이지</h3>
    <div>
        <h4>작성자: <?php echo $uploader_id; ?></h4>
        <h4>작성시간: <?php echo $time; ?></h4>

        <h4>제목: <?php echo $title; ?></h4>

        <h4>내용:</h4>
        <h4> <?php echo $content; ?></h4>

    </div>

    <!-- 목록, 수정, 삭제 -->
    <div id="bo_ser">
        <ul>
            <li><a href="/ci3-board">[목록으로]</a></li>
            <li><a href="/ci3-board/index.php/site/modify/<?php echo $id_key; ?>">[수정]</a></li>
            <li><a href="/ci3-board/index.php/site/delete/<?php echo $id_key; ?>">[삭제]</a></li>
        </ul>
    </div>

</body>
<!-- 푸터 -->
<?php $this->load->view("include/footer_other")  ?>
<!--  -->

</html>