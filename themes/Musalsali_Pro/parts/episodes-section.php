<?php

global $wp, $series_id;
$current_page = home_url(add_query_arg(array(), $wp->request)) . "/";
$post_id = isset($series_id) ? $series_id : get_the_ID();
$query_episodes = new WP_Query([
   "orderby" => "asc",
   "meta_value" => $post_id,
   "meta_key" => "_episode_series",
   "post_type" => "episodes",
   'posts_per_page' => -1
]);



if (!$query_episodes->have_posts())
   return;

$episodes = [];
while ($query_episodes->have_posts()) {
   $query_episodes->the_post();
   $episode_number = get_post_meta(get_the_ID(), '_episode_number', true);
   $episodes[$episode_number] = get_the_ID();
}
// krsort($episodes);
wp_reset_query();
?>

<div class="container">

   <div class="eps_container">
      <?php 
      if(get_post_type()=='episodes'):
      ?>
      <div class="next_prev_eps">
         <span class="next_eps"><a href="#"></a><i class="fad fa-angle-double-right"></i> الحلقة التالية</span>
         <span class="prev_eps"><a href="#"></a>الحلقة السابقة <i class="fad fa-angle-double-left"></i></span>
      </div>
      <?php 
      endif;
      ?>
      <div>
      <h1 class="title_block">حلقات المسلسل</h1>
      <div class="all_episodes">
         <?php foreach ($episodes as $ep_number => $ep_id): ?>
            <span <?php if (get_the_permalink($ep_id) == $current_page) echo "class='active'"; ?>>
               <a href="<?php the_permalink($ep_id); ?>"></a><em>الحلقة</em><?php echo $ep_number; ?>
            </span>
         <?php endforeach; ?>
      </div>
      </div>
   </div>
</div>