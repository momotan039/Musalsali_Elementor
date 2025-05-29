<?php get_header(); 
if(get_post_type()=='episodes')
$series_id=get_post_meta(get_the_ID(),'_episode_series',true);
?>
<div class="container main_single">
    <?php get_template_part('parts/breadcrumb'); ?>
    <br>
    <?php get_template_part('parts/video-section') ?>
    <?php get_template_part('parts/episodes-section') ?>
    <?php get_template_part('parts/poster-info') ?>
</div>

<?php get_template_part('parts/actors-section'); ?>

<!-- <?php get_template_part('parts/related-posts'); ?> -->

<?php get_footer(); ?>
