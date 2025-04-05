<?php get_header(); ?>

<section class="max-w-5xl mx-auto px-4 py-16">
  <header class="mb-12 text-center">
    <h1 class="text-3xl md:text-4xl font-bold text-green-600">
      Resultados de búsqueda para: <span class="text-gray-800"><?php echo get_search_query(); ?></span>
    </h1>
  </header>

  <?php if (have_posts()) : ?>
    <div class="grid md:grid-cols-2 gap-8">
      <?php while (have_posts()) : the_post(); ?>
        <article class="bg-white/60 backdrop-blur-md rounded-xl p-6 shadow-md hover:shadow-lg transition">
          <a href="<?php the_permalink(); ?>" class="block">
            <h2 class="text-2xl font-semibold text-green-500 mb-2"><?php the_title(); ?></h2>
            <p class="text-gray-600 text-sm"><?php echo get_the_date(); ?></p>
            <p class="text-gray-700 mt-2"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
          </a>
        </article>
      <?php endwhile; ?>
    </div>
  <?php else : ?>
    <div class="text-center text-gray-600">
      <p>No se encontraron resultados para tu búsqueda.</p>
    </div>
  <?php endif; ?>
</section>

<?php get_footer(); ?>
