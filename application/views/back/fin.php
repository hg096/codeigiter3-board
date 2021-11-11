<?php include "common/header.php"; ?>
<style>
    body.flex-center {
        display: block;
    }

    .hr-dotted {
        margin-top: 48px;
        border: none;
        border-top: 1px dotted black;
        color: #fff;
        background-color: #fff;
        height: 1px;
        width: 100%;
    }
</style>
<main class="main finish">
    <!-- $contents['TT_type'];
		$contents[0]['TT_type']; -->

    <img src="<? echo base_url(); ?>assets/images/<? echo $TT_image; ?>" alt="송도 용궁 구름다리 송도 해상 케이블카" class="finish-top" />
    <div class="container text-center">
        <div class="download-text">
            <img src="<? echo base_url(); ?>assets/images/arrow-top.png" alt="상단 화살표" />
            <p>위 이미지를 꾹 눌러 저장</p>
        </div>
        <h2><img src="<? echo base_url(); ?>assets/images/final-h2.png" alt="여행을 즐길 줄 아는 당신! 여긴 어때요?" /></h2>

        <article>
            <h3><span class="square <? echo $TT_checkbox; ?>-check"></span>추천 핫플</h3>
            <div class="vertical">
                <div class="left">
                    <div class="bg" style="background-image: url('<? echo base_url(); ?>assets/images/final-bg1.png')">
                    </div>
                </div>
                <div class="right">
                    <h4>
                        <? echo $TT_H_name; ?>
                    </h4>
                    <p><b><? echo $TT_H_title; ?></b>
                        <? echo $TT_H_text; ?>
                    </p>
                    <a href="<? echo $TT_H_url; ?>" class="more" style="background-image:url('<? echo base_url(); ?>assets/images/color-line1/line_<? echo $TT_checkbox; ?>.png')">추천
                        핫플 더보기 ></a>
                </div>
            </div>
        </article>

        <article>
            <h3><span class="square <? echo $TT_checkbox; ?>-check"></span>추천 관광상품</h3>

            <div class="vertical">
                <div class="left">
                    <div class="bg" style="background-image: url('<? echo base_url(); ?>assets/images/final-bg1.png')">
                    </div>
                </div>
                <div class="right">
                    <h4><? echo $TT_T_name; ?></h4>
                    <p><b><? echo $TT_T_title; ?></b>
                        <? echo $TT_T_text; ?>
                    </p>
                    <a href="<? echo $TT_T_url; ?>" class="more" style="background-image:url('<? echo base_url(); ?>assets/images/color-line2/longline_<? echo $TT_checkbox; ?>.png')">추천
                        관광상품더보기 ></a>
                </div>
            </div>
        </article>

        <hr class="hr-dotted">
        <article>
            <a href="#" class="more-other">다른 관광상품 더 보러가기</a>
            <h5>친구에게 공유하기</h5>
            <ul class="flex-center">
                <li><a><img src="<? echo base_url(); ?>assets/images/share.png" alt="공유하기" /></a></li>
                <li><a><img src="<? echo base_url(); ?>assets/images/kakao.png" alt="카카오톡 공유하기" /></a></li>
            </ul>
            <img src="<? echo base_url(); ?>assets/images/korea.png" alt="한국관광공사" class="host-logo" />
        </article>
    </div>
</main>

<script src="<? echo base_url(); ?>assets/js/custom.js"></script>
<script>
    $(document).ready(function() {

    });
</script>
</body>

</html>