<?php
/* Template Name: Reservar */
get_header();

$package_id = get_query_var('id');

if (!$package_id) {
    echo "<div class='bg-[#f0f4f3] min-h-screen flex items-center justify-center px-4'>
            <div class='max-w-xl w-full bg-white/40 backdrop-blur-md p-6 rounded-2xl shadow-md text-center'>
              <h2 class='text-3xl font-bold text-red-600 mb-2'>Error</h2>
              <p class='text-gray-700'>No se encontró el paquete solicitado.</p>
            </div>
          </div>";
    get_footer();
    exit;
}
?>

<main class="min-h-screen py-20 px-4 font-sans">
  <div class="max-w-3xl mx-auto bg-white/60 backdrop-blur-md rounded-2xl shadow-xl p-8">
    <h2 id="package-title" class="text-4xl font-bold text-green-600 text-center mb-6">Cargando...</h2>

    <form id="reservation-form" class="space-y-6">
      <input type="hidden" id="package_id" name="package_id" value="<?php echo esc_attr($package_id); ?>">

      <!-- Fecha -->
      <div>
        <label class="block text-sm font-medium text-gray-800 mb-1">Fecha</label>
        <input type="date" id="reservation_date" name="reservation_date"
          class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400"
          required>
      </div>

      <!-- Número de personas -->
      <div>
        <label class="block text-sm font-medium text-gray-800 mb-1">Número de Personas</label>
        <input type="number" id="persons" name="persons" min="1" max="10" value="1"
          class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400"
          required>
      </div>

      <!-- Datos de contacto -->
      <div class="bg-white/70 backdrop-blur-xl p-6 rounded-xl shadow-md space-y-4">
        <h3 class="text-lg font-semibold text-green-700">Información de contacto</h3>
        <input type="text" name="name" placeholder="Nombre completo"
          class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400" required>
        <input type="email" name="email" placeholder="Correo electrónico"
          class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400" required>
        <input type="tel" name="cellphone" placeholder="Teléfono / Celular"
          class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400" required>
      </div>

      <!-- Botón -->
      <button type="submit"
        class="w-full bg-green-500 text-white font-bold py-3 px-6 rounded-full hover:bg-green-600 transition">
        Confirmar Reserva
      </button>
    </form>

    <div id="confirmation-message"
      class="hidden text-center text-green-700 font-semibold mt-6 text-lg transition-all duration-300"></div>
  </div>
</main>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const packageId = "<?php echo esc_js($package_id); ?>";

  fetch(`/wp-admin/admin-ajax.php?action=enlaceagil_get_package_data&id=${packageId}`)
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        document.getElementById("package-title").textContent = data.data.title;
      } else {
        document.getElementById("package-title").textContent = "Error al cargar paquete.";
      }
    });

  document.getElementById("reservation-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("action", "enlaceagil_create_reservation");

    fetch("/wp-admin/admin-ajax.php", {
      method: "POST",
      body: formData
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          document.getElementById("confirmation-message").textContent = "✅ ¡Reserva Confirmada!";
          document.getElementById("confirmation-message").classList.remove("hidden");
          this.reset();
        } else {
          alert("Error al reservar: " + data.message);
        }
      });
  });
});
</script>

<?php get_footer(); ?>
