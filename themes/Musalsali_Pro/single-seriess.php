<?php
get_header();
?>
<div class="container main_single">
   <?php get_template_part('parts/breadcrumb'); ?>
   <?php get_template_part('parts/poster-info');?>
   <?php get_template_part('parts/episodes-section');?>
   <?php get_template_part('parts/full-seriess-section'); ?>
   <?php get_template_part('parts/actors-section'); ?>
   <?php get_template_part('parts/related-posts'); ?>
</div>
<?php get_footer(); ?>
