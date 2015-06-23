<?php
/*
** Register MetaBox - Showcase
*/

function showcase_meta_box(){        
    add_meta_box('showcase_meta_box', __('More Info - Showcase', 'showcase-vc-addon'), 'create_shocase_meta_box', 'showcases', 'advanced', 'high');
}

function create_shocase_meta_box(){
    global $post;

    $vc_showcase_facebook = get_post_meta($post->ID, 'vc_showcase_facebook', true);
    $vc_showcase_google_plus = get_post_meta($post->ID, 'vc_showcase_google_plus', true);
    $vc_showcase_linkedin = get_post_meta($post->ID, 'vc_showcase_linkedin', true);
    $vc_showcase_custom_link = get_post_meta($post->ID, 'vc_showcase_custom_link', true);

    ?>
    <dl class="showcase-vc-addon-admin">
        <dd>
            <div class="label-showcase-vc-addon">
                <label for="vc-showcase-facebook"><?php _e('Facebook:', 'showcase-vc-addon');?></label>
            </div>
            <div class="input-showcase-vc-addon">
                <input type="text" name="vc_showcase_facebook" id="vc-showcase-facebook" value="<?php echo $vc_showcase_facebook;?>" />
                <em><?php _e("Please, don't forget to add <strong>http://</strong> in your link...", 'showcase-vc-addon');?></em>
            </div>
        </dd>
        <dd>
            <div class="label-showcase-vc-addon">
                <label for="vc-showcase-google-plus"><?php _e('Google Plus:', 'showcase-vc-addon');?></label>
            </div>
            <div class="input-showcase-vc-addon">
                <input type="text" name="vc_showcase_google_plus" id="vc-showcase-google-plus" value="<?php echo $vc_showcase_google_plus;?>" />
                <em><?php _e("Please, don't forget to add <strong>http://</strong> in your link...", 'showcase-vc-addon');?></em>
            </div>
        </dd>
        <dd>
            <div class="label-showcase-vc-addon">
                <label for="vc-showcase-linkedin"><?php _e('LinkedIn:', 'showcase-vc-addon');?></label>
            </div>
            <div class="input-showcase-vc-addon">
                <input type="text" name="vc_showcase_linkedin" id="vc-showcase-linkedin" value="<?php echo $vc_showcase_linkedin;?>" />
                <em><?php _e("Please, don't forget to add <strong>http://</strong> in your link...", 'showcase-vc-addon');?></em>
            </div>
        </dd>
        <dd>
            <div class="label-showcase-vc-addon">
                <label for="vc-showcase-custom-link"><?php _e('Custom Link:', 'showcase-vc-addon');?></label>
            </div>
            <div class="input-showcase-vc-addon">
                <input type="text" name="vc_showcase_custom_link" id="vc-showcase-custom-link" value="<?php echo $vc_showcase_custom_link;?>" />
                <em><?php _e("Please, don't forget to add <strong>http://</strong> in your link...", 'showcase-vc-addon');?></em>
            </div>
        </dd>
    </dl>

<?php
}

add_action( 'save_post', 'showcase_save_post', 1, 2 );

function showcase_save_post( $post_id, $post ) {

    if ( empty( $post_id ) || empty( $post ) || empty( $_POST ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( is_int( wp_is_post_revision( $post ) ) ) return;
    if ( is_int( wp_is_post_autosave( $post ) ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    if ( $post->post_type != 'showcases' ) return;

    update_post_meta($post->ID, 'vc_showcase_facebook', $_POST['vc_showcase_facebook']);
    update_post_meta($post->ID, 'vc_showcase_google_plus', $_POST['vc_showcase_google_plus']);
    update_post_meta($post->ID, 'vc_showcase_linkedin', $_POST['vc_showcase_linkedin']);
    update_post_meta($post->ID, 'vc_showcase_custom_link', $_POST['vc_showcase_custom_link']);

}