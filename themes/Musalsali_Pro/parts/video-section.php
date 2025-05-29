<?php
$video_sources = get_post_meta(get_the_ID(), 'video_sources', true);
if(empty($video_sources))return;
?>
<div class="video_iframe">
    <h1 class="title_block">سيرفرات المشاهدة</h1>
    <div class="container servers">
        <!-- <span class="main_server"><i class="fas fa-tachometer-alt"></i> <em>MUSALSALI</em></span> -->
        <?php
        // Server List
        foreach ($video_sources as $video) {
            if (!empty($video)) {
                echo "<span data-url='{$video["url"]}'><i class='fad fa-play-circle'></i><em>{$video["name"]}</em></span>";
            }
        }
        ?>
    </div>

    <div class="iframe_continer">
        <h1>الرجاء الانتظار ....</h1>
        <iframe allowfullscreen allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
    </div>
</div>