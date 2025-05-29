<?php get_header(); ?>
<?php get_template_part('parts/pro-search-filter')?>
<div class="show_items container">
<?php

while(have_posts(  )){
    the_post(  );
    get_template_part('parts/post');
}
     ?>
</div>
<?php 
get_template_part('parts/pagination');
get_footer(); ?>