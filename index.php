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
      /*background: rgba(255, 255, 255, 0.39);*/
      background: red;
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
</body>
</html>
