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

</style>

<div class="content-wrapper">
    <section class="max-w-7xl mx-auto px-6 pb-10">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-6">
            Calendario de Reservas - <?php echo esc_html($enlaceagil_current_company->name); ?>
        </h1>

        <div id="calendar-container" class="bg-white p-6 rounded-lg shadow-lg"> 
            <div id="calendar"></div>
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

<?php get_footer(); ?>
