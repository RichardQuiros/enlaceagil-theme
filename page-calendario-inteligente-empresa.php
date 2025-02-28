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

// Obtener categorías únicas
$categorias = $wpdb->get_col("
    SELECT DISTINCT category FROM {$wpdb->prefix}enlace_agil_packages 
    WHERE company_id = $company_id
");

// Obtener ubicaciones únicas
$ubicaciones = $wpdb->get_col("
    SELECT DISTINCT location FROM {$wpdb->prefix}enlace_agil_packages 
    WHERE company_id = $company_id
");


// Obtener los próximos eventos (máximo 5)
$proximos_eventos = $wpdb->get_results(
    $wpdb->prepare("
        SELECT 
            p.id, 
            p.title, 
            d.start_date, 
            d.end_date, 
            d.type,
            d.persons,
            d.booking_deadline,
            d.capacity - COALESCE((
                SELECT SUM(r.persons) 
                FROM {$wpdb->prefix}enlace_agil_reservations r 
                WHERE r.package_id = p.id 
                AND r.status = 'confirmed'
            ), 0) AS available_slots
        FROM {$wpdb->prefix}enlace_agil_packages p
        JOIN {$wpdb->prefix}enlace_agil_availability d 
            ON p.id = d.package_id
        WHERE p.company_id = %d
        AND (
            (d.type = 'single' AND d.end_date >= NOW()) -- Eventos únicos futuros
            OR 
            (d.type != 'single' AND COALESCE(d.booking_deadline, d.end_date) >= NOW()) -- Eventos recurrentes con booking_deadline válida
        )
        ORDER BY d.start_date ASC
        LIMIT 3
    ", $company_id)
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

    .highlight-day {
            border: 3px solid #22C55e !important;
            border-radius: 5px;
        }

    .content-wrapper {
        transform: scale(.95);
    }
</style>

<header class="glass-panel mx-auto w-full max-w-7xl py-3 px-6 flex items-center justify-center rounded-lg">
  <h1 class="text-3xl font-extrabold text-green-600 tracking-tight">EnlaceAgil</h1>
</header>

<div class="content-wrapper">
    <div id="tooltip" class="hidden absolute fixed bg-white shadow-xl p-6 rounded-xl max-w-sm z-50 transform -translate-x-1/2 -translate-y-1/2" onclick="closeTooltip()">
        <span class="absolute top-2 right-3 text-gray-500 text-lg cursor-pointer" onclick="closeTooltip()">&times;</span>
        <h3 class="text-xl font-bold text-green-700">Detalles del Paquete - <span id="tooltip-title"></span></h3>
        <p class="text-gray-600 mt-2" id="tooltip-description"></p>
        
        <div class="mt-4 border-t border-gray-200 pt-4">
            <p class="text-gray-800 font-semibold">📅 Fecha: <span id="tooltip-date" class="text-gray-600"></span></p>
            <p class="text-gray-800 font-semibold">🕒 Duración: <span id="tooltip-duration" class="text-gray-600"></span></p>
            <p class="text-gray-800 font-semibold">✅ Check-in: <span id="tooltip-checkin" class="text-gray-600"></span></p>
            <p class="text-gray-800 font-semibold">🚪 Check-out: <span id="tooltip-checkout" class="text-gray-600"></span></p>
            <p class="text-gray-800 font-semibold">🔢 Disponibilidad: <span id="tooltip-cupos" class="text-green-600"></span></p>
            <p class="text-gray-800 font-semibold">$ Precio: <span id="tooltip-price" class="text-green-600"></span></p>
        </div>
        <div class="mt-4 flex gap-2">
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600" onclick="reservePackage()">Reservar Ahora</button>
            <a id="tooltip-details" class='bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 text-center'>Ver Detalles</a>
    </div>
</div>

    <section class="max-w-7xl mx-auto px-6 pb-10">
        <div class="branding-card">
            <h1>Explora y Reserva con Facilidad - <?php echo esc_html($enlaceagil_current_company->name); ?></h1>
            <p>Encuentra experiencias únicas y reserva tus próximas aventuras de manera rápida y sencilla.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Calendario -->
            <div id="calendar-container" class="bg-white p-6 rounded-lg shadow-lg"> 
                <h2 class="text-3xl font-semibold text-green-700">Calendario</h2>
                <p class="text-gray-600 text-md mb-4">Selecciona fechas disponibles y revisa en tiempo real cuántos cupos quedan.</p>
                <div id="calendar"></div>
            </div>
            
        <!-- Opciones de Búsqueda -->
        <div class="bg-white p-6 rounded-lg shadow-lg" id="filter-card">
            <h2 class="text-3xl font-semibold text-green-700 mb-4">Opciones de Búsqueda</h2>

            <form id="filter-form" class="space-y-4">
                <div id="filter-section" class="flex flex-col justify-between">
                    <div class="overflow-y-scroll">
                    <!-- Tipo de Paquete -->
                    <label class="block text-md font-medium text-gray-700">Tipo de Paquete</label>
                    <select id="categoryInput" name="category" class="w-full border-gray-300 rounded-lg p-2 mt-1">
                        <option value="">Todos</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo esc_attr($categoria); ?>"><?php echo esc_html($categoria); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Ubicación -->
                    <label class="block text-md font-medium text-gray-700 mt-4">Ubicación</label>
                    <select id="locationInput" name="location" class="w-full border-gray-300 rounded-lg p-2 mt-1">
                        <option value="">Todas</option>
                        <?php foreach ($ubicaciones as $ubicacion): ?>
                            <option value="<?php echo esc_attr($ubicacion); ?>"><?php echo esc_html($ubicacion); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Rango de Fechas -->
                    <label class="block text-md font-medium text-gray-700 mt-4">Rango de Fechas</label>
                    <div class="flex gap-2">
                        <input type="date" name="start_date" id="start_date" class="w-1/2 border-gray-300 rounded-lg p-2 mt-1">
                        <input type="date" name="end_date" id="end_date" class="w-1/2 border-gray-300 rounded-lg p-2 mt-1">
                    </div>

                    <!-- Cupos Disponibles -->
                    <label class="block text-md font-medium text-gray-700 mt-4">Cupos Disponibles</label>
                    <input type="number" name="availability" id="availability" class="w-full border-gray-300 rounded-lg p-2 mt-1" placeholder="Mínimo de cupos">

                    <!-- Precio Estimado -->
                    <label class="block text-md font-medium text-gray-700 mt-4">Rango de Precio</label>
                    <div class="flex gap-2">
                        <input type="number" name="min_price" id="min_price" value="0" class="w-1/2 border-gray-300 rounded-lg p-2 mt-1" placeholder="$ Mínimo">
                        <input type="number" name="max_price" id="max_price" value="999" class="w-1/2 border-gray-300 rounded-lg p-2 mt-1" placeholder="$ Máximo">
                    </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="mt-6 flex gap-3">
                        <button class="w-1/2 bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 text-lg font-semibold" type="submit">Aplicar Filtros</button>
                        <button class="w-1/2 bg-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-400 text-lg font-semibold" type="button" onclick="resetFilters()">Restablecer</button>
                    </div>
                </div>
            </form>

            <!-- Resultados de búsqueda -->
            <div id="filter-results" class="hidden mt-6 max-h-[400px] overflow-auto">
                <div class="filter-active flex justify-between items-center p-3 bg-gray-100 rounded-lg">
                    <span id="applied-filters">Filtros aplicados: <span id="filter-summary"></span></span>
                    <button class="bg-red-500 text-white px-3 py-1 rounded-lg" onclick="resetFilters()">Editar Filtros</button>
                </div>
                <div id="package-list" class="mt-4 space-y-4"></div> <!-- Aquí se mostrarán los paquetes -->
            </div>
        </div>

            <!-- Próximos Eventos -->
        <div class="bg-white p-6 rounded-lg shadow-lg mt-6" id="nextEvents">
        <h2 class="text-3xl font-semibold text-green-700">Próximos Eventos</h2>
        <?php if (!empty($proximos_eventos)): ?>
        <?php foreach ($proximos_eventos as $evento): ?>
            <div class="flex justify-between items-center mt-4 p-4 bg-gray-100 rounded-lg" onclick="goToDate('<?php echo date("Y-m-d", strtotime($evento->start_date)); ?>')">
                <span class="text-lg font-semibold">
                    <?php echo esc_html($evento->title); ?> - <?php echo date("d M", strtotime($evento->start_date)); ?>
                </span>
                <span class="text-<?php echo ($evento->available_slots > 0) ? 'green-700' : 'red-600'; ?> text-lg font-bold">
                    <?php echo ($evento->available_slots > 0) ? $evento->available_slots . ' cupos libres' : 'Agotado'; ?>
                </span>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-gray-500 text-md mt-4">No hay próximos eventos disponibles.</p>
    <?php endif; ?>
    </div>
    </section>
</div>

<script>
    const companyId = <?php echo json_encode($company_id); ?>;
</script>

<!-- FullCalendar Core -->
<script src="https://cdn.jsdelivr.net/npm/rrule@2.6.8/dist/es5/rrule.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/fullcalendar"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/rrule"></script>

<!-- Floating UI -->
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.9"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.13"></script>

<script>
    function closeTooltip() {
        document.getElementById('tooltip').style.display = 'none';
    }

    function reservePackage() {
        alert('Reserva confirmada');
        closeTooltip();
    }

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var tooltipEl = document.getElementById("tooltip");

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            height: 400,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek'
            },
            plugins: [FullCalendar.RRule.default], // Asegurar que el plugin se carga correctamente
            events: function(fetchInfo, successCallback, failureCallback) {
                const {startStr, endStr} = fetchInfo;
                fetch(`/wp-admin/admin-ajax.php?action=enlaceagil_get_calendar_data&company_id=${companyId}&start=${startStr}&end=${endStr}`) 
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            successCallback(data.data.packages);
                        } else {
                            failureCallback();
                        }
                    })
                    .catch(error => {
                        console.error('Error al cargar eventos:', error);
                        failureCallback();
                    });
            },
            eventClick: async function(info) {
                const { event } = info;
                let tooltip = document.getElementById('tooltip-container');
                document.getElementById('tooltip-title').innerText = event.extendedProps.title;
                document.getElementById('tooltip-description').innerText = event.extendedProps.description;
                document.getElementById('tooltip-date').innerText = event.startStr;
                document.getElementById('tooltip-duration').innerText = event.extendedProps.daysDuration;
                document.getElementById('tooltip-checkin').innerText = event.extendedProps.checkin;
                document.getElementById('tooltip-checkout').innerText = event.extendedProps.checkout;
                document.getElementById('tooltip-cupos').innerText = event.extendedProps.available > 0 ? `Quedan ${event.extendedProps.available} cupos` : "Agotado";
                document.getElementById('tooltip-details').href = event.extendedProps.url;
                document.getElementById('tooltip-price').href = event.extendedProps.price;

                closeTooltip()

                // Posicionar el Tooltip con Floating UI
                const { computePosition, autoPlacement, offset, shift } = window.FloatingUIDOM;
                const position = await computePosition(info.el, tooltipEl, {
                    placement: "bottom",
                    middleware: [offset(10), shift({crossAxis: true}), autoPlacement({crossAxis: true})]
                });

                Object.assign(tooltipEl.style, {
                    left: `${position.x}px`,
                    top: `${position.y}px`,
                    display: "block"
                });

                tooltipEl.classList.remove("hidden");
            }
        });

         // Función para cambiar la fecha y resaltar el día
         window.goToDate = function(dateStr) {
                // Cambiar la vista si está en semanal
                if (calendar.view.type === 'timeGridWeek') {
                    calendar.changeView('dayGridMonth');
                }

                // Ir a la fecha seleccionada
                calendar.gotoDate(dateStr);

                // Esperar a que el calendario se renderice para resaltar
                setTimeout(() => highlightDate(dateStr), 300);
            };

            // Función para resaltar el día seleccionado
            function highlightDate(dateStr) {
                // Remover resaltado previo
                document.querySelectorAll('.highlight-day').forEach(el => {
                    el.classList.remove('highlight-day');
                });

                // Buscar el elemento del día en el calendario
                let dayCells = document.querySelectorAll('.fc-daygrid-day');

                dayCells.forEach(cell => {
                    let cellDate = cell.getAttribute('data-date');
                    if (cellDate === dateStr) {
                        cell.classList.add('highlight-day');
                    }
                });
            }

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

