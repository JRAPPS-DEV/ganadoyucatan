@extends('Admin.sidebar')
@section('main')
<main class="app-content">    
    <div class="app-title">
      <div>
          <h1><i class="fas fa-envelope"></i> Mensajes de Contacto</h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <div class="table-responsive">
                  <form id="markAsReadForm" action="{{ route('markMultipleAsReadConctact') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success" id="markAsReadBtn" disabled>Marcar como leídos</button>
                    <table class="table table-hover table-bordered" id="tableContactos">
                      <thead>
                        <tr>
                          <th><input type="checkbox" id="selectAll"></th>
                          <th>Nombre</th>
                          <th>Rancho</th>
                          <th>Ubicación</th>
                          <th>Paquete</th>
                          <th>Mensaje</th>
                          <th>Recibido</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($contactos as $c)
                          <tr>
                            <td><input type="checkbox" name="contacto_ids[]" value="{{ $c->id }}" class="messageCheckbox"></td>
                            <td>{{ $c->nombre }}</td>
                            <td>{{ $c->rancho }}</td>
                            <td>{{ $c->ubicacion }}</td>
                            <td>{{ $c->paquete }}</td>
                            <td>{{ $c->mensaje }}</td>
                            <td>{{ $c->created_at->format('d/m/Y H:i') }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.messageCheckbox');
    const markAsReadBtn = document.getElementById('markAsReadBtn');

    selectAllCheckbox.addEventListener('change', function() {
        checkboxes.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
        toggleSubmitButton();
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', toggleSubmitButton);
    });

    function toggleSubmitButton() {
        const selectedMessages = Array.from(checkboxes).filter(checkbox => checkbox.checked);
        markAsReadBtn.disabled = selectedMessages.length === 0;
    }
});
</script>
@endsection
