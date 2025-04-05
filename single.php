<?php get_header(); ?>
<section class="max-w-4xl mx-auto px-4 py-12">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="bg-white/60 backdrop-blur-md shadow-md rounded-2xl p-8">
      <h1 class="text-3xl md:text-4xl font-bold text-green-600 mb-4"><?php the_title(); ?></h1>
      <div class="text-gray-500 text-sm mb-6"><?php echo get_the_date(); ?> | <?php the_author(); ?></div>
      <div class="prose max-w-none">
        <?php the_content(); ?>
      </div>
    </article>
  <?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>
