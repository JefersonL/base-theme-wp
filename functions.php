<?php
if (!defined('ABSPATH')) exit;

// Configurações do Tema
function theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo');
    add_theme_support('automatic-feed-links');
    
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'base-theme-wp'),
        'footer' => __('Menu Rodapé', 'base-theme-wp')
    ));
}
add_action('after_setup_theme', 'theme_setup');

// Carregar scripts e estilos
function theme_scripts() {
    // Estilos
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    wp_enqueue_style('theme-main-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1');
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap', array(), null );
    
    // Scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('theme-main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'theme_scripts');

// Converter imagens para WebP automaticamente
function convert_to_webp($metadata, $attachment_id) {
    if (!function_exists('imagewebp')) {
        return $metadata;
    }

    $upload_dir = wp_upload_dir();
    $file = $upload_dir['basedir'] . '/' . $metadata['file'];
    
    // Verifica se é uma imagem
    $mime_type = get_post_mime_type($attachment_id);
    if (!in_array($mime_type, array('image/jpeg', 'image/png'))) {
        return $metadata;
    }

    // Carrega a imagem original
    switch ($mime_type) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($file);
            break;
        case 'image/png':
            $image = imagecreatefrompng($file);
            break;
        default:
            return $metadata;
    }

    if (!$image) {
        return $metadata;
    }

    // Cria o nome do arquivo WebP
    $webp_file = preg_replace('/\.(jpe?g|png)$/i', '.webp', $file);
    
    // Converte para WebP
    imagewebp($image, $webp_file, 80);
    imagedestroy($image);

    // Adiciona o arquivo WebP aos metadados
    $webp_url = preg_replace('/\.(jpe?g|png)$/i', '.webp', $metadata['file']);
    $metadata['sizes']['webp'] = array(
        'file' => basename($webp_url),
        'width' => $metadata['width'],
        'height' => $metadata['height'],
        'mime-type' => 'image/webp'
    );

    return $metadata;
}
add_filter('wp_generate_attachment_metadata', 'convert_to_webp', 10, 2);

// Adicionar suporte WebP ao upload
function add_webp_mime_type($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'add_webp_mime_type');

// Ajuste do admin bar para menu fixo
function admin_bar_fix() {
    if (is_admin_bar_showing()) {
        echo '<style>
            .site-header.fixed { top: 32px !important; }
            @media screen and (max-width: 782px) {
                .site-header.fixed { top: 46px !important; }
            }
        </style>';
    }
}
add_action('wp_head', 'admin_bar_fix');

// Adicionando suporte para logo do footer
function theme_footer_logo_setup($wp_customize) {
    $wp_customize->add_section('footer_logo_section', array(
        'title' => __('Footer Logo', 'base-theme-wp'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('footer_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
        'label' => __('Upload Footer Logo', 'base-theme-wp'),
        'section' => 'footer_logo_section',
        'settings' => 'footer_logo',
    )));
}
add_action('customize_register', 'theme_footer_logo_setup');