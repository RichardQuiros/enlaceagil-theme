<?php
// EnlaceAgil Theme Functions
function enlaceagil_enqueue_assets() {
  // Encolar la hoja de estilo principal del tema (style.css)
  wp_enqueue_style( 'enlaceagil-style', get_stylesheet_uri(), array(), '1.0' );

  // Encolar Tailwind desde CDN
  wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com', array(), null, false );

  // Opcional: Encolar scripts JS del tema, si tienes
  // wp_enqueue_script( 'enlaceagil-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '1.0', true );
}
add_action('wp_enqueue_scripts', 'enlaceagil_enqueue_assets');

add_theme_support('custom-logo');

function enlaceagil_register_menus() {
    register_nav_menus(array(
      'main_menu' => 'Menú Principal EnlaceAgil'
    ));
  }
  add_action('init', 'enlaceagil_register_menus');

function enlaceagil_create_pages() {
  $pages = [
      'Reservar' => 'reservar',
      'Calendario' => 'calendario',
  ];

  foreach ($pages as $title => $slug) {
      // Verificar si la página ya existe
      if (get_page_by_path($slug) === null) {
          $page_id = wp_insert_post([
              'post_title'     => $title,
              'post_name'      => $slug,
              'post_status'    => 'publish',
              'post_type'      => 'page',
              'post_author'    => 1,
              'post_content'   => '',
              'page_template'  => "page-{$slug}.php", // Asigna la plantilla correcta
          ]);

          if ($page_id) {
              error_log("Página creada: {$title} ({$slug}) - ID: {$page_id}");
          } else {
              error_log("Error al crear la página: {$title}");
          }
      }
  }
}
add_action('after_setup_theme', 'enlaceagil_create_pages');



  
  

