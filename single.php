<?php
get_header();
?>

<div class="container">
    <div class="content-area">
        <main id="main" class="site-main">
            <?php
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                        <div class="entry-meta">
                            <?php
                            // Data da postagem
                            echo '<span class="posted-on">';
                            echo sprintf(
                                esc_html__('Posted on %s', 'base-theme-wp'),
                                '<time datetime="' . esc_attr(get_the_date('c')) . '">' . esc_html(get_the_date()) . '</time>'
                            );
                            echo '</span>';

                            // Autor
                            echo '<span class="byline"> ' . 
                                sprintf(
                                    esc_html__('by %s', 'base-theme-wp'),
                                    '<span class="author vcard"><a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . 
                                    esc_html(get_the_author()) . '</a></span>'
                                ) . 
                            '</span>';

                            // Categorias
                            $categories_list = get_the_category_list(esc_html__(', ', 'base-theme-wp'));
                            if ($categories_list) {
                                printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'base-theme-wp') . '</span>', $categories_list);
                            }
                            ?>
                        </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'base-theme-wp'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <footer class="entry-footer">
                        <?php
                        $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'base-theme-wp'));
                        if ($tags_list) {
                            printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'base-theme-wp') . '</span>', $tags_list);
                        }

                        // Navegação entre posts
                        the_post_navigation(array(
                            'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'base-theme-wp') . '</span> <span class="nav-title">%title</span>',
                            'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'base-theme-wp') . '</span> <span class="nav-title">%title</span>',
                        ));

                        // Se os comentários estão abertos ou já existem comentários
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                        ?>
                    </footer>
                </article>
            <?php endwhile; ?>
        </main>
    </div>

    <?php get_sidebar(); ?>
</div>

<?php
get_footer();