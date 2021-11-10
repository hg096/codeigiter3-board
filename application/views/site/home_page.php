<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 헤더 -->
    <?php $this->load->view("include/header_other")  ?>

</head>

<body>
    <h3>메인 페이지</h3>

    <?php

    print_r($_SESSION);

    ?>

</body>
<!-- 푸터 -->
<?php $this->load->view("include/footer_other")  ?>
<!--  -->

</html>