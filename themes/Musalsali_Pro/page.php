<?php get_header(); ?>
<div class="show_items container">
<?php
the_content();
     ?>
</div>
<?php 
get_template_part('parts/pagination');
get_footer(); ?>