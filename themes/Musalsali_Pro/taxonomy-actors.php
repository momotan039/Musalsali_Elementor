<?php get_header();
 
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$query=new WP_Query(array("post_type"=>array("movies","seriess"),"tax_query"=>array(
    array(
        "taxonomy"=>"actors",
    "field"=>"slug",
    "terms"=>$term->slug
    )
)));

$bg_ground_url=get_term_meta($term->term_id  ,"actor_image",true);
?>
   <div class="container">
      
         <div class="actor_profile">
         <div class="actor <?php if($bg_ground_url=='') echo 'static_photo';?>" style="background-image: url('<?php echo $bg_ground_url;?>');">
            </div>

            <div class="info_actor">
             <div><span><i class="fad fa-user-visor"></i> عدد الزوار </span>
             <span><?php echo get_specific_taxonomy_views($term->term_id);?></span></div>
             <div><span><i class="far fa-badge-check"></i> عدد الاعمال</span>
            <span><?php echo $query->found_posts;?></span>
            </div>
         </div>
         </div>
   </div>
<h1 class="title_block container">جميع اعمال <?php echo $term->name; ?></h1>
<div class="container show_items">

    <?php
    while (have_posts()) {
        the_post();
        get_template_part('parts/post')
    ?>
        
    <?php
    }
   
    ?>

</div>
<?php get_template_part('parts/pagination');?>
<?php get_footer();?>