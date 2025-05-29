<?php 
global $series_id;
$post_id=isset($series_id)?$series_id:get_the_ID();
if (!has_term("", "actors",$post_id)) return;
echo '<h1 class="container title_block">قائمة الممثلين</h1>';
echo '<div class="container show_items actors_container">';
foreach (get_the_terms($post_id, 'actors') as $term) {
   $bg_url = get_term_meta($term->term_id, "actor_image", true);
   echo '<div class="actors">
            <div class="' . ($bg_url ? '' : 'static_photo') . '" style="background-image: url(' . $bg_url . ');">
               <h3 class="name_actor">' . $term->name . '</h3>
               <a class="url_actor" href="' . get_term_link($term->term_id) . '"></a>
            </div>
         </div>';
}
echo '</div>';
?>