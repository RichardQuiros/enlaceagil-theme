<?php
/**
 * Template Name: EnlaceAgil Post Template
 * Template Post Type: post
 * Description: Plantilla para mostrar paquetes turísticos con el branding de EnlaceAgil en posts normales.
 */

wp_head();
$post_id = get_the_ID();
$url = get_post_meta($post_id, '_url', true);
?>

<main class="min-h-screen py-20 px-4 font-sans">
  <div class="max-w-4xl mx-auto bg-white/80 backdrop-blur-md rounded-2xl shadow-xl p-8">
    <article class="prose prose-lg md:prose-xl max-w-none">
      <header class="mb-8 border-b border-white/30 pb-4">
        <h1 class="text-4xl font-bold text-green-600 tracking-tight mb-2"><?php the_title(); ?></h1>
        <p class="text-sm text-gray-500"><?php echo get_the_date(); ?></p>
      </header>

      <?php if (has_post_thumbnail()) : ?>
        <div class="mb-6">
          <?php the_post_thumbnail('large', ['class' => 'rounded-xl w-full h-auto shadow-lg']); ?>
        </div>
      <?php endif; ?>

      <div class="text-gray-800 leading-relaxed">
        <?php the_content(); ?>
      </div>

      <div class="mt-10 text-center">
        <a class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-8 py-3 rounded-full shadow-md transition" href="<?php echo $url; ?>">Reservar Ahora</a>
      </div>
    </article>

    <?php if (comments_open() || get_comments_number()) : ?>
      <div class="mt-16">
        <?php comments_template(); ?>
      </div>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>
