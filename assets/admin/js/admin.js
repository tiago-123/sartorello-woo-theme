"use strict";

jQuery(document).ready(function ($) {
    $('.upload-media-button').click(function (e) {
        e.preventDefault();

        const $button = $(this);
        const target = $button.data('target');

        const mediaUploader = wp.media({
            multiple: false
        });

        mediaUploader.on('select', function () {
            const attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#' + target).val(attachment.id);
            $('.media-preview[data-field="' + target + '"]').attr('src', attachment.url);
        });

        mediaUploader.open();
    });
});