function setLocationOption(locations){
locations.foreach(location => {
    const option = document.createElement('option');
    option.value = location;
    option.innerHTML = location;
    locationInput.appendChild(option);
 })
}

function setCategoryOption(categories){
categories.foreach(category => {
    const option = document.createElement('option');
    option.value = category;
    option.innerHTML = category;
    categoryInput.appendChild(option);
 })
}

function setNearbyPackges(packages){
    const months = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
    // 1️⃣ Obtener fecha actual
    const hoy = new Date();

    // 2️⃣ Filtrar eventos futuros
    const eventosFuturos = packages.filter(evento => new Date(evento.start) >= hoy);

    // 3️⃣ Ordenar por fecha de inicio
    eventosFuturos.sort((a, b) => new Date(a.start) - new Date(b.start));

    // 4️⃣ Generar HTML para cada evento
    const eventosContainer = document.getElementById("nextEvents");
    eventosContainer.innerHTML = ""; // Limpiar antes de agregar eventos

    eventosFuturos.forEach(evento => {
        const eventoDiv = document.createElement("div");
        eventoDiv.classList.add("flex", "justify-between", "items-center", "mt-4", "p-4", "bg-gray-100", "rounded-lg");
        const date = new Date(evento.start);

        // Texto del evento
        eventoDiv.innerHTML = `
        <div class="flex justify-between items-center mt-4 p-4 bg-gray-100 rounded-lg" onclick="showModal(${evento})">
            <span class="text-lg font-semibold">${evento.title} (${evento.personas}) - ${date.getDate()} ${months[date.getMonth()]}</span>
            <span class="text-green-700 text-lg font-bold">2 cupos libres</span>
        </div>
        `;

        eventosContainer.appendChild(eventoDiv);
    });
}
</script>

