<?php
get_header();
?>

<div class="container">
    <div class="content-area">
        <main id="main" class="site-main">
            <?php if (have_posts()) : ?>
                <header class="page-header">
                    <?php
                    the_archive_title('<h1 class="page-title">', '</h1>');
                    the_archive_description('<div class="archive-description">', '</div>');
                    ?>
                </header>

                <div class="archive-grid">
                    <?php
                    while (have_posts()) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('archive-item'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <header class="entry-header">
                                <?php
                                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                                ?>

                                <div class="entry-meta">
                                    <?php
                                    echo sprintf(
                                        esc_html__('Posted on %s', 'base-theme-wp'),
                                        '<time datetime="' . esc_attr(get_the_date('c')) . '">' . esc_html(get_the_date()) . '</time>'
                                    );
                                    ?>
                                </div>
                            </header>

                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>

                            <footer class="entry-footer">
                                <?php
                                $categories_list = get_the_category_list(esc_html__(', ', 'base-theme-wp'));
                                if ($categories_list) {
                                    printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'base-theme-wp') . '</span>', $categories_list);
                                }

                                $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'base-theme-wp'));
                                if ($tags_list) {
                                    printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'base-theme-wp') . '</span>', $tags_list);
                                }
                                ?>
                            </footer>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php
                the_posts_pagination(array(
                    'prev_text' => esc_html__('Previous page', 'base-theme-wp'),
                    'next_text' => esc_html__('Next page', 'base-theme-wp'),
                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__('Page', 'base-theme-wp') . ' </span>',
                ));
            else :
                get_template_part('template-parts/content/content', 'none');
            endif;
            ?>
        </main>
    </div>

    <?php get_sidebar(); ?>
</div>

<?php
get_footer();