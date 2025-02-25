<?php
/* front-page.php - Landing Page Completa con gráficos mejorados */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EnlaceAgil - Landing Completa</title>
  <?php wp_head(); // Carga scripts y estilos encolados (Tailwind, etc.) ?>

  <!-- Chart.js (v4) -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>

  <style>
    /* Glass effect para paneles */
    .glass-panel {
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 4px 30px rgba(0,0,0,0.1);
    }
    /* Fondo evocando naturaleza */
    body {
      background: #f0f4f3; 
      min-height: 100vh;
      margin: 0;
      color: #1e293b; /* slate-800 */
      background-image: url('https://picsum.photos/2000/1200?random=60'); /* Cambia por imagen de turismo */
      background-size: cover;
      background-position: center;
      position: relative;
    }
    /* Overlay brumoso */
    body::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(255, 255, 255, 0.39);
      /*backdrop-filter: blur(5px);*/
      backdrop-filter: blur(30px) saturate(2);
      z-index: 0;
    }
    .content-wrapper {
      position: relative;
      z-index: 1;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .title-bg {
        position: absolute;
        background: white;
        height: 100%;
        width: 174px;
        left: -2px;
        z-index: -1;
        border-radius: 0.5rem 0 0 0.5rem;
        filter: opacity(0.8);
        opacity: 0.8;
    }

    /* Estilos para el video de fondo */
    #bgVideo {
      position: fixed;
      top: 50%;
      left: 50%;
      min-width: 100%;
      min-height: 100%;
      width: auto;
      height: auto;
      transform: translate(-50%, -50%);
      object-fit: cover; /* Hace que el video cubra todo sin distorsionarse */
      z-index: -1;
      max-width: none;
    }
  </style>
</head>
<body <?php body_class(); ?>>

<video autoplay muted loop id="bgVideo">
    <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/video.mp4" type="video/mp4">
    Tu navegador no soporta la etiqueta de video.
  </video>