<script>
document.getElementById('filter-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar recarga de la página
    
    let formData = new FormData(this);
    formData.append("company_id", companyId);
    
    fetch('/wp-admin/admin-ajax.php?action=enlaceagil_filter_package', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayFilteredPackages(data.data.packages, formData);
        } else {
            document.getElementById('package-list').innerHTML = '<p class="text-gray-600">No se encontraron paquetes con estos filtros.</p>';
        }
    })
    .catch(error => console.error('Error en la solicitud:', error));
});

function displayFilteredPackages(packages, formData) {
    let resultsContainer = document.getElementById('package-list');
    resultsContainer.innerHTML = ''; // Limpiar resultados anteriores

    let summary = [];
    if (formData.get('category')) summary.push(`Categoría: ${formData.get('category')}`);
    if (formData.get('location')) summary.push(`Ubicación: ${formData.get('location')}`);
    if (formData.get('start_date') && formData.get('end_date')) summary.push(`Fechas: ${formData.get('start_date')} - ${formData.get('end_date')}`);
    if (formData.get('availability')) summary.push(`Cupos mínimos: ${formData.get('availability')}`);
    document.getElementById('filter-summary').textContent = summary.join(', ');

    packages.forEach(paquete => {
        let packageCard = `
            <div class="p-4 border rounded-lg shadow-md bg-white">
                <h3 class="text-xl font-semibold text-green-700">${paquete.title}</h3>
                <p class="text-gray-600">${paquete.description}</p>
                <p class="text-gray-500 text-sm">Ubicación: <strong>${paquete.location}</strong></p>
                <p class="text-gray-500 text-sm">Cupos disponibles: <strong>${paquete.capacity}</strong></p>
                <p class="text-gray-500 text-sm">Precio: <strong>$${paquete.price}</strong></p>
                <div class="mt-3 flex gap-2">
                    <a href="${paquete.url}" class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-600">Reservar</a>
                </div>
            </div>
        `;
        resultsContainer.innerHTML += packageCard;
    });

    document.getElementById('filter-section').classList.add('hidden');
    document.getElementById('filter-results').classList.remove('hidden');
}

function resetFilters() {
    document.getElementById('filter-section').classList.remove('hidden');
    document.getElementById('filter-results').classList.add('hidden');
    document.getElementById('filter-form').reset();
}
</script>   

<?php get_footer(); ?>