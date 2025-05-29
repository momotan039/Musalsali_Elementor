<?php
// Display Taxonomy Terms
global $series_id;
$post_id=isset($series_id)?$series_id:get_the_ID();
function display_taxonomy_terms($taxonomy, $label, $icon = 'fas fa-tags', $class = '',$post_id)
{
    $terms = get_the_terms($post_id, $taxonomy);
    if (!empty($terms)) {
        echo '<div class="' . $class . '"><span><i class="' . $icon . '"></i> ' . $label . '</span><div class="items">';
        foreach ($terms as $term) {
            echo "<a href='" . get_term_link($term) . "'> " . $term->name . " </a> ";
        }
        echo '</div></div>';
    }
}
?>
<div class="poster_info_poster">
    <div>
    <h2>المشاهدات:<?php echo get_post_views($post_id)?> <i class="fad fa-eye fa-lg"></i></h2>
    <div class="poster" style="background: url(<?php echo get_the_post_thumbnail_url($post_id); ?>);"></div>
    </div>
        <div class="info_poster">
            <h1><?php the_title(); ?></h1>
            <div class="story">
                <h2>قصة العرض</h2>
                <p><?php echo get_the_content(null, false, $post_id); ?></p>
            </div>
            <div class="items-info">
                <div class="wrap">
                    <div class="cat">
                        <span><i class="fad fa-popcorn"></i> الفئة</span>
                        <div class="items"><?php the_category(" ",'',$post_id); ?></div>
                    </div>
                    <div class="rate">
                        <span><i class="fad fa-star"></i> تقييم</span>
                        <div class="items"><a href=""><?php echo get_post_meta($post_id,'rating',true); ?></a></div>
                    </div>
                    <?php display_taxonomy_terms("release_years", 'سنة الاصدار', 'fad fa-calendar-day','',$post_id); ?>
                    <?php display_taxonomy_terms("genres", 'نوع', 'fad fa-theater-masks', 'long',$post_id); ?>
                    <?php display_taxonomy_terms("directors", 'إنتاج', 'fad fa-camera-movie', 'long',$post_id); ?>
                    <?php display_taxonomy_terms("writers", 'تأليف', 'fad fa-feather','',$post_id); ?>
                </div>
            </div>
            <?php
            $rate = get_post_meta($post_id, 'imdb', true);
            if (!empty($rate)) { ?>
                <div class="rate"><span><i class="fad fa-star"></i> تقييم</span> <a><?php echo $rate; ?></a></div>
            <?php } ?>
        </div>


    </div>

<?php wp_reset_postdata();?>