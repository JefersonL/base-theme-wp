<?php
/**
 * The sidebar containing the main widget area
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area">
    <?php
    // Área de widgets principal
    dynamic_sidebar('sidebar-1');
    
    // Área de busca
    if (!is_search()) : ?>
        <div class="widget widget_search">
            <h2 class="widget-title"><?php esc_html_e('Search', 'base-theme-wp'); ?></h2>
            <?php get_search_form(); ?>
        </div>
    <?php endif;

    // Posts Recentes
    $recent_posts = wp_get_recent_posts(array(
        'numberposts' => 5,
        'post_status' => 'publish'
    ));
    
    if (!empty($recent_posts)) : ?>
        <div class="widget widget_recent_entries">
            <h2 class="widget-title"><?php esc_html_e('Recent Posts', 'base-theme-wp'); ?></h2>
            <ul>
                <?php
                foreach ($recent_posts as $recent) {
                    printf(
                        '<li><a href="%1$s">%2$s</a></li>',
                        esc_url(get_permalink($recent['ID'])),
                        esc_html($recent['post_title'])
                    );
                }
                ?>
            </ul>
        </div>
    <?php endif;
    wp_reset_postdata();

    // Categorias
    $categories = get_categories(array(
        'orderby' => 'name',
        'order'   => 'ASC'
    ));
    
    if (!empty($categories)) : ?>
        <div class="widget widget_categories">
            <h2 class="widget-title"><?php esc_html_e('Categories', 'base-theme-wp'); ?></h2>
            <ul>
                <?php
                foreach ($categories as $category) {
                    printf(
                        '<li class="cat-item"><a href="%1$s">%2$s</a> (%3$s)</li>',
                        esc_url(get_category_link($category->term_id)),
                        esc_html($category->name),
                        esc_html($category->count)
                    );
                }
                ?>
            </ul>
        </div>
    <?php endif; ?>
</aside>