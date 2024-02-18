</main><!-- /#main -->
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p><?php printf( esc_html__( '&copy; %1$s %2$s. All rights reserved.', 'tower' ), wp_date( 'Y' ), get_bloginfo( 'name', 'display' ) ); ?></p>
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
</footer><!-- /#footer -->
</div><!-- /#wrapper -->
<?php
wp_footer();
?>
</body>
</html>
