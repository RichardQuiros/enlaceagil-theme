<?php
/* front-page.php */
get_header(); // incluye header.php si lo has creado
?>

<!-- Tu layout glass y hero -->
<div class="content-wrapper">
  <main class="mx-auto w-full max-w-7xl mt-8 px-6 pb-10 flex flex-col md:flex-row gap-6">
    <!-- Aquí la columna izquierda y derecha, tu hero, etc. -->
    <!-- Copia el HTML glass que tenías -->
  </main>
</div>

<?php
get_footer(); // incluye footer.php si lo has creado

$args = array(
    'post_type' => 'paquete_turistico',
    'posts_per_page' => 3
  );
  $query = new WP_Query($args);
  if($query->have_posts()):
    while($query->have_posts()): $query->the_post();
      the_title('<h2 class="text-2xl font-bold">','</h2>');
      // ...
    endwhile;
    wp_reset_postdata();
  endif;
