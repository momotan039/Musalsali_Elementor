<?php 
function add_video_urls_meta_box() {
    add_meta_box(
        'video_urls_meta_box',
        __('Video Sources', 'arabic-lang'),
        'render_video_urls_meta_box',
        array('movies', 'episodes'),
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_video_urls_meta_box');

function render_video_urls_meta_box($post) {
    $video_data = get_post_meta($post->ID, 'video_sources', true) ?: [];
    wp_nonce_field('save_video_urls_meta_box', 'video_urls_nonce');
    ?>
    <style>
        .video-url-item {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 10px;
        }
        .video-url-item input[type="text"] {
            width: 35%;
            padding: 6px;
        }
        .video-url-item label {
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .video-url-item input[type="checkbox"] {
            margin-left: 5px;
        }
        .remove-video-url {
            background: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        #add-video-url {
            background: green;
            color: white;
            padding: 8px 12px;
            margin-top: 10px;
            cursor: pointer;
        }
    </style>

    <div id="video-urls-container">
        <?php foreach ($video_data as $index => $video) : ?>
            <div class="video-url-item">
                <input type="text" name="video_sources[<?php echo $index; ?>][name]" value="<?php echo esc_attr($video['name']); ?>" placeholder="<?php echo __('Video Name', 'arabic-lang'); ?>" />
                <input type="text" name="video_sources[<?php echo $index; ?>][url]" value="<?php echo $video['url']; ?>" placeholder="<?php echo __('Video URL', 'arabic-lang'); ?>" />
                <button type="button" class="remove-video-url"><?php echo __('Remove', 'arabic-lang'); ?></button>
            </div>
        <?php endforeach; ?>
    </div>
    
    <button type="button" id="add-video-url"><?php echo __('Add Video Source', 'arabic-lang'); ?></button>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let container = document.getElementById("video-urls-container");
            let addButton = document.getElementById("add-video-url");

            addButton.addEventListener("click", function() {
                let index = document.querySelectorAll(".video-url-item").length;
                let div = document.createElement("div");
                div.classList.add("video-url-item");
                div.innerHTML = `
                    <input type="text" name="video_sources[${index}][name]" placeholder="<?php echo __('Video Name', 'arabic-lang'); ?>" />
                    <input type="text" name="video_sources[${index}][url]" placeholder="<?php echo __('Video URL', 'arabic-lang'); ?>" />
                    <button type="button" class="remove-video-url"><?php echo __('Remove', 'arabic-lang'); ?></button>`;
                container.appendChild(div);
            });

            container.addEventListener("click", function(event) {
                if (event.target.classList.contains("remove-video-url")) {
                    event.target.parentElement.remove();
                }
            });
        });
    </script>
    <?php
}

function save_video_urls_meta_box($post_id) {
    if (!isset($_POST['video_urls_nonce']) || !wp_verify_nonce($_POST['video_urls_nonce'], 'save_video_urls_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['video_sources'])) {
        $video_data = [];

        foreach ($_POST['video_sources'] as $video) {
            if (!empty($video['url'])) {
                $video_data[] = [
                    'name'  => sanitize_text_field($video['name']),
                    'url'   => $video['url'],
                ];
            }
        }

        update_post_meta($post_id, 'video_sources', $video_data);
    } else {
        delete_post_meta($post_id, 'video_sources');
    }
}
add_action('save_post', 'save_video_urls_meta_box');
?>