<div class="content-wrapper content">

  <!-- ENCABEZADO GLASS -->
  <header class="glass-panel mx-auto w-full max-w-7xl mt-4 py-3 px-6 flex items-center justify-between rounded-lg">
  <div class="title-bg"></div>
    <h1 class="text-2xl font-bold text-green-600 tracking-tight">EnlaceAgil</h1>
    <nav class="space-x-6 text-gray-800 font-medium">
      <a href="#inicio" class="hover:text-green-600 transition">Inicio</a>
      <a href="#funcionalidades" class="hover:text-green-600 transition">Funcionalidades</a>
      <a href="#graficas" class="hover:text-green-600 transition">Gráficas</a>
      <a href="#acerca" class="hover:text-green-600 transition">Acerca de</a>
      <a href="#testimonios" class="hover:text-green-600 transition">Testimonios</a>
      <a href="#contacto" class="hover:text-green-600 transition">Contacto</a>
    </nav>
  </header>

  <!-- HERO / PRINCIPAL -->
  <section id="inicio" class="mx-auto w-full max-w-7xl mt-8 px-6 pb-10 flex flex-col md:flex-row gap-6">
    <!-- Columna Izquierda: Hero -->
    <div class="glass-panel rounded-lg flex-1 p-6 flex flex-col items-center justify-center overflow-hidden">
      <img
        src="https://picsum.photos/600/800?random=101"
        alt="Experiencia única"
        class="w-64 h-auto object-cover rounded-xl shadow-lg mb-4"
      >
      <h2 class="text-3xl font-extrabold text-gray-800 mb-2 tracking-tight text-center">Experiencia Única</h2>
      <p class="text-gray-700 text-center max-w-sm mb-6">
        Con <strong class="text-green-600">EnlaceAgil</strong>, conecta con la naturaleza y gestiona tu negocio turístico
        con la agilidad y el estilo futurista que mereces. Ideal para <strong class="text-green-600">proveedores</strong> y <strong class="text-green-600">turistas</strong> listos para nuevas aventuras.
      </p>
      <div class="bg-white bg-opacity-40 backdrop-blur-sm rounded-md p-4 text-center">
        <p class="text-gray-800 font-medium">¿Listo para expandir fronteras?</p>
        <p class="text-gray-600">Tenemos todo lo que necesitas para crecer</p>
      </div>
    </div>

    <!-- Columna Derecha: Panel CTA -->
    <div class="flex-1 flex flex-col space-y-6">
      <!-- Panel: Llamado a la Acción / Crea tu Cuenta -->
      <div class="glass-panel rounded-lg p-6 text-center flex-1 flex flex-col justify-center">
        <h3 class="text-xl font-bold text-green-700 mb-3">Únete a EnlaceAgil</h3>
        <p class="text-gray-700 mb-4">
          Llevamos la gestión de turismo a otro nivel, mezclando lo mejor de la tecnología 
          con la pasión por la naturaleza.
        </p>
        <a 
          href="#contacto"
          class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-8 py-3 rounded-full transition"
        >
          Crear Cuenta Gratis
        </a>
      </div>
      <!-- Panel: Imagen Extra o Mensaje Adicional -->
      <div class="glass-panel rounded-lg p-6 text-center">
        <img 
          src="https://picsum.photos/400/200?random=120" 
          alt="Imagen Extra" 
          class="w-full h-auto rounded-md shadow-md mb-3 object-cover"
        >
        <p class="text-gray-700">Explora destinos ecológicos y únete a la tendencia de turismo sustentable.</p>
      </div>
    </div>
  </section>

  <!-- SECCIÓN FUNCIONALIDADES -->
  <section id="funcionalidades" class="max-w-7xl mx-auto px-6 py-10">
    <div class="glass-panel p-6 rounded-lg">
      <h3 class="text-2xl font-bold text-green-700 mb-4">Principales Funcionalidades</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white bg-opacity-70 p-4 rounded-md">
          <h4 class="text-xl font-semibold text-gray-800 mb-2">Reservas Inmediatas</h4>
          <p class="text-gray-600">Confirma fechas con solo 2 clics, ahorrando tiempo y esfuerzo.</p>
        </div>
        <!-- Card 2 -->
        <div class="bg-white bg-opacity-70 p-4 rounded-md">
          <h4 class="text-xl font-semibold text-gray-800 mb-2">Calendario Inteligente</h4>
          <p class="text-gray-600">Visualiza disponibilidad en tiempo real y recibe alertas automáticas.</p>
        </div>
        <!-- Card 3 -->
        <div class="bg-white bg-opacity-70 p-4 rounded-md">
          <h4 class="text-xl font-semibold text-gray-800 mb-2">Analítica Potenciada</h4>
          <p class="text-gray-600">Monitorea reservas y tendencias para impulsar tu negocio.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- SECCIÓN DE GRÁFICAS MEJORADAS (Chart.js con degradados) -->
  <section id="graficas" class="max-w-7xl mx-auto px-6 pb-10">
    <div class="glass-panel p-6 rounded-lg">
      <h3 class="text-2xl font-bold text-green-700 mb-4">Estadísticas Destacadas</h3>
      <p class="text-gray-700 mb-6">Observa el crecimiento de reservas y usuarios a lo largo del tiempo.</p>
      <div class="flex flex-col md:flex-row gap-6">
        <!-- Gráfica 1 (Line Chart) -->
        <div class="bg-white bg-opacity-70 rounded-md p-4 w-full md:w-1/2">
          <canvas id="chartReservas" class="w-full h-48"></canvas>
        </div>
        <!-- Gráfica 2 (Bar Chart) -->
        <div class="bg-white bg-opacity-70 rounded-md p-4 w-full md:w-1/2">
          <canvas id="chartUsuarios" class="w-full h-48"></canvas>
        </div>
      </div>
    </div>
  </section>

  <!-- SECCIÓN ACERCA DE (Misión / Visión) -->
  <section id="acerca" class="max-w-7xl mx-auto px-6 pb-10">
    <div class="glass-panel p-6 md:p-8 rounded-lg">
      <h3 class="text-2xl font-bold text-green-700 mb-4">Acerca de EnlaceAgil</h3>
      <div class="md:flex md:space-x-8">
        <div class="md:w-1/2 mb-6 md:mb-0">
          <h4 class="text-xl font-semibold text-gray-800 mb-2">Nuestra Misión</h4>
          <p class="text-gray-700 mb-4">
            Brindar a proveedores turísticos y viajeros la experiencia más rápida y confiable para gestionar y reservar tours, enfocada en la sustentabilidad y la tecnología de vanguardia.
          </p>
          <h4 class="text-xl font-semibold text-gray-800 mb-2">Nuestra Visión</h4>
          <p class="text-gray-700">
            Ser la plataforma líder en turismo ecológico, uniendo innovación y respeto por la naturaleza en cada reserva.
          </p>
        </div>
        <div class="md:w-1/2">
          <img 
            src="https://picsum.photos/500/300?random=310"
            alt="Misión y Visión"
            class="w-full h-auto rounded-md shadow-md object-cover"
          >
        </div>
      </div>
    </div>
  </section>

  <!-- SECCIÓN TESTIMONIOS -->
  <section id="testimonios" class="max-w-7xl mx-auto px-6 pb-10">
    <h3 class="text-2xl font-bold text-green-700 mb-4">Testimonios</h3>
    <div class="grid md:grid-cols-3 gap-8">
      <!-- Testimonio 1 -->
      <div class="glass-panel p-6 rounded-lg">
        <p class="text-gray-700 mb-4">
          “Reservar fue muy fácil y rápido, en un par de minutos ya teníamos todo listo para nuestras vacaciones.”
        </p>
        <div class="flex items-center space-x-3">
          <img 
            src="https://picsum.photos/50/50?random=201" 
            alt="User"
            class="w-10 h-10 rounded-full object-cover"
          >
          <div>
            <span class="block font-semibold text-gray-800">Andrea R.</span>
            <span class="block text-sm text-gray-500">Turista Inquieta</span>
          </div>
        </div>
      </div>
      <!-- Testimonio 2 -->
      <div class="glass-panel p-6 rounded-lg">
        <p class="text-gray-700 mb-4">
          “Como proveedor, me ahorró mucho tiempo. La interfaz es hermosa y los clientes la aman.”
        </p>
        <div class="flex items-center space-x-3">
          <img 
            src="https://picsum.photos/50/50?random=202" 
            alt="User"
            class="w-10 h-10 rounded-full object-cover"
          >
          <div>
            <span class="block font-semibold text-gray-800">Luis & Co.</span>
            <span class="block text-sm text-gray-500">Agencia EcoTours</span>
          </div>
        </div>
      </div>
      <!-- Testimonio 3 -->
      <div class="glass-panel p-6 rounded-lg">
        <p class="text-gray-700 mb-4">
          “La analítica en tiempo real nos permitió optimizar nuestras ofertas y aumentar reservas un 30%.”
        </p>
        <div class="flex items-center space-x-3">
          <img 
            src="https://picsum.photos/50/50?random=203" 
            alt="User"
            class="w-10 h-10 rounded-full object-cover"
          >
          <div>
            <span class="block font-semibold text-gray-800">Camila J.</span>
            <span class="block text-sm text-gray-500">Gerente de Operaciones</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SECCIÓN FINAL / CONTACTO -->
  <section id="contacto" class="max-w-7xl mx-auto px-6 pb-16">
    <div class="glass-panel p-8 rounded-lg text-center">
      <h3 class="text-2xl font-bold text-gray-800 mb-3">Contáctanos</h3>
      <p class="text-gray-700 mb-6 max-w-md mx-auto">
        ¿Tienes dudas o deseas más información? Estamos aquí para ayudarte a emprender tu próxima aventura.
      </p>
      <a 
        href="#"
        class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-8 py-3 rounded-full transition"
      >
        Habla con Nosotros
      </a>
    </div>
  </section>

</div>

<?php wp_footer(); ?>

<!-- Script de Chart.js para inicializar gráficas con degradados -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Selecciona canvas
  const ctxReservas = document.getElementById('chartReservas');
  const ctxUsuarios = document.getElementById('chartUsuarios');

  // Crear gradiente para line chart
  const gradientReservas = ctxReservas.getContext('2d').createLinearGradient(0, 0, 0, 200);
  gradientReservas.addColorStop(0, 'rgba(16,185,129,0.7)');  // #10b981 tailwind green-500
  gradientReservas.addColorStop(1, 'rgba(16,185,129,0.1)');

  // GRÁFICO RESERVAS (LINE)
  new Chart(ctxReservas, {
    type: 'line',
    data: {
      labels: ['Sem1','Sem2','Sem3','Sem4','Sem5'],
      datasets: [{
        label: 'Reservas',
        data: [12, 19, 14, 22, 28],
        borderColor: '#10b981',
        backgroundColor: gradientReservas,
        fill: true,
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false }
      },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });

  // Crear gradiente para bar chart
  const gradientUsuarios = ctxUsuarios.getContext('2d').createLinearGradient(0, 0, 0, 200);
  gradientUsuarios.addColorStop(0, 'rgba(59,130,246,0.8)'); // #3b82f6 tailwind blue-500
  gradientUsuarios.addColorStop(1, 'rgba(59,130,246,0.1)');

  // GRÁFICO USUARIOS (BAR)
  new Chart(ctxUsuarios, {
    type: 'bar',
    data: {
      labels: ['Ene','Feb','Mar','Abr','May'],
      datasets: [{
        label: 'Usuarios (k)',
        data: [2, 3.5, 5, 7, 9],
        backgroundColor: gradientUsuarios,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false }
      },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });
});
</script>
</body>
</html>
