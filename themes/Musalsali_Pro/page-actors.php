<!-- 
Template Name: Actors List Template
-->
<?php get_header();
$current_page = get_query_var("paged") == 0 ? 1 : get_query_var("paged");
$terms_per_page = get_option('posts_per_page'); // Number of terms per page

$offset = ($current_page - 1) * $terms_per_page;
$query_array=[
    'taxonomy' => 'actors',
    'hide_empty' => true,
    
];
if(isset($_GET['name_actor']))
$query_array['name__like']=$_GET['name_actor'];
// Fetch total count of terms
$total_terms = wp_count_terms('actors',$query_array);
// Calculate total pages
$total_pages = ceil($total_terms / $terms_per_page);
$actors = get_terms([...$query_array,'number' => $terms_per_page,'offset' => $offset]);
?>
<div class="container search_actor">
    <span>ابحث عن ممثل <i class="fal fa-theater-masks"></i></span>
    <form method="GET" action="<?php echo get_permalink().'/page/1'?>">
        <input placeholder="ابحث عن بطلك او بطلتك في مسلسلي...." type="text" name="name_actor" required>
        <button>بحث</button>
    </form>
</div>
<h1 class="container title_block">تصفح قائمة الممثلين</h1>
<div class="container show_items">
    <?php
    foreach ($actors as $term) {
        $bg_url = get_term_meta($term->term_id, "actor_image", true);
        echo '<div class="actors">
             <div class="' . ($bg_url ? '' : 'static_photo') . '" style="background-image: url(' . $bg_url . ');">
                <h3 class="name_actor">' . $term->name . '</h3>
                <a class="url_actor" href="' . get_term_link($term->term_id) . '"></a>
             </div>
          </div>';
    }
    ?>
</div>
<div class="container pagination">
    <?php
    // Display pagination links
    echo paginate_links(array(
        'base'      => str_replace(99999, '%#%', esc_url(get_pagenum_link(99999))),
        'format'    => '/page/%#%',
        'current'   => $paged,
        'total'     => $total_pages,
        'next_text' => '»',
        'prev_text' => '«',
    ));
    ?>
</div>

<?php get_footer() ?>