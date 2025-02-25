<?php
// Asegurar que la compañía está definida
global $enlaceagil_current_company, $wpdb;

if (!$enlaceagil_current_company) {
    wp_redirect(home_url());
    exit;
}

// Obtener los paquetes turísticos de esta empresa
$company_id = $enlaceagil_current_company->id;
$paquetes = $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM wp_enlace_agil_packages WHERE company_id = %d", $company_id)
);

get_header();
?>
<style>
    #calendar-container {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        padding: 2rem;
    }
    .fc .fc-button-primary {
        background-color: #10b981;
        border-color: #10b981;
    }
    .fc .fc-button-primary:hover {
        background-color: #059669;
    }
    .fc .fc-daygrid-event {
        border-radius: 0.375rem;
        padding: 0 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .branding-card {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(12px);
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        text-align: center;
    }
    .branding-card h1 {
        font-size: 3rem;
        font-weight: bold;
        color: #064e3b;
    }
    .branding-card p {
        font-size: 1.2rem;
        color: #374151;
    }
    .filter-active {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(255, 255, 255, 0.2);
        padding: 1rem;
        border-radius: 0.5rem;
    }
</style>

<header class="glass-panel mx-auto w-full max-w-7xl py-3 px-6 flex items-center justify-center rounded-lg">
  <h1 class="text-3xl font-extrabold text-green-600 tracking-tight">EnlaceAgil</h1>
</header>

<div class="content-wrapper">
    <section class="max-w-7xl mx-auto px-6 pb-10">
        <div class="branding-card">
            <h1>Calendario Inteligente de Reservas - <?php echo esc_html($enlaceagil_current_company->name); ?></h1>
            <p>Gestiona y optimiza las reservas de tu empresa en tiempo real con herramientas avanzadas.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Calendario -->
            <div id="calendar-container" class="bg-white p-6 rounded-lg shadow-lg"> 
                <h2 class="text-3xl font-semibold text-green-700">Calendario</h2>
                <p class="text-gray-600 text-md">Selecciona fechas disponibles y revisa en tiempo real cuántos cupos quedan.</p>
                <div id="calendar"></div>
            </div>
            
            <!-- Opciones de Búsqueda -->
            <div class="bg-white p-6 rounded-lg shadow-lg" id="filter-card">
                <h2 class="text-3xl font-semibold text-green-700">Opciones de Búsqueda</h2>
                <div id="filter-section">
                    <label class="block text-md font-medium text-gray-700">Tipo de Paquete</label>
                    <select class="w-full border-gray-300 rounded-lg p-2 mt-1">
                        <option value="ecoturismo">Ecoturismo</option>
                        <option value="aventura">Aventura</option>
                    </select>
                    <label class="block text-md font-medium text-gray-700 mt-4">Ubicación</label>
                    <select class="w-full border-gray-300 rounded-lg p-2 mt-1">
                        <option value="montana">Montaña</option>
                        <option value="playa">Playa</option>
                    </select>
                    <button class="mt-4 w-full bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 text-lg font-semibold" onclick="applyFilters()">Aplicar Filtros</button>
                </div>
                <div id="filter-results" class="hidden">
                    <div class="filter-active">
                        <span id="applied-filters">Filtros aplicados: Ecoturismo, Montaña</span>
                        <button class="bg-red-500 text-white px-3 py-1 rounded-lg" onclick="resetFilters()">Editar Filtros</button>
                    </div>
                    <div class="mt-4">Resultados filtrados aparecerán aquí.</div>
                </div>
            </div>
        </div>

            <!-- Próximos Eventos -->
            <div class="bg-white p-6 rounded-lg shadow-lg mt-6">
        <h2 class="text-3xl font-semibold text-green-700">Próximos Eventos</h2>
        <div class="flex justify-between items-center mt-4 p-4 bg-gray-100 rounded-lg">
            <span class="text-lg font-semibold">Tour Playa (5p) - 30 Ago</span>
            <span class="text-green-700 text-lg font-bold">2 cupos libres</span>
        </div>
        <div class="flex justify-between items-center mt-2 p-4 bg-gray-100 rounded-lg">
            <span class="text-lg font-semibold">Selva Aventura (2-4p) - 2 Sep</span>
            <span class="text-red-600 text-lg font-bold">Agotado</span>
        </div>
    </div>
    </section>
</div>

<!-- FullCalendar -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js"></script>

<script>
    const companyId = <?php echo json_encode($company_id); ?>;
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            height: 'auto',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek'
            },
            events: function(fetchInfo, successCallback, failureCallback) {
                fetch('/wp-admin/admin-ajax.php?action=enlaceagil_get_calendar_data&company_id=' + companyId) 
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            successCallback(data.data);
                        } else {
                            failureCallback();
                        }
                    })
                    .catch(error => {
                        console.error('Error al cargar eventos:', error);
                        failureCallback();
                    });
            },
            eventClick: function(info) {
                alert('Reservar: ' + info.event.title + '\nFecha: ' + info.event.startStr);
                // Aquí podrías redirigir a una página de reserva con más detalles
            }
        });

        calendar.render();
    });
</script>

<script>
function applyFilters() {
    document.getElementById('filter-section').classList.add('hidden');
    document.getElementById('filter-results').classList.remove('hidden');
}
function resetFilters() {
    document.getElementById('filter-results').classList.add('hidden');
    document.getElementById('filter-section').classList.remove('hidden');
}
</script>

<?php get_footer(); ?>