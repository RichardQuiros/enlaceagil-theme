<?php
/* Template Name: Reservar */
get_header();

$package_id = get_query_var('id');

if (!$package_id) {
    echo "<div class='max-w-4xl mx-auto mt-10 p-6 bg-white bg-opacity-30 backdrop-blur-md rounded-lg shadow-lg text-center'>
            <h2 class='text-3xl font-bold text-red-600'>Error: No se encontró el paquete.</h2>
          </div>";
    get_footer();
    exit;
}
?>

<div class="max-w-4xl mx-auto mt-10 p-6 bg-white bg-opacity-30 backdrop-blur-md rounded-lg shadow-lg">
    <h2 id="package-title" class="text-3xl font-bold text-gray-900 text-center mb-4">Cargando...</h2>

    <form id="reservation-form" class="space-y-4">
        <input type="hidden" id="package_id" name="package_id" value="<?php echo esc_attr($package_id); ?>">
        
        <div>
            <label class="block text-sm font-medium text-gray-700">Fecha</label>
            <input type="date" id="reservation_date" name="reservation_date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Número de Personas</label>
            <input type="number" id="persons" name="persons" min="1" max="10" value="1" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <button type="submit" class="w-full bg-green-500 text-white font-bold py-2 px-4 rounded-md hover:bg-green-600">
            Confirmar Reserva
        </button>
    </form>

    <div id="confirmation-message" class="hidden text-center text-green-700 font-bold mt-4"></div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
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

    document.getElementById("reservation-form").addEventListener("submit", function(e) {
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
