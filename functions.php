<?php

/*
 * Adding bootstrap CSS/JS
 */
function reg_scripts() {
    wp_enqueue_style( 'bootstrapstyle', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'bootstrapthemestyle', get_template_directory_uri() . '/css/bootstrap-theme.min.css' );
    wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', array(), true );
}
add_action('wp_enqueue_scripts', 'reg_scripts');

/*
 * Registering Menu
 */
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
            'main-menu'   => 'Main Navigation Menu'
        )
    );
}


// Start of Insurance Policy Custom meta

/**
 * Register Custom Post Type -Insurance Policy
 * @return void
 */
function insurance_policy() {

    $labels = array(
        'name'                  => _x( 'Insurance Policies', 'Post Type General Name', 'tower' ),
        'singular_name'         => _x( 'Insurance Policy', 'Post Type Singular Name', 'tower' ),
        'menu_name'             => __( 'Insurance Policy Types', 'tower' ),
        'name_admin_bar'        => __( 'Insurance Policy Type', 'tower' ),
        'archives'              => __( 'Insurance Policy Archives', 'tower' ),
        'attributes'            => __( 'Insurance Policy Attributes', 'tower' ),
        'parent_item_colon'     => __( 'Parent Item:', 'tower' ),
        'all_items'             => __( 'All Items', 'tower' ),
        'add_new_item'          => __( 'Add New Insurance Policy', 'tower' ),
        'add_new'               => __( 'Add New', 'tower' ),
        'new_item'              => __( 'New Insurance Policy', 'tower' ),
        'edit_item'             => __( 'Edit Insurance Policy', 'tower' ),
        'update_item'           => __( 'Update Insurance Policy', 'tower' ),
        'view_item'             => __( 'View Insurance Policy', 'tower' ),
        'view_items'            => __( 'View Insurance Policy', 'tower' ),
        'search_items'          => __( 'Search Insurance Policy', 'tower' ),
        'not_found'             => __( 'Not found', 'tower' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'tower' ),
        'featured_image'        => __( 'Featured Image', 'tower' ),
        'set_featured_image'    => __( 'Set featured image', 'tower' ),
        'remove_featured_image' => __( 'Remove featured image', 'tower' ),
        'use_featured_image'    => __( 'Use as featured image', 'tower' ),
        'insert_into_item'      => __( 'Insert into Insurance Policy', 'tower' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Insurance Policy', 'tower' ),
        'items_list'            => __( 'Items list', 'tower' ),
        'items_list_navigation' => __( 'Items list navigation', 'tower' ),
        'filter_items_list'     => __( 'Filter items list', 'tower' ),
    );
    $rewrite = array(
        'slug'                  => 'insurance_policy',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Insurance Policy', 'tower' ),
        'description'           => __( 'Insurance Policy Description', 'tower' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'custom-fields' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-products',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'insurance_policy', $args );

}
add_action( 'init', 'insurance_policy', 0 );


/**
 * Add meta box
 * @param $post
 * @return void
 */
function insurance_policy_meta_boxes( $post ){
    add_meta_box( 'insurance_policy_meta_box', __( 'Insurance Policy Details', 'tower' ), 'insurance_policy_build_meta_box', 'insurance_policy', 'normal', 'high' );
}
add_action( 'add_meta_boxes_insurance_policy', 'insurance_policy_meta_boxes' );

/**
 * Meta box UI
 * @param $post
 * @return void
 */
function insurance_policy_build_meta_box( $post ){

    // make sure the form request comes from WordPress
    wp_nonce_field( basename( __FILE__ ), 'insurance_policy_meta_box_nonce' );

    $insurance_policy_name = get_post_meta( $post->ID, '_insurance_policy_name', true);
    $insurance_policy_id = get_post_meta( $post->ID, '_insurance_policy_id', true);
    $insurance_policy_live_date = get_post_meta( $post->ID, '_insurance_policy_live_date', true);
    $insurance_policy_description = get_post_meta( $post->ID, '_insurance_policy_description', true);
    ?>

    <div class='inside'>
        <p>
            <label>Policy Name<sup style="color: red">*</sup></label>
            <input type="text" name="insurance_policy_name" value="<?php echo $insurance_policy_name; ?>" required/>
        </p>
        <p>
            <label>Policy ID<sup style="color: red">*</sup></label>
            <input type="text" name="insurance_policy_id" value="<?php echo $insurance_policy_id; ?>" required/>
        </p>
        <p>
            <label>Live Date <sup style="color: red">*</sup></label>
            <input type="date" name="insurance_policy_live_date" value="<?php echo $insurance_policy_live_date; ?>" required/>
        </p>
        <p>
            <label>Description</label>
            <textarea type="date" name="insurance_policy_description" > <?php echo $insurance_policy_description; ?></textarea>
        </p>
    </div>
<?php }

/**
 * Save meta box data
 * @param $post_id
 * @return void
 */
function insurance_policy_save_meta_box_data( $post_id ){
    if ( !isset( $_POST['insurance_policy_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['insurance_policy_meta_box_nonce'], basename( __FILE__ ) ) ){
        return;
    }
    if ( isset( $_REQUEST['insurance_policy_name'] ) ) {
        update_post_meta( $post_id, '_insurance_policy_name', sanitize_text_field( $_POST['insurance_policy_name'] ) );
    }

    if ( isset( $_REQUEST['insurance_policy_id'] ) ) {
        update_post_meta( $post_id, '_insurance_policy_id', sanitize_text_field( $_POST['insurance_policy_id'] ) );
    }
    if ( isset( $_REQUEST['insurance_policy_live_date'] ) ) {
        update_post_meta( $post_id, '_insurance_policy_live_date', sanitize_text_field( $_POST['insurance_policy_live_date'] ) );
    }
    if ( isset( $_REQUEST['insurance_policy_description'] ) ) {
        update_post_meta( $post_id, '_insurance_policy_description', sanitize_text_field( $_POST['insurance_policy_description'] ) );
    }

}
add_action( 'save_post_insurance_policy', 'insurance_policy_save_meta_box_data', 10, 2 );


// End of Insurance Policy Custom meta
// Start of Insurance Policy Claim Custom meta


/**
 * Register Custom Post Type -Insurance Policy Claim
 * @return void
 */
function insurance_claim() {

    $labels = array(
        'name'                  => _x( 'Insurance Policy Claims', 'Post Type General Name', 'tower' ),
        'singular_name'         => _x( 'Insurance Policy Claim', 'Post Type Singular Name', 'tower' ),
        'menu_name'             => __( 'Insurance Policy Claim Types', 'tower' ),
        'name_admin_bar'        => __( 'Insurance Policy Claim Type', 'tower' ),
        'archives'              => __( 'Insurance Policy Claim Archives', 'tower' ),
        'attributes'            => __( 'Insurance Policy Claim Attributes', 'tower' ),
        'parent_item_colon'     => __( 'Parent Item:', 'tower' ),
        'all_items'             => __( 'All Items', 'tower' ),
        'add_new_item'          => __( 'Add New Insurance Policy', 'tower' ),
        'add_new'               => __( 'Add New', 'tower' ),
        'new_item'              => __( 'New Insurance Policy Claim', 'tower' ),
        'edit_item'             => __( 'Edit Insurance Policy Claim', 'tower' ),
        'update_item'           => __( 'Update Insurance Policy Claim', 'tower' ),
        'view_item'             => __( 'View Insurance Policy Claim', 'tower' ),
        'view_items'            => __( 'View Insurance Policy Claim', 'tower' ),
        'search_items'          => __( 'Search Insurance Policy Claim', 'tower' ),
        'not_found'             => __( 'Not found', 'tower' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'tower' ),
        'featured_image'        => __( 'Featured Image', 'tower' ),
        'set_featured_image'    => __( 'Set featured image', 'tower' ),
        'remove_featured_image' => __( 'Remove featured image', 'tower' ),
        'use_featured_image'    => __( 'Use as featured image', 'tower' ),
        'insert_into_item'      => __( 'Insert into Insurance Policy Claim', 'tower' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Insurance Policy Claim', 'tower' ),
        'items_list'            => __( 'Items list', 'tower' ),
        'items_list_navigation' => __( 'Items list navigation', 'tower' ),
        'filter_items_list'     => __( 'Filter items list', 'tower' ),
    );
    $rewrite = array(
        'slug'                  => 'insurance_claim',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Insurance Policy Claim', 'tower' ),
        'description'           => __( 'Insurance Policy Claim Description', 'tower' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'custom-fields' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-media-text',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'insurance_claim', $args );

}
add_action( 'init', 'insurance_claim', 0 );


/**
 * Add meta box
 * @param $post
 * @return void
 */
function insurance_claim_meta_boxes( $post ){
    add_meta_box( 'insurance_claim_meta_box', __( 'Insurance Policy Claim Details', 'tower' ), 'insurance_claim_build_meta_box', 'insurance_claim', 'normal', 'high' );
}
add_action( 'add_meta_boxes_insurance_claim', 'insurance_claim_meta_boxes' );

/**
 * Meta box UI
 * @param $post
 * @return void
 */
function insurance_claim_build_meta_box( $post ){

    // make sure the form request comes from WordPress
    wp_nonce_field( basename( __FILE__ ), 'insurance_claim_meta_box_nonce' );

    $insurance_claim_id = get_post_meta( $post->ID, '_insurance_claim_id', true);
    $insurance_claim_name = get_post_meta( $post->ID, '_insurance_claim_name', true);
    $insurance_claim_email = get_post_meta( $post->ID, '_insurance_claim_email', true);
    ?>

    <div class='inside'>
        <p>
            <label>Policy ID<sup style="color: red">*</sup></label>
            <input type="text" name="insurance_claim_id" value="<?php echo $insurance_claim_id; ?>" required/>
        </p>
        <p>
            <label>Name<sup style="color: red">*</sup></label>
            <input type="text" name="insurance_claim_name" value="<?php echo $insurance_claim_name; ?>" required/>
        </p>
        <p>
            <label>Email<sup style="color: red">*</sup></label>
            <input type="email" name="insurance_claim_email" value="<?php echo $insurance_claim_email; ?>" required/>
        </p>
    </div>
<?php }

/**
 * Save meta box data
 * @param $post_id
 * @return void
 */
function insurance_claim_save_meta_box_data( $post_id ){
    if ( !isset( $_POST['insurance_claim_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['insurance_claim_meta_box_nonce'], basename( __FILE__ ) ) ){
        return;
    }
    if ( isset( $_REQUEST['insurance_claim_id'] ) ) {
        update_post_meta( $post_id, '_insurance_claim_id', sanitize_text_field( $_POST['insurance_claim_id'] ) );
    }

    if ( isset( $_REQUEST['insurance_claim_name'] ) ) {
        update_post_meta( $post_id, '_insurance_claim_name', sanitize_text_field( $_POST['insurance_claim_name'] ) );
    }
    if ( isset( $_REQUEST['insurance_claim_email'] ) ) {
        update_post_meta( $post_id, '_insurance_claim_email', sanitize_text_field( $_POST['insurance_claim_email'] ) );
    }

}
add_action( 'save_post_insurance_claim', 'insurance_claim_save_meta_box_data', 10, 2 );



// End of Insurance Policy Claim Custom meta