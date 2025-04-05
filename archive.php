<?php get_header(); ?>

<section class="max-w-6xl mx-auto px-4 py-16 min-h-screen">
  <h1 class="text-3xl md:text-4xl font-bold text-[#4c5561] mb-10">
    <?php the_archive_title(); ?>
  </h1>

  <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article class="bg-white/60 backdrop-blur-md rounded-2xl shadow-md p-6 hover:shadow-lg transition max-h-[280px]">
        <?php if (has_post_thumbnail()) : ?>
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium', ['class' => 'rounded-lg mb-4']); ?>
          </a>
        <?php endif; ?>
        <h2 class="text-xl font-semibold text-green-700 mb-2">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <div class="text-sm text-gray-500 mb-2">
          <?php echo get_the_date(); ?> – <?php the_author(); ?>
        </div>
        <p class="text-gray-700"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
      </article>
    <?php endwhile; else : ?>
      <p class="text-gray-500">No hay publicaciones en este momento.</p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
