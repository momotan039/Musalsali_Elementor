<?php get_header(); 
$term = get_queried_object(); 
?>
<?php get_template_part('parts/pro-search-filter')?>
<h1 class="container title_block">تصفح <?php echo $term->name;?></h1>
<div class="container show_items">
    <?php
    while (have_posts()) {
        the_post();
        get_template_part('parts/post');
    }
    ?>
</div>
<div class="container pagination">
<?php
      get_template_part('parts/pagination')
?>
</div>

<?php get_footer( )?>