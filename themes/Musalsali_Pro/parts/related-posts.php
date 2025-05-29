<?php
$terms = get_the_terms($post->id, "genres");
$all_genres = array();
$tax_query_arr = [];
if ($terms) {
   foreach ($terms as $term) {
      array_push($all_genres, $term->term_id);
   }
   $tax_query_arr[] = array(
      array(
         'taxonomy' => 'genres',
         'field'    => 'term_id',
         'terms'    =>  $all_genres ?? [],
      )
   );
}

$query = new WP_Query(array(
   'tax_query' => $tax_query_arr,
   "post__not_in" => array(get_the_ID()),
   "post_type" => get_post_type(),
   "cat" => get_the_category()[0]->term_id??-1,
   "posts_per_page" => 6
));
if (!$query->have_posts()) return;
?>

<div class="relative_posts container">
   <h1 class="title_block">عروض اخرى قد تنال اعجابك</h1>
   <div class="show_items">
      <?php
      while ($query->have_posts()) {
         $query->the_post();
         get_template_part('parts/post');
      }
      ?>
   </div>
</div>