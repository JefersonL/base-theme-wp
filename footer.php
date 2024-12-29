    </main><!-- #main -->

<footer class="site-footer">
    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">
                <!-- Logo -->
                <div class="footer-brand">
                    <?php
                        $footer_logo = get_theme_mod('footer_logo');
                            if ($footer_logo) {
                             echo '<img src="' . esc_url($footer_logo) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                            } else {
                                if (has_custom_logo()) {
                                    the_custom_logo();
                                } else {
                                    echo '<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a></h1>';
                                }
                            }
                    ?>        
                </div>

                <!-- Menu -->
                <nav class="footer-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'footer-menu',
                        'container'      => false,
                    ));
                    ?>
                </nav>

                <!-- Redes Sociais e Contato -->
                <div class="footer-social-contact">
                    <nav class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </nav>
                    <div class="footer-contact">
                        <address>
                            <p><i class="fas fa-map-marker-alt"></i> <span>Rua Exemplo, 123 - Cidade, Estado</span></p>
                            <p><i class="fas fa-phone"></i> <span>(00) 0000-0000</span></p>
                            <p><i class="fas fa-envelope"></i> <span>contato@exemplo.com</span></p>
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="copyright">
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos os direitos reservados.
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
