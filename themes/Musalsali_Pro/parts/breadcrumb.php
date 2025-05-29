<?php
// Display Taxonomy Terms
global $series_id;
$post_id = isset($series_id) ? $series_id : get_the_ID();
?>
<div class="crumb">
   <ul>
      <li><a href="<?php echo get_home_url(); ?>"><i class="fad fa-home"></i> الرئيسية</a></li>
      <i class="fad fa-arrow-alt-left"></i>
      <li><?php the_category(" ", '', $post_id); ?></li>
      <i class="fad fa-arrow-alt-left"></i>
      <?php
      if (isset($series_id)):
      ?>
         <li><a href="<?php echo get_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></li>
         <i class="fad fa-arrow-alt-left"></i>
      <?php
      endif;
      ?>

      <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
   </ul>
</div>