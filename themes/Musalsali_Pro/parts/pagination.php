<div class="container pagination">
    <?php
    global $query;
    $custom_query=isset($query)?$query:$wp_query;
     echo paginate_links(array(
        "base"      => str_replace(99999, "%#%", esc_url(get_pagenum_link(99999))),
        "format"    => "/page/%#%",
        "current"   => max(1, $paged), // Use $paged instead of get_query_var()
        "total"     => $custom_query->max_num_pages,
        "next_text" => "»",
        "prev_text" => "«",
    ));
    ?>
</div>