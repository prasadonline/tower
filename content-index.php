<?php
/**
 * The template for displaying content in the index.php template.
 */

$args = array(
    'post_type' => 'insurance_claim',
    'posts_per_page' => -1,
    'order' => 'ASC'
);
$the_query = new WP_Query($args);
?>
<?php if ( $the_query->have_posts() ) : ?>
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'col-sm-6' ); ?>>
            <div class="card mb-4">
                <header class="card-body">
                    <h2 class="card-title">
                        <a href="#" ><?php echo get_post_meta(get_the_ID(), "_insurance_claim_id", true) ?></a>
                    </h2>
                </header>
                <div class="card-body">
                    <div class="card-text entry-content">
                        <span><?php echo get_post_meta(get_the_ID(), "_insurance_claim_name", true) ?></span><br>
                        <span><?php echo get_post_meta(get_the_ID(), "_insurance_claim_email", true) ?></span>
                    </div>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>
