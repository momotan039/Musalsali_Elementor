<?php get_header(); ?>
<div class="container main_single">
    <?php get_template_part('parts/breadcrumb'); ?>
    <br>
    <?php get_template_part('parts/video-section') ?>
    <?php get_template_part('parts/poster-info') ?>
</div>

<?php get_template_part('parts/full-seriess-section'); ?>
<?php get_template_part('parts/actors-section'); ?>

<?php get_template_part('parts/related-posts'); ?>

<?php get_footer(); ?>
