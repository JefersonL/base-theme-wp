<?php
get_header();
?>

<div class="container">
    <div class="error-404 not-found">
        <main id="main" class="site-main">
            <div class="page-content">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e('Oops! Page not found.', 'base-theme-wp'); ?></h1>
                </header>

                <div class="error-content">
                    <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'base-theme-wp'); ?></p>
                    
                    <?php get_search_form(); ?>

                    <div class="error-suggestions">
                        <h2><?php esc_html_e('Here are some helpful links:', 'base-theme-wp'); ?></h2>
                        
                        <div class="suggestion-grid">
                            <!-- Posts Recentes -->
                            <div class="suggestion-section">
                                <h3><?php esc_html_e('Recent Posts', 'base-theme-wp'); ?></h3>
                                <ul>
                                    <?php
                                    $recent_posts = wp_get_recent_posts(array(
                                        'numberposts' => 5,
                                        'post_status' => 'publish'
                                    ));
                                    
                                    foreach ($recent_posts as $recent) {
                                        printf(
                                            '<li><a href="%1$s">%2$s</a></li>',
                                            esc_url(get_permalink($recent['ID'])),
                                            esc_html($recent['post_title'])
                                        );
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </ul>
                            </div>

                            <!-- Categorias Populares -->
                            <div class="suggestion-section">
                                <h3><?php esc_html_e('Popular Categories', 'base-theme-wp'); ?></h3>
                                <ul>
                                    <?php
                                    wp_list_categories(array(
                                        'orderby'    => 'count',
                                        'order'      => 'DESC',
                                        'show_count' => 1,
                                        'title_li'   => '',
                                        'number'     => 5
                                    ));
                                    ?>
                                </ul>
                            </div>

                            <!-- Links Úteis -->
                            <div class="suggestion-section">
                                <h3><?php esc_html_e('Useful Links', 'base-theme-wp'); ?></h3>
                                <ul>
                                    <li><a href="<?php echo esc_url(home_url('/')); ?>">
                                        <?php esc_html_e('Home Page', 'base-theme-wp'); ?>
                                    </a></li>
                                    <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
                                        <?php esc_html_e('Blog', 'base-theme-wp'); ?>
                                    </a></li>
                                    <?php
                                    // Menu de navegação da página 404
                                    wp_nav_menu(array(
                                        'theme_location' => 'footer',
                                        'container'      => false,
                                        'items_wrap'     => '%3$s',
                                        'depth'          => 1,
                                    ));
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php
get_footer();