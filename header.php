<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div id="wrapper">
    <header>
        <nav id="header" class="navbar navbar-expand-md  navbar-light bg-light fixed_top">
            <div class="container">
                <a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                    <?php
                    echo esc_attr( get_bloginfo( 'name', 'display' ) );
                    ?>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'tower' ); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div id="navbar" class="collapse navbar-collapse">
                    <?php
                    // Loading WordPress Custom Menu (theme_location).
                    wp_nav_menu(
                        array(
                            'menu_class'     => 'navbar-nav me-auto',
                            'theme_location' => 'main-menu',
                        )
                    );
                    ?>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav><!-- /#header -->
    </header>
    <main id="main" class="container" style="padding-top: 100px;">
