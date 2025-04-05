<?php
/* front-page.php visualmente refinado */
get_header(); ?>

<style>
  body::before {
    background: rgb(240 253 244) !important;
  }
</style>

<main class="content-wrapper content font-sans">
  <!-- HERO PRINCIPAL -->
  <section id="inicio" class="mx-auto max-w-7xl px-6 py-32 text-center flex flex-col md:flex-row items-center gap-16">
    <div class="md:w-1/2">
      <h1 class="text-6xl font-extrabold text-green-600 leading-snug tracking-tight mb-6">
        Gestiona tu negocio turístico con agilidad
      </h1>
      <p class="text-xl text-gray-700 max-w-xl mx-auto mb-8">
        Con <strong>EnlaceAgil</strong> optimizas reservas, paquetes y disponibilidad en minutos. Diseñado para proveedores ecológicos y clientes que aman la naturaleza.
      </p>
      <a href="#contacto" class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-full font-semibold shadow-md transition-all">
        Crear cuenta gratis
      </a>
    </div>
    <div class="md:w-1/2">
      <img src="https://picsum.photos/600/400?random=105" class="w-full rounded-3xl shadow-2xl" alt="Turismo sostenible">
    </div>
  </section>

  <!-- FUNCIONALIDADES -->
  <section id="funcionalidades" class="bg-white/60 backdrop-blur-md py-32">
    <div class="max-w-6xl mx-auto px-6">
      <h2 class="text-4xl font-bold text-center text-green-700 mb-16">Lo que puedes hacer con EnlaceAgil</h2>
      <div class="grid md:grid-cols-3 gap-10">
        <div class="bg-white/80 p-8 rounded-2xl shadow-xl border border-white/30 text-center">
          <h3 class="text-2xl font-semibold mb-2">Reservas en 2 clics</h3>
          <p class="text-gray-700">Procesa y confirma reservas al instante con una interfaz intuitiva.</p>
        </div>
        <div class="bg-white/80 p-8 rounded-2xl shadow-xl border border-white/30 text-center">
          <h3 class="text-2xl font-semibold mb-2">Calendario inteligente</h3>
          <p class="text-gray-700">Visualiza disponibilidad en tiempo real y evita sobreventas.</p>
        </div>
        <div class="bg-white/80 p-8 rounded-2xl shadow-xl border border-white/30 text-center">
          <h3 class="text-2xl font-semibold mb-2">Analítica en tiempo real</h3>
          <p class="text-gray-700">Toma decisiones basadas en datos sobre paquetes y temporadas.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- TESTIMONIOS -->
  <section id="testimonios" class="max-w-6xl mx-auto px-6 py-32">
    <h2 class="text-4xl font-bold text-green-700 text-center mb-16">Lo que dicen nuestros usuarios</h2>
    <div class="grid md:grid-cols-3 gap-10">
      <div class="bg-white/70 backdrop-blur p-6 rounded-2xl shadow-lg">
        <p class="text-gray-700 mb-4">"Reservar fue muy fácil y rápido, en minutos teníamos todo listo."</p>
        <p class="font-semibold text-gray-800">Andrea R.</p>
      </div>
      <div class="bg-white/70 backdrop-blur p-6 rounded-2xl shadow-lg">
        <p class="text-gray-700 mb-4">"Como proveedor, la plataforma me ahorró tiempo y mis clientes la aman."</p>
        <p class="font-semibold text-gray-800">Luis & Co.</p>
      </div>
      <div class="bg-white/70 backdrop-blur p-6 rounded-2xl shadow-lg">
        <p class="text-gray-700 mb-4">"La analítica nos permitió optimizar ofertas y aumentar reservas un 30%."</p>
        <p class="font-semibold text-gray-800">Camila J.</p>
      </div>
    </div>
  </section>

  <!-- NUEVA SECCIÓN: DESTACADOS -->
  <section id="destacados" class="bg-white/50 backdrop-blur-lg py-32">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-4xl font-bold text-green-700 mb-12">Destacados del Mes</h2>
      <p class="text-gray-700 text-lg max-w-2xl mx-auto mb-10">Explora las experiencias más populares y los destinos mejor valorados por nuestros usuarios.</p>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white/80 p-6 rounded-2xl shadow-md">
          <img src="https://picsum.photos/400/200?random=1" class="rounded-md mb-4" alt="Destino 1">
          <h3 class="text-xl font-semibold text-gray-800 mb-2">Selva Viva Tour</h3>
          <p class="text-gray-600">Una aventura ecológica guiada por expertos en biodiversidad tropical.</p>
        </div>
        <div class="bg-white/80 p-6 rounded-2xl shadow-md">
          <img src="https://picsum.photos/400/200?random=2" class="rounded-md mb-4" alt="Destino 2">
          <h3 class="text-xl font-semibold text-gray-800 mb-2">Kayak al Atardecer</h3>
          <p class="text-gray-600">Remar al ritmo del ocaso en una experiencia tranquila y memorable.</p>
        </div>
        <div class="bg-white/80 p-6 rounded-2xl shadow-md">
          <img src="https://picsum.photos/400/200?random=3" class="rounded-md mb-4" alt="Destino 3">
          <h3 class="text-xl font-semibold text-gray-800 mb-2">Ruta del Café</h3>
          <p class="text-gray-600">Descubre fincas sostenibles y vive el proceso artesanal del café local.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section id="faq" class="max-w-5xl mx-auto px-6 py-32">
    <h2 class="text-4xl font-bold text-green-700 text-center mb-12">Preguntas Frecuentes</h2>
    <div class="space-y-6">
      <details class="bg-white/80 p-6 rounded-xl shadow-md">
        <summary class="font-semibold text-gray-800 cursor-pointer">¿Es gratuito crear una cuenta?</summary>
        <p class="text-gray-600 mt-2">Sí, puedes registrarte sin costo e iniciar con tus primeros paquetes y reservas.</p>
      </details>
      <details class="bg-white/80 p-6 rounded-xl shadow-md">
        <summary class="font-semibold text-gray-800 cursor-pointer">¿Puedo administrar más de una empresa?</summary>
        <p class="text-gray-600 mt-2">Sí, podrás vincular múltiples empresas a tu cuenta y gestionarlas de forma independiente.</p>
      </details>
      <details class="bg-white/80 p-6 rounded-xl shadow-md">
        <summary class="font-semibold text-gray-800 cursor-pointer">¿Qué tipo de soporte ofrecen?</summary>
        <p class="text-gray-600 mt-2">Contamos con soporte técnico por correo y WhatsApp para ayudarte en todo momento.</p>
      </details>
    </div>
  </section>

  <!-- CTA FINAL -->
  <section id="contacto" class="bg-green-50 py-32 text-center">
    <h2 class="text-4xl font-bold text-green-700 mb-4">¿Listo para comenzar?</h2>
    <p class="text-gray-700 mb-8 max-w-xl mx-auto text-lg">Regístrate gratis y comienza a gestionar tu oferta turística de forma ágil y profesional.</p>
    <a href="#" class="bg-green-500 hover:bg-green-600 text-white px-10 py-4 rounded-full font-semibold shadow-md transition">
      Crear cuenta ahora
    </a>
  </section>

  <!-- BOTÓN FLOTANTE MÓVIL -->
  <a href="#contacto" class="fixed bottom-4 right-4 bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-full shadow-lg font-semibold transition md:hidden">
    ¡Reserva ya!
  </a>
</main>

<?php get_footer(); ?>