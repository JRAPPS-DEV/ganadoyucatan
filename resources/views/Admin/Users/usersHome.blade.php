@extends('Admin.sidebar')
@section('main')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.22.1/bootstrap-table.min.js"></script>
<link type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css">

  <main class="app-content">    
      <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i> Usuarios 
                
                {{-- <button class="btn btn-primary" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Nuevo</button> --}}
              
            </h1>
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
                    <table class="table table-hover table-bordered" id="tableUsuarios">
                      <thead>
                        <tr>
							<th data-field="nombres" data-sortable="true">Nombres</th>
            				<th data-field="email_user" data-sortable="true">Tel</th>
            				<th data-field="estado" data-sortable="true">Ubicacion</th>
                    <th data-field="datecreated" data-sortable="true" data-sorter="dateSorter">Registro</th>
            				<th data-field="ult_vez" data-sortable="true">Últ. Vez</th>
            				<th data-field="asociacion" data-sortable="true">Asociación</th>
                         	<th >Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $u)
                          <tr>
                            <td>{{$u->nombres.' '.$u->apellidos}}</td>
                            <td>{{$u->email_user}}</td>
                            <td>{{$u->ubi->nombre}}</td>
                            <td>{{$u->datecreated}}</td>
                            <td>{{$u->ult_vez}}</td>
                            <td>@if($u->asociacion == null) Sin asociacón @else {{$u->asociacion}} @endif</td>
                            <td>@if($u->rolid != 1)<button class="btn btn-primary  btn-sm editUserBtn" data-id="{{$u->idpersona}}" id="editUser" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>
                              <a href="{{ route('deleteUsr', $u->idpersona) }}" class="btn btn-danger" title="Eliminar producto" onclick="confirmation(event)"><i class="far fa-trash-alt"></i></a>
                              {{-- <button class="btn btn-danger btn-sm btnDelUsuario" title="Eliminar usuario">
                              <i class="far fa-trash-alt"></i></button> --}}

                              @else<button class="btn btn-secondary btn-sm" disabled ><i class="fas fa-pencil-alt"></i></button><button class="btn btn-secondary btn-sm" disabled ><i class="far fa-trash-alt"></i></button>@endif<button class="btn btn-sm reactiveBtn" data-id="{{$u->idpersona}}" style="border-color: black;" title="Reactivar Suscripción" ><i class="fa-solid fa-forward" style="color: #00ff6e;"></i></button></td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="pagination">
  					{{ $users->links() }}
					</div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </main>
 <div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div id="userInfoContainer"></div>
{{--             <form id="formUsuario" name="formUsuario" class="form-horizontal">
              <input type="hidden" id="idUsuario" name="idUsuario" value="">
              <p class="text-primary">Todos los campos son obligatorios.</p>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtIdentificacion">Identificación</label>
                  <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" >
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtNombre">Nombres</label>
                  <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtApellido">Apellidos</label>
                  <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtTelefono">Teléfono</label>
                  <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" onkeypress="return controlTag(event);">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtEmail">Email</label>
                  <input type="number" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="listRolid">Tipo usuario</label>
                    <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required >
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="listStatus">Status</label>
                    <select class="form-control selectpicker" id="listStatus" name="listStatus" required >
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
                </div>
             </div>
             <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtPassword">Password</label>
                  <input type="password" class="form-control" id="txtPassword" name="txtPassword" >
                </div>
             </div>
              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form> --}}
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        $('.editUserBtn').on('click', function() {
            var userId = $(this).data('id');
            var url = 'get-user-info/' + userId;

           
            $('#userInfoContainer').empty();

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    
                    $('#userInfoContainer').html(response);
                    
                    $('#modalFormUsuario').modal('show');
                },
                error: function(xhr, status, error) {
                    
                }
            });
        });
    });
    function confirmation(ev){
    ev.preventDefault();
    var url = ev.currentTarget.getAttribute('href');
    swal({
      title: "¿Desea eliminar este usuario?",
      text: "Esta usuario se eliminará para siempre",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((confirmCancel)=>{
      if(confirmCancel){
        window.location.href = url;
      }
    });
  }
    document.addEventListener('DOMContentLoaded', function(){
      var reactiveBtn = document.querySelectorAll('.reactiveBtn');

      reactiveBtn.forEach(function(button){
        button.addEventListener('click', function(){
          var userId = this.dataset.id;
          var url = 'reactiveAccount/' + userId;
          fetch(url).then(function(response){
            if(!response.ok){
              throw new Error('Error');
            }
            return response.text();
          }).then(function(response){
              swal({
              title: '¡Listo!',
              text: 'Usuario reactivado con éxito',
              icon: 'success',
              button: 'Entendido'
            });
          }).catch(function(error){
            console.error('Error:', error);
          });
      });
      });
    });
let sortAsc = false;
$('#tableUsuarios th[data-field="datecreated"]').on('click', function() {
    var rows = $('#tableUsuarios tbody tr').get();
    rows.sort(function(a, b) {
        var dateA = new Date($(a).children('td').eq(3).text());
        var dateB = new Date($(b).children('td').eq(3).text());

        return sortAsc ? dateA - dateB : dateB - dateA;
    });
    $.each(rows, function(index, row) {
        $('#tableUsuarios tbody').append(row);
    });
    sortAsc = !sortAsc;
});

</script>

@endsection