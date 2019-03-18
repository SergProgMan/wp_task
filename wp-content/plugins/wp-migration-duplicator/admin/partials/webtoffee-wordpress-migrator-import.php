<div class="bg-white">
    <?php
    // jQuery
    wp_enqueue_script('jquery');
    // This will enqueue the Media Uploader script
    wp_enqueue_media();
    ?>
    <form method="post" name="cleanup_options" action="options.php">
        <div>
            <label for="attachment_url"><?php _e('Select Migration File', 'wp-migration-duplicator') ?></label> <br><br>
            <span><i style="color:#07a"><?php _e('Bypass Upload limit: Please upload a small zip file into media library and replace that file through FTP with actual backup zip and browse through media library. :)', 'wp-migration-duplicator') ?></i></span><br><br>
            <input required style="display: none" type="text" name="attachment_url" id="attachment_url" class="regular-text">
            <h4 id="link" style="color: #0085ba"></h4>
            <input type="button" name="upload-btn" id="upload-btn" class="button-secondary"
                   value="<?php _e('Upload Migration Package', 'wp-migration-duplicator') ?>"> <br><br>
        </div>
        <input id="import" type="submit" class="button button-primary" value="<?php _e('Import', 'wp-migration-duplicator') ?>">
    </form>
    <br>
    <h3  id="progress_info"></h3>
    <div id="import_progress" style="display: none">
        <p><?php _e('Progress', 'wp-migration-duplicator') ?>:
            <progress id="bar" value="0" max="100"></progress>
        </p>
        <p>
            <span id="percentage"></span> %
        </p>
    </div>
</div>
