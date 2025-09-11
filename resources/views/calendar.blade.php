@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-3 d-flex justify-content-center">
    <div style="max-width: 900px; width: 100%;">
        <div id="calendar"></div>
    </div>
</div>

<!-- Modal para agregar/editar eventos -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="eventForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventModalLabel">Agregar Evento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-2">
            <label for="eventTitle" class="form-label">Título del evento</label>
            <input type="text" class="form-control" id="eventTitle" required>
          </div>
          <div class="mb-2">
            <label for="eventStart" class="form-label">Fecha de inicio</label>
            <input type="datetime-local" class="form-control" id="eventStart" required>
          </div>
          <div class="mb-2">
            <label for="eventEnd" class="form-label">Fecha de fin</label>
            <input type="datetime-local" class="form-control" id="eventEnd">
          </div>
          <div class="mb-2">
            <label for="eventColor" class="form-label">Color</label>
            <input type="color" class="form-control form-control-color" id="eventColor" value="#3788d8">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="deleteEvent" class="btn btn-danger me-auto">Eliminar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.min.css') }}">
<style>
    #calendar {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar/main.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'es', // Español
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'dayGridMonth',
        selectable: true,
        editable: true,
        droppable: false,
        events: [],
        select: function(info) {
            openModal('Agregar Evento', info.startStr, info.endStr);
        },
        eventClick: function(info) {
            openModal('Editar Evento', info.event.startStr, info.event.endStr, info.event);
        }
    });

    calendar.render();

    var modalEl = new bootstrap.Modal(document.getElementById('eventModal'));
    var currentEvent = null;

    function openModal(title, start, end, event = null) {
        currentEvent = event;
        document.getElementById('eventModalLabel').innerText = title;
        document.getElementById('eventTitle').value = event ? event.title : '';
        document.getElementById('eventStart').value = start ? start.substring(0,16) : '';
        document.getElementById('eventEnd').value = end ? end.substring(0,16) : '';
        document.getElementById('eventColor').value = event ? event.backgroundColor : '#3788d8';
        document.getElementById('deleteEvent').style.display = event ? 'inline-block' : 'none';
        modalEl.show();
    }

    document.getElementById('eventForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var title = document.getElementById('eventTitle').value;
        var start = document.getElementById('eventStart').value;
        var end = document.getElementById('eventEnd').value;
        var color = document.getElementById('eventColor').value;

        if(currentEvent){
            // Editar evento
            currentEvent.setProp('title', title);
            currentEvent.setStart(start);
            currentEvent.setEnd(end);
            currentEvent.setProp('backgroundColor', color);
            currentEvent.setProp('borderColor', color);
        } else {
            // Crear nuevo evento
            calendar.addEvent({
                title: title,
                start: start,
                end: end,
                backgroundColor: color,
                borderColor: color
            });
        }
        modalEl.hide();
    });

    document.getElementById('deleteEvent').addEventListener('click', function() {
        if(currentEvent){
            currentEvent.remove();
        }
        modalEl.hide();
    });

});
</script>
@endpush
