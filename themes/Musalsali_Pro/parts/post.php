<?php
// Get post data
$post_id = get_the_ID();
$post_type = get_post_type($post_id);
$thumbnail_url = get_the_post_thumbnail_url($post_id);
$permalink = get_permalink($post_id);
$release_year = get_the_terms($post_id, 'release_years')[0]->name ?? '';
$title_episode = get_the_title($post_id);

// Check if post type is 'episodes'
$is_episode = ($post_type === 'episodes');
$num_ep = get_post_meta($post_id,'_episode_number',true);

if ($is_episode) {
    $is_last_episode=get_post_meta($post_id,'_last_episode',true);
    $series_id=get_post_meta($post_id,'_episode_series',true);
    $thumbnail_url=get_the_post_thumbnail_url($series_id);
}

// Get IMDb rating
if ($is_episode) {
    $series_id = get_post_meta($post_id, 'id_name_series', true);
    $rate = get_post_meta($series_id, 'rating', true);
} else {
    $rate = get_post_meta($post_id, 'rating', true);
}

// Get category name
$category_name = get_the_category()[0]->name ?? '';
// Get genres
$genres = get_the_terms($is_episode?$series_id:$post_id, 'genres');
$genres_html = '';
if (!empty($genres)) {
    foreach ($genres as $term) {
        $genres_html .= '<span>' . esc_html($term->name) . '</span>';
    }
}
?>
<div class="item" style="background: url(<?php echo esc_url($thumbnail_url); ?>);">
    <a class="url_item" href="<?php echo esc_url($permalink); ?>"></a>
    <div class="info_item">
        <span class="year"><?php echo $release_year; ?> <i class="fas fa-projector"></i></span>
        <?php if ($is_episode&&$is_last_episode):?>
            <span class="final_eps">الأخيرة</span>
        <?php elseif ($is_episode):?>
        <span class="episode"><em>حلقة</em><?php echo $num_ep; ?></span>
        <?php endif;?>

        <?php if (!empty($rate??'')) { ?>
            <span class="rate"><?php echo esc_html($rate); ?><i class="fad fa-star"></i></span>
        <?php } ?>

        <span class="cat"><i class="far fa-tasks"></i> <?php echo esc_html($category_name); ?></span>
    </div>
    <div class="taxs">
        <?php echo $genres_html; ?>
    </div>
    <div class="title">
        <h4><?php echo esc_html($title_episode); ?></h4>
    </div>
</div>
