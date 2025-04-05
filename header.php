<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Poppins', 'sans-serif'],
          },
          colors: {
            primary: '#10b981',
            accent: '#fbbf24',
          }
        }
      }
    }
  </script>
  <script src="https://cdn.tailwindcss.com"></script>
  <?php wp_head(); ?>
  <style>
    ul {
      display: flex;
      gap: 8px;
      color: #4c5561;
      font-weight: 800;

    }

    li:hover {
      color: #16a34a;
    }
  </style>
</head>

<body <?php body_class("bg-[#f0f4f3] font-sans antialiased"); ?>>

<header class="w-full bg-white/80 backdrop-blur-md border-b border-white/20 shadow-md">
  <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row items-center justify-between">
    
    <!-- Logo -->
    <div class="text-2xl font-bold text-primary">
      <a class="bg-white/60 px-8 py-2 rounded-lg" href="<?php echo esc_url(home_url()); ?>">
        <?php if (has_custom_logo()) {
          the_custom_logo();
        } else {
          echo 'EnlaceAgil';
        } ?>
      </a>
    </div>

    <!-- Menú horizontal (funcional) -->
    <nav class="mt-4 md:mt-0">
      <?php
        wp_nav_menu(array(
          'theme_location' => 'main_menu',
          'container' => false,
          'items_wrap' => '%3$s',
          'menu_class' => 'flex flex-wrap gap-6 text-sm font-medium text-gray-800',
        ));
      ?>
    </nav>
    
  </div>
</header>

<main>
