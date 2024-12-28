    <footer class="site-footer">
        <div class="container">
            <?php
            if (has_nav_menu('footer')) {
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class' => 'footer-menu',
                    'container' => 'nav',
                    'container_class' => 'footer-navigation'
                ));
            }
            ?>
            <div class="site-info">
                <?php echo '&copy; ' . date('Y') . ' ' . get_bloginfo('name'); ?>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>
