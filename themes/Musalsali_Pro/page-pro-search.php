<!-- 
Template Name: Pro Search Template
-->

<?php get_header(); ?>
<?php get_template_part('parts/pro-search-filter')?>
<div class="show_items container">
            <?php
        $array_taxs=array("relation"=>"AND");
        if(isset($_GET["cats"]))
        array_push($array_taxs,array(
            "taxonomy"=>"category",
            "field"=>"name",
            "terms"=>explode(",",$_GET["cats"]),  
        ));
        if(isset($_GET["genres"]))
        array_push($array_taxs,array(
            "taxonomy"=>"genres",
            "field"=>"name",
            "terms"=>explode(",",$_GET["genres"]),
        ));
        if(isset($_GET["years"]))
        array_push($array_taxs,array(
            "taxonomy"=>"release_years",
            "field"=>"name",
            "terms"=>explode(",",$_GET["years"]),  
        ));
        
        $current_page=get_query_var("paged")==0?1:get_query_var("paged");
        $offset = ( $current_page-1 )*get_option('posts_per_page');
        $query=new WP_Query(array("offset"=>$offset,"post_type"=>array("seriess","movies"),"tax_query"=>$array_taxs));
            if($query->have_posts(  )){
            while($query->have_posts(  )){
                $query->the_post();
                get_template_part('parts/post');
            }}
            else{
                ?>
                <h1><i class="fas fa-frown-open"></i> لا يوجد عروض بهذه المواصفات <i class="fas fa-frown-open"></i></h1>
                <?php
            }
            ?>
</div>

<?php get_template_part('parts/pagination');get_footer(); ?>