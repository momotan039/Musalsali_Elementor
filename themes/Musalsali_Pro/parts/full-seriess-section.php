<?php
$post_type = get_post_type();
switch ($post_type) {
    case 'movies':
        $tax='movie_series';
        $seriess = get_the_terms(get_the_ID(), $tax)[0]->name??'';
        $title='شاهد باقي سلسلة';
        break;
    case 'seriess':
        $tax='season_series';
        $seriess = get_the_terms(get_the_ID(), $tax)[0]->name??'';
        $title='شاهد باقي مواسم';
        break;
    default:
        return;
}
if(!$seriess)return;
$query = new WP_Query(array("post_type" => array($post_type), 'post__not_in' => array(get_the_ID()), 'tax_query' => array(
    array(
        'taxonomy' => $tax,
        'field' => 'name',
        'terms' => $seriess,
    )
)));
if (!$query->have_posts())return;
?>
<div class="container all_seriess">
    <h1 class="title_block"><?php echo $title.' '.$seriess ?></h1>
    <div class="show_items">
        <?php
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('parts/post');
            }
        ?>
    </div>
</div>

<?php wp_reset_postdata();?>