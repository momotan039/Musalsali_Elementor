<!-- 
Template Name: Movies Seriess 
-->

<?php

get_header(); ?>
<?php get_template_part('parts/pro-search-filter') ?>
<div class="show_items container">
    <?php
    $terms = get_terms(array("taxonomy" => 'movie_series'));
    foreach ($terms as $term):
    ?>
        <div class="item" style="background: url(<?php echo get_term_meta($term->term_id,'movie_series_image')[0]; ?>);">
            <a class="url_item" href="<?php echo(get_term_link($term->term_id)) ?>"></a>
            <div class="title bottom">
                <h4><?php echo esc_html($term->name); ?></h4>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php
get_template_part('parts/pagination');
get_footer(); ?>