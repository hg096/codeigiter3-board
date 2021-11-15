<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 헤더 -->
    <?php $this->load->view("include/header_other")  ?>

</head>

<body>
    <?php $this->load->view("include/nav")  ?>
    <?php
    // print_r($_SESSION);
    ?>
    <div class="container">
        <br>
        <h3>메인 페이지</h3> <br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>번호</th>
                    <th>제목</th>
                    <th>글쓴이</th>
                    <th>작성일</th>
                    <th>조회수</th>
                </tr>
            </thead>
            <!-- </div> -->
            <!-- <div class="container"> -->

            <tbody>
                <?php foreach ($board as $list) : ?>
                <tr>
                    <th width="70" scope="row">
                        <? echo $list->b_idx; ?>
                    </th>
                    <td width="500">
                        <a href='/ci3-board/board/read/<?php echo $list->b_idx; ?>'>
                            <? echo $list->b_title; ?>
                    </td>
                    <td width="120">
                        <? echo $list->b_user_id; ?>
                    </td>
                    <td width="100">
                        <? echo $list->b_date; ?>
                    </td>
                    <td width="100">
                        <? echo $list->b_hit; ?>
                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        <p><?php echo $links; ?></p>
    </div>
</body>
<!-- 푸터 -->
<?php $this->load->view("include/footer_other")  ?>
<!--  -->

</html>