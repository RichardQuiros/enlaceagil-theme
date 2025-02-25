<!DOCTYPE html>
<html <?php language_attributes(); 

    wp_nav_menu(array(
        'theme_location' => 'main_menu',
        'container'      => false,
        'menu_class'     => 'space-x-6 text-gray-800 font-medium',
    ));
  
?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- Barra superior glass -->
<header class="glass-panel mx-auto w-full max-w-7xl mt-4 py-3 px-6 flex items-center justify-between rounded-lg">
  <h1 class="text-2xl font-bold text-green-600 tracking-tight">EnlaceAgil</h1>
  <nav>
  <?php
    wp_nav_menu(array(
      'theme_location' => 'main_menu',
      'container' => false,
      'menu_class' => 'space-x-6 text-gray-800 font-medium',
    ));
  ?>
</nav>

</header>
