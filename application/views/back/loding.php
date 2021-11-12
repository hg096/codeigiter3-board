<?php include "common/header.php"; ?>
<main class="sub-1">
    <img src="assets/images/sub1_bg.jpg" alt="서브 백그라운드" srcset="">
    <div class="main__contents-wrap absolute text-center flex-center">
        <!-- 로딩 화면 -->
        <article class="loading-wrap">
            <div class="bird-loading-wrap">
                <img src="assets/images/sub1_leg.png" alt="캐릭터 로딩" srcset="" class="bird-leg left">
                <img src="assets/images/sub1_leg.png" alt="캐릭터 로딩" srcset="" class="bird-leg right">
                <img src="assets/images/sub1_body.png" alt="캐릭터 로딩" srcset="" class="bird-body">
            </div>
            <h1 class="sub-title-sm">나와 닮은 부산 관광지는..</h2>
        </article>
        <!-- 로딩 화면 끝 -->
    </div>
    <? $attributes = array('method' => 'get', 'class' => '', 'id' => 'resultForm');
    echo form_open(base_url() . 'finishTravel/final/' . $type . '', $attributes);
    ?>
    <input type="hidden" name="resultIdx" id="resultIdx" value="<? echo $RT_idx; ?>">
    <input type="hidden" name="resultSection" id="resultSection" value="<? echo $RT_section; ?>">
    <? echo form_close(); ?>
</main>
</body>
<script>
$(document).ready(function() {
    setTimeout(() => {
        $(".loading-wrap").remove();
        $(".question-wrap").css("display", "block");

        $("#resultForm").submit();

    }, 3000);
});
</script>

</html>