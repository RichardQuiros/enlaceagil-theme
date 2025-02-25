<?php
/*
 * Template Name: Calendario Inteligente
 * Descripción: Vista previa de un calendario inteligente con glassmorphism para EnlaceAgil
 */

// get_header(); // Si ya lo usas
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendario Inteligente - EnlaceAgil</title>
  <?php wp_head(); ?>

  <!-- Ejemplo: FullCalendar (opcional, si quieres un mock real) -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js"></script>

  <style>
    /* Glass effect */
    .glass-panel {
      backdrop-filter: blur(10px);
      background: rgba(255,255,255,0.2);
      border: 1px solid rgba(255,255,255,0.3);
      box-shadow: 0 4px 30px rgba(0,0,0,0.1);
    }
    /* Fondo evocando naturaleza */
    body {
      background: #f0f4f3; 
      min-height: 100vh;
      margin: 0;
      color: #1e293b;
      background-image: url('https://picsum.photos/2000/1200?random=70');
      background-size: cover;
      background-position: center;
      position: relative;
    }
    /* Overlay brumoso */
    body::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(255,255,255,0.4);
      backdrop-filter: blur(5px);
      z-index: 0;
    }
    .content-wrapper {
      position: relative;
      z-index: 1;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
  </style>
</head>
<body <?php body_class(); ?>>

<div class="content-wrapper">

  <!-- ENCABEZADO (opcional si no usas get_header()) -->
  <header class="glass-panel mx-auto w-full max-w-7xl mt-4 py-3 px-6 flex items-center justify-between rounded-lg">
    <h1 class="text-2xl font-bold text-green-600 tracking-tight">EnlaceAgil</h1>
    <nav class="space-x-6 text-gray-800 font-medium">
      <a href="#" class="hover:text-green-600 transition">Inicio</a>
      <a href="#" class="hover:text-green-600 transition">Analítica</a>
      <a href="#" class="hover:text-green-600 transition">Reservas</a>
      <a href="#" class="hover:text-green-600 transition">Ajustes</a>
    </nav>
  </header>

  <!-- TÍTULO O DESCRIPCIÓN PRINCIPAL -->
  <section class="mx-auto w-full max-w-7xl mt-8 px-6">
    <div class="glass-panel p-6 rounded-lg text-center">
      <h2 class="text-3xl font-extrabold text-gray-800 mb-4 tracking-tight">Calendario Inteligente de Reserva</h2>
      <p class="text-gray-700 max-w-2xl mx-auto">
        Visualiza fechas disponibles y gestiona tus reservas de forma ágil. 
        <strong class="text-green-600">EnlaceAgil</strong> combina tecnología de vanguardia y un diseño 
        <em>futurista-natural</em> para que la planificación sea un placer tanto para proveedores como para turistas.
      </p>
    </div>
  </section>

  <!-- SECCIÓN PRINCIPAL: CALENDARIO Y PANEL LATERAL -->
  <main class="mx-auto w-full max-w-7xl mt-6 px-6 pb-10 flex flex-col md:flex-row gap-6">

    <!-- Columna Izquierda: Calendario (FullCalendar) -->
    <div class="glass-panel rounded-lg flex-1 p-6 overflow-hidden">
      <h3 class="text-xl font-bold text-green-700 mb-3">Calendario</h3>
      <p class="text-gray-700 mb-4">
        Selecciona fechas disponibles y revisa en tiempo real cuántos cupos quedan.  
      </p>

      <!-- Contenedor del calendario (FullCalendar) -->
      <div id="calendar" class="mt-4"></div>
    </div>

    <!-- Columna Derecha: Panel con Info Extra / Filtro / Resumen -->
    <div class="flex-1 flex flex-col space-y-6">
      <!-- Panel de Filtros o Resumen (por ejemplo) -->
      <div class="glass-panel rounded-lg p-6">
        <h3 class="text-xl font-bold text-green-700 mb-3">Opciones de Búsqueda</h3>
        <div class="space-y-3 text-gray-700">
          <div>
            <label for="tipoPaquete" class="block text-sm font-medium">Tipo de Paquete</label>
            <select id="tipoPaquete" class="mt-1 p-2 rounded-md w-full">
              <option>Ecoturismo</option>
              <option>Aventura</option>
              <option>Familiar</option>
              <option>Relax</option>
            </select>
          </div>
          <div>
            <label for="ubicacion" class="block text-sm font-medium">Ubicación</label>
            <select id="ubicacion" class="mt-1 p-2 rounded-md w-full">
              <option>Montaña</option>
              <option>Playa</option>
              <option>Selva</option>
              <option>Ciudad</option>
            </select>
          </div>
          <button class="mt-4 bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-full transition">
            Aplicar Filtros
          </button>
        </div>
      </div>

      <!-- Panel de Resumen / Info Extra (por ejemplo, Próximos Eventos) -->
      <div class="glass-panel rounded-lg p-6">
        <h3 class="text-xl font-bold text-green-700 mb-3">Próximos Eventos</h3>
        <ul class="space-y-3 text-gray-800">
          <li class="bg-white bg-opacity-80 rounded-md p-3 flex items-center justify-between">
            <span class="font-medium">Tour Playa (5p) - 30 Ago</span>
            <span class="text-sm text-gray-600">2 cupos libres</span>
          </li>
          <li class="bg-white bg-opacity-80 rounded-md p-3 flex items-center justify-between">
            <span class="font-medium">Selva Aventura (4p) - 2 Sep</span>
            <span class="text-sm text-gray-600">Agotado</span>
          </li>
          <li class="bg-white bg-opacity-80 rounded-md p-3 flex items-center justify-between">
            <span class="font-medium">Escapada Cultural (3p) - 5 Sep</span>
            <span class="text-sm text-gray-600">1 cupo</span>
          </li>
        </ul>
      </div>
    </div>

  </main>
</div>

<?php wp_footer(); ?>

<!-- Script para inicializar FullCalendar (opcional) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  if(calendarEl) {
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek'
      },
      locale: 'es', /* Idioma */
      height: 'auto',
      events: [
        // Mock de eventos
        {
          title: 'Ecoturismo (10 cupos)',
          start: '2025-08-15',
          end: '2025-08-16',
          color: '#10b981' // tailwind green
        },
        {
          title: 'Aventura Sierra (Agotado)',
          start: '2025-08-20',
          color: '#9ca3af' // grey
        }
      ],
      eventClick: function(info) {
        alert('Has seleccionado: ' + info.event.title);
      }
    });
    calendar.render();
  }
});
</script>
</body>
</html>
