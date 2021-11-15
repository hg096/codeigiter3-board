<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 헤더 -->
    <?php $this->load->view("include/header_other")  ?>
</head>

<body>
    <h3>상세 페이지</h3>
    <div>
        <h4>작성자: <?php echo $b_user_id; ?></h4>
        <h4>작성시간: <?php echo $b_date; ?></h4>

        <h4>제목: <?php echo $b_title; ?></h4>
        <h4>내용:</h4>
        <h4> <?php echo $b_content; ?></h4>

    </div>

    <!-- 목록, 수정, 삭제 -->
    <div id="">
        <ul>
            <li><a href="/ci3-board">[목록으로]</a></li>

            <?php if ($_SESSION['user_id'] == $b_user_id) { ?>
            <li><a href="/ci3-board/site/b_modify/<?php echo $b_idx; ?>">[수정]</a></li>
            <li><a href="/ci3-board/action/b_delete/<?php echo $b_idx; ?>">[삭제]</a></li>
            <?php
            }
            ?>

        </ul>
    </div>

</body>
<!-- 푸터 -->
<?php $this->load->view("include/footer_other")  ?>
<!--  -->

</html>