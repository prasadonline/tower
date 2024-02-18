<?php
/**
 * Template Name: Blog Index
 * Description: The template for displaying the Blog index /blog.
 *
 */

get_header();

?>
    <div class="row">
        <h1 style="text-align: center; margin-bottom: 25px;">Insurance Website</h1>
        <div class="col-md-12">
            <h2>Insurance Policy</h2>
            <?php

            $API_URL = site_url().'/wp-json/wp/v2/insurance_policy';
            $request = wp_remote_get( $API_URL );
            $json_obj = json_decode(stripslashes($request['body']),);
            $json_array = json_decode(json_encode($json_obj), true);

            ?>
            <div class="clearfix"></div>
            <div class="row">
                <?php
                foreach ($json_array as $custom_post){
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'col-sm-6' ); ?>>
                        <div class="card mb-4">
                            <header class="card-body">
                                <h2 class="card-title">
                                    <a href="#" ><?php echo $custom_post['meta']['_insurance_policy_name'] ?></a>
                                </h2>
                            </header>
                            <div class="card-body">
                                <div class="card-text entry-content">
                                    <span><?php echo $custom_post['meta']['_insurance_policy_id'] ?></span><br>
                                    <span><?php echo $custom_post['meta']['_insurance_policy_description'] ?></span><br>
                                    <span><?php echo $custom_post['meta']['_insurance_policy_live_date'] ?></span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <?php
                }
                ?>

            </div>


        </div>
    </div>



<?php
get_footer();
