// Handle uploading image in WordPress form
jQuery(document).ready(function($) {
    function handleImageUpload( inputFieldId, title = 'Select Image') {
        $(inputFieldId+'btn').click(function(e) {
            e.preventDefault();

            var mediaUploader = wp.media({
                multiple: false
            });

            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $(inputFieldId).val(attachment.url);
                $(inputFieldId+'_preview').html('<img src="' + attachment.url + '" style="max-width: 200px; height: auto;">');
            });

            mediaUploader.open();
        });
    }

    // Initialize for multiple fields
    handleImageUpload('#movie_series_image');
    handleImageUpload('#wallpaper');
    handleImageUpload('#icon');
    handleImageUpload('#actor_image');
    handleImageUpload('#image_maintenance');
});
