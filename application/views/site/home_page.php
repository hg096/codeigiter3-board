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
    <h3>메인 페이지</h3>


    <table class="list-table">
        <thead>
            <tr>
                <th width="70">번호</th>
                <th width="500">제목</th>
                <th width="120">글쓴이</th>
                <th width="100">작성일</th>

            </tr>
        </thead>
        <?php foreach ($board as $arry => $list) : ?>
            <tbody>
                <tr>
                    <td width="70">
                        <? echo $list["b_idx"]; ?>
                    </td>
                    <td width="500">
                        <a href='/ci3-board/site/read/<?php echo $list["b_idx"]; ?>'>
                            <? echo $list["title"]; ?>
                    </td>
                    <td width="120">
                        <? echo $list["uploader_id"]; ?>
                    </td>
                    <td width="100">
                        <? echo $list["time"]; ?>
                    </td>

                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>

</body>
<!-- 푸터 -->
<?php $this->load->view("include/footer_other")  ?>
<!--  -->

</html>