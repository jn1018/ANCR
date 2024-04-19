<?php
/**
 * Fires after the main content, before the footer is output.
 *
 * @since 3.10
 */
do_action( 'et_after_main_content' );

if ( 'on' === et_get_option( 'divi_back_to_top', 'false' ) ) : ?>

    <span class="et_pb_scroll_top et-pb-icon"></span>

<?php endif;

if ( ! is_page_template( 'page-template-blank.php' ) ) : ?>

    <footer id="main-footer">

        <div class="footer-container">

        <?php get_sidebar( 'footer' ); ?>

            <div id="ancr-footer-copyright" class="footer-order-1">
                <div class="container">
                    &copy; <?= date('Y') ?> Alliance for National & Community Resilience<span style="font-size: 10px">&reg;</span>
                    <br />
                    <a class="copyright-link" href="/the-benchmarks">Developer of Community Resilience Benchmarks<span style="font-size: 10px">&reg;</span></a>
                </div>
            </div> <!-- #ancr-footer-copyright -->
        <?php
        if ( has_nav_menu( 'footer-menu' ) ) : ?>
            <div id="et-footer-nav" class="footer-order-2">
                <div class="container">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer-menu',
                        'depth'          => '1',
                        'menu_class'     => 'bottom-nav',
                        'container'      => '',
                        'fallback_cb'    => '',
                    ) );
                    ?>
                </div>
            </div> <!-- #et-footer-nav -->
        <?php endif; ?>
        <!-- Partner Logos -->
        <div id="ancr-partners" class="footer-order-3">
            <div class="container">
                <p>ANCR is a joint initiative of</p>
                <ul>
                    <li>
                        <a href="https://iccsafe.org" target="_blank"><img src="/wp-content/uploads/footer-logo.png" border="0" alt="ICC" /></a>
                    </li>
                    <li>
                        <a href="http://usrc.org/" target="_blank"><img src="/wp-content/uploads/usrc-70-1.png" border="0" alt="USRC" /></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Social Media Icons -->
        <div id="ancr-social-icons" class="footer-order-4">
            <div class="container">
                <div class="row footer-social-icons">
                    <a href="<?= EXTERNAL_URLS['LINKEDIN']; ?>" class="fa footer-linkedin" target="_blank">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </a>
                    <a href="<?= EXTERNAL_URLS['TWITTER']; ?>" class="fa footer-twitter" target="_blank">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div> <!-- #ancr-social-icons -->

        </div> <!-- /.footer-container -->

        </footer> <!-- #main-footer -->
    </div> <!-- #et-main-area -->

<?php endif; // ! is_page_template( 'page-template-blank.php' ) ?>

</div> <!-- #page-container -->

<?php wp_footer(); ?>
</body>
</html>
