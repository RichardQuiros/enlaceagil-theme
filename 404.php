<?php get_header(); ?>

<section class="min-h-[70vh] flex flex-col items-center justify-center text-center px-4">
  <div class="bg-white/60 backdrop-blur-md rounded-2xl shadow-xl p-10 max-w-xl">
    <h1 class="text-6xl font-bold text-green-500 mb-4">404</h1>
    <p class="text-xl font-semibold text-gray-700 mb-6">Página no encontrada</p>
    <p class="text-gray-500 mb-6">Lo sentimos, la página que buscas no existe o fue movida.</p>
    <a href="<?php echo esc_url(home_url()); ?>" class="inline-block px-6 py-3 bg-green-500 text-white font-semibold rounded-full hover:bg-green-600 transition">
      Volver al inicio
    </a>
  </div>
</section>

<?php get_footer(); ?>
