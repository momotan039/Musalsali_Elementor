<div class="container Pro_Serach">
    <div class="filter">
        <form action="<?php echo get_custom_search_page_url(); ?>">
            <span>تصفية سريعة <i class="fas fa-telescope"></i></span>
        </div>

        <?php
        /**
         * Function to render filter lists dynamically.
         * @param string $taxonomy The taxonomy slug (e.g., category, genres, release_years).
         * @param string $label The label to display.
         * @param string $query_param The GET parameter name (e.g., cats, genres, years).
         */
        function render_filter_section($taxonomy, $label, $query_param) {
            $terms = get_terms(array("taxonomy" => $taxonomy));
            $selected_terms = isset($_GET[$query_param]) ? explode(",", $_GET[$query_param]) : [];

            if (!empty($terms)) {
                echo "<div class='{$taxonomy}_show'>";
                echo "<span>{$label}</span>";
                echo "<ul>";

                foreach ($terms as $term) {
                    $checked_class = in_array($term->name, $selected_terms) ? "class='checked'" : "";
                    echo "<li {$checked_class}>{$term->name}</li>";
                }

                echo "</ul>";
                echo "<input type='hidden' name='{$query_param}' value='" . esc_attr($_GET[$query_param] ?? "") . "'>";
                echo "</div>";
            }
        }

        // Render filters
        render_filter_section("category", "فئة العرض", "cats");
        render_filter_section("genres", "نوع العرض", "genres");
        render_filter_section("release_years", "سنة اصدار العرض", "years");
        ?>

        <button>بحث</button>
    </form>
</div>
