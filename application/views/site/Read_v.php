<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 헤더 -->
    <?php $this->load->view("include/header_other")  ?>
</head>

<body>
    <?php $this->load->view("include/nav")  ?>
    <div class="container mb-5">

        <h2 class="container mt-5 mb-3">상세 페이지</h2>
        <div class=" mt-3">

            <h4 class="float-end ">작성자: <?php echo $read["b_idx"]; ?> 작성시간: <?php echo $read["b_date"]; ?></h4>

            <h4 class="container mt-5">제목</h4>
            <textarea class="form-control" readonly><?php echo $read["b_title"]; ?></textarea>

            <h4 class="container mt-5">내용</h4>
            <textarea class="form-control" readonly style="height: 150px"><?php echo $read["b_content"]; ?></textarea>
        </div>

        <br>
        <!-- 목록, 수정, 삭제 -->
        <div class="btn-group float-end " role="group" aria-label="Basic example">
            <a href="/ci3-board"><button type="button" class="btn btn-primary">목록으로</button></a>

            <? if (!empty($_SESSION['user_id'])) { ?>
            <?php if ($_SESSION['user_id'] == $read["b_user_id"]) { ?>
            <a href="/ci3-board/board/modify/<?php echo $read["b_idx"]; ?>"><button type="button"
                    class="btn btn-primary">수정</button></a>
            <a href="/ci3-board/board/b_delete/<?php echo $read["b_idx"]; ?>"><button type="button"
                    class="btn btn-primary">삭제</button></a>
            <?php
                }
                ?>
            <?php
            }
            ?>
        </div>
        <br> <br>
        <? if (!empty($_SESSION['user_id'])) { ?>
        <div>
            <h4 class="container mt-5">댓글 작성</h4>
            <form action="/ci3-board/reply/r_reply" method="post" class="form-floating">
                <!-- <input type="hidden" name="b_user_id" value="<?php echo $b_user_id; ?>"> -->
                <input type="hidden" name="b_idx" value="<?php echo $read["b_idx"]; ?>">

                <textarea class="form-control" id="floatingTextarea" style="height: 100px" name="reply"></textarea>
                <label for="floatingTextarea">내용</label>
                <br>

                <button type="submit" class="btn btn-primary submit">작성완료</button>
            </form>
        </div>
        <?php
        }
        ?>

    </div>


    <? if (!empty($reply)) { ?>
    <?php foreach ($reply as $array => $list) : ?>
    <div class="container">
        <h5>
            댓글번호:
            <? echo $list["r_idx"]; ?>
            작성자:
            <? echo $list["r_user_id"]; ?>
            작성 시간:
            <? echo $list["r_date"]; ?>
        </h5>
        <hr class="mt-2">
        <textarea class="form-control" readonly> <? echo $list["r_content"]; ?></textarea>
        <br> <br>
    </div>
    <?php endforeach; ?>
    <?php
    }
    ?>

</body>
<!-- 푸터 -->
<?php $this->load->view("include/footer_other")  ?>
<!--  -->

</html>