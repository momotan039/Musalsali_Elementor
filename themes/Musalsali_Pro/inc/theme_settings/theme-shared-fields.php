<?php
function upload_image_field($field_id, $type_field,$term_id=-1)
{
    if ($type_field == 'theme')
        $image = get_option($field_id, 'https://placehold.co/800');
    elseif ($type_field == 'taxonomy')
        $image = get_term_meta($term_id, $field_id, true) ?? 'https://placehold.co/800';
    ?>
    <input type="text" id="<?php echo $field_id ?>" name="<?php echo $field_id ?>" value="<?php echo esc_url($image); ?>" class="regular-text">
    <button type="button" class="button button-secondary" id="<?php echo $field_id . 'btn' ?>"><?php echo __('Upload Image','arabic-lang')?></button>
    <p class="description"><?php echo __('Upload or select an image','arabic-lang')?></p>
    <div id="<?php echo $field_id . '_preview' ?>" style="margin-top:10px;">
        <?php if ($image) : ?>
            <img src="<?php echo esc_url($image); ?>" style="max-width: 200px; height: auto;">
        <?php endif; ?>
    </div>
<?php
}
?>