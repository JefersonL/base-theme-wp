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

// Carregar scripts e estilos
function theme_scripts() {
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'theme_scripts');
