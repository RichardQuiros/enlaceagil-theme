<?php
/**
 * Template Name: EnlaceAgil Post Template
 * Template Post Type: post
 * Description: Plantilla para mostrar paquetes turísticos con el branding de EnlaceAgil en posts normales.
 */

get_header();

// Obtener ID del post y verificar si tiene meta del paquete
$package_id = get_post_meta(get_the_ID(), '_package_id', true);
$package_html = class_exists('EnlaceAgil_post') && $package_id
    ? EnlaceAgil_post::create_post($package_id)
    : '<p class="text-center text-gray-500">No se encontró información del paquete.</p>';
?>

<div class="bg-[#f0f4f3] min-h-screen py-10 px-4">
  <div class="max-w-4xl mx-auto bg-white/50 backdrop-blur-md rounded-2xl shadow-lg p-8">
    <article class="prose lg:prose-xl">
      <header class="mb-6">
        <h1 class="text-4xl font-bold text-emerald-500"><?php the_title(); ?></h1>
        <p class="text-sm text-gray-600"><?php echo get_the_date(); ?></p>
      </header>

      <div class="mb-6">
        <?php if (has_post_thumbnail()) : ?>
          <div class="mb-4">
            <?php the_post_thumbnail('large', ['class' => 'rounded-xl w-full h-auto']); ?>
          </div>
        <?php endif; ?>

        <div class="text-base text-gray-700">
          <h2>single<h2>
          <?php the_content(); ?>
        </div>
      </div>

      <div class="mt-10">
        <?php echo $package_html; ?>
      </div>

      <div class="mt-8 text-center">
        <a href="#" class="inline-block px-6 py-3 bg-yellow-400 hover:bg-yellow-500 text-white font-semibold rounded-xl transition">Reservar Ahora</a>
      </div>
    </article>
  </div>
</div>

<?php get_footer(); ?>
