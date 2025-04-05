<?php get_header(); ?>

<section class="max-w-4xl mx-auto px-4 py-16">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="bg-white/60 backdrop-blur-md rounded-2xl shadow-lg p-8">
      <h1 class="text-3xl md:text-4xl font-bold text-green-600 mb-6"><?php the_title(); ?></h1>
      <div class="prose max-w-none text-gray-800">
        <?php the_content(); ?>
      </div>
    </article>
  <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>
