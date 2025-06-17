<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'id', // Menggunakan bahasa Indonesia
            initialView: 'dayGridMonth', // Tampilan awal adalah bulan
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay' // Tombol untuk ganti view
            },
            // Mengambil data dari endpoint yang kita buat
            events: '<?= base_url("pendaftaran/calendar_events") ?>',

            // Kustomisasi tampilan event
            eventDidMount: function(info) {
                // Menambahkan tooltip saat hover
                $(info.el).tooltip({
                    title: info.event.extendedProps.description,
                    placement: 'top',
                    trigger: 'hover',
                    container: 'body'
                });
            },

            // Aksi saat event diklik
            eventClick: function(info) {
                info.jsEvent.preventDefault(); // Mencegah browser mengikuti link
                if (info.event.url) {
                    // Buka URL di tab baru
                    window.open(info.event.url, "_blank");
                }
            }
        });
        calendar.render();
    });
</script>