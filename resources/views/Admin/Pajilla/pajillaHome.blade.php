@extends('Admin.sidebar')
@section('main')
    <main class="app-content">
      <div class="app-title">
        <div style="margin-inline-start: 40%;">
            <h1>Pajillas de Semen
                <br><button style="background-color: #d79e46;border-color: #d79e46;" class="btn btn-primary" id="agregar1" type="button"data-bs-toggle="modal" data-bs-target="#agregar"> <i class="fas fa-plus-circle"></i> Publicar Pajilla</button>
            </h1>
        </div>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableProductos">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Raza</th>
                          <th>Precio</th>
                          {{-- <th>Visualizaciones</th> --}}
                          <th>Rancho</th>
                          <th>Ubicación</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($products as $p)
                          <tr>
                            <td>{{$p->nombre}}</td>
                            <td>{{$p->raza}}</td>
                            <td>{{$p->precio}}</td>
                            {{-- <td>{{$p->visits->count()}}</td> --}}
                            <td>{{$p->rancho}}</td>
                            <td>{{$p->location->nombre}}</td>
                            <td>
                              <button style="background-color:#d79e46;border-color: #d79e46;" class="btn btn-info btn-sm" onclick="openProductInNewTab('{{$p->idproducto}}', '{{$p->ruta}}')" target="_blank" title="Ver producto"disabled>
                                  <i class="far fa-eye"></i>
                              </button>
                              <button class="btn btn-primary btn-sm editProductBtn" data-id="{{$p->idproducto}}" id="editProduct" title="Editar producto" disabled>
                                  <i class="fas fa-pencil-alt"></i>
                              </button >
                              <form action="{{ route('deletePaj', $p->idproducto) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-sm" title="Eliminar producto">
                                      <i class="far fa-trash-alt"></i>
                                  </button>
                              </form>
                          </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregar" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div style="background: #d79e46; border-color:#d79e46;" class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Agregar Pajilla</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {!!Form::open(['url'=> 'admin/products/addNewPaj', 'files' => true, 'style' => 'padding: 0;'])!!}
          {{-- <form id="formProductos" name="formProductos" class="form-horizontal" action="{{url('admin/products/addNewGen')}}" method="POST" style="padding: 0;"> --}}
              @csrf
              <input type="hidden" id="idProducto" name="idProducto" value="">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="destacado" id="destacado">
                <label class="form-check-label" for="destacado">
                  Marcar deste producto como <b>destacado</b>
                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input class="form-check-input" type="checkbox" name="premium" id="premium">
                <label class="form-check-label" for="premium">
                  Este producto es calidad <b style="color: #d79e46;">premium<b>
                </label>
              </div>
              <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                      <label class="control-label">Título del Anuncio <span class="required">*</span></label>
                      <input class="form-control" maxlength="100" id="txtNombre" name="txtNombre" type="text" required="">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Características</label>
                      <textarea class="form-control" maxlength="1000" id="txtDescripcion" name="txtDescripcion" ></textarea>
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="estados">Estado:</label>
                      <select class="form-control" name="estados" id="estados">
                          <option value=""></option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="ciudades">Ciudad:</label>
                        <select  class="form-control" name="ciudades" id="ciudades">
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="comisarias">Comisarias:</label>
                        <select class="form-control"  name="comisarias" id="comisarias">
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                  {{-- <div class="row">
                    <div class="form-group col-md-6">
                      <div class="form-group">
                          <label class="control-label"> Edad del ganado <span class="required">*</span></label>
                          <input maxlength="5" class="form-control" id="txtEdad" name="txtEdad" type="number" placeholder="Edad en años" required="">
                          
                      </div>
                    </div>
                  </div> --}}

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Precio <span class="required">*</span></label>
                            <input maxlength="11" class="form-control" id="txtPrecio" name="txtPrecio" type="text" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Cantidad Disponible<span class="required">*</span></label>
                            <input class="form-control" maxlength="5" id="txtStock" name="txtStock" type="number" required="">
                        </div>
                          <div class="form-group col-md-6">
                            <label class="control-label">Nombre del rancho</label>
                            <input class="form-control" maxlength="50" id="txtRancho" name="txtRancho" type="text" >
                        </div>
                         <div class="form-group col-md-6">
                            <label class="control-label">Raza</label>
                            <select class="form-control selectpicker" id="txtRaza" name="txtRaza" >
                              <option value="Brahman rojo">Brahman rojo</option>
                              <option value="Brahman gris">Brahman gris </option>
                              <option value="Brahman ameri">Brahman ameri</option>
                              <option value="Nelore">Nelore </option>
                              <option value="Nelore mocho">Nelore mocho </option>
                              <option value="Nelore pinto">Nelore pinto </option>
                              <option value="Beefmaster">Beefmaster </option>
                              <option value="Suizo europeo">Suizo europeo</option>
                              <option value="Simmental">Simmental</option>
                              <option value="Simbrah">Simbrah </option>
                              <option value="Gyr">Gyr</option>
                              <option value="Guzerat">Guzerat </option>
                              <option value="Charolais">Charolais</option>
                              <option value="Suizo america">Suizo america</option>
                              <option value="Limouzin">Limouzin </option>
                              <option value="Indubrasil">Indubrasil </option>
                              <option value="Brangus">Brangus </option>
                              <option value="Angus">Angus </option>
                              <option value="Hereford">Hereford</option>
                              <option value="Charolesa">Charolesa </option>
                              <option value="Pardo suizo europeo">Pardo suizo europeo</option>
                              <option value="Pardo suizo americano">Pardo suizo americano</option>
                              <option value="Aberdeen angus">Aberdeen angus</option>
                              <option value="Santa Gertrudis">Santa Gertrudis</option>
                              <option value="Cebu Brahman">Cebu Brahman</option>
                              <option value="Belgian Blue">Belgian Blue</option>
                              <option value="Braford">Braford</option>
                            </select>
                        </div>
                      {{--  <div class="form-group col-md-6">
                            <label class="control-label" for="listVacu">Vacunado</label>
                            <select class="form-control selectpicker" id="listVacu" name="listVacu">
                              <option value="Vacunado">Vacunado</option>
                              <option value="NO Vacunado">No Vacunado</option>
                            </select>
                      </div> --}}
                        <div class="form-group col-md-6">
                            <label class="control-label" for="fileCert">Certificado</label>
                            <input type="file" class="form-control" id="fileCert" name="fileCert" accept="image/*">
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label class="control-label" class="control-label">Tipo</label>
                            <select class="form-control selectpicker" id="txtTipo" name="txtTipo" >
                              <option value="Toro">Toro</option>
                              <option value="Torete">Torete</option>
                              <option value="Novillonas de registro puro">Novillonas de registro puro</option>
                              <option value="Destetes de resgistro puro">Destetes de resgistro puro </option>
                              <option value="Semental joven">Semental joven</option>
                              <option value="Semental">Semental</option>
                            </select>
                        </div>  --}}
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="listStatus">En venta <span class="required">*</span></label>
                            <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                              <option value="1">Activo</option>
                              <option value="2">Inactivo</option>
                            </select>
                        </div>                        
                        <div class="form-group col-md-6">
                            <label class="control-label"   for="listEstatus">Estatus</label>
                            <select class="form-control selectpicker" id="listEstatus" name="listEstatus" >
                              <option value="1">Disponible</option>
                              <option value="2">Reservado</option>
                              <option value="3">Vendido</option>
                              <option value="4">Enviado</option>
                            </select>
                        </div>
                    </div>
                </div>
              </div>{{-- 
              <div class="container">
                    <input type="file" id="file-input" name="imagenes-cargadas[]" multiple style="display:none;">
                    <button type="button" id="add-images" class="btn btn-primary" style="background: #d79e46; border-color: #d79e46">Agregar imágenes</button>
                    <br>
                    <div id="image-container" class="d-flex flex-wrap mt-3" >
                        
                    </div>
                <div id="hidden-inputs"></div>
                <input type="hidden" name="deleted_images" id="deleted_images">
                <input type="hidden" name="images" id="images" value="">
              </div>    --}}            
              <div class="container">
                    <label for="video">Cargar video:</label>
                    <input type="file" name="video" id="video" accept="video/mp4, video/avi, video/mov, video/mpeg, video/quicktime">
              </div>    
              <div class="container">
                <input type="file" id="file-input" name="imagenes[]" multiple accept="image/*" style="display:none;">
                <button type="button" id="add-images" class="btn btn-primary" style="background: #d79e46; border-color: #d79e46">
                    Agregar imágenes
                </button>
                <br>
                <div id="image-list-container" class="mt-3">
                    <ul id="image-list" class="list-group"></ul>
                </div>
                <input type="hidden" name="deleted_images" id="deleted_images">
            </div>
              <div class="tile-footer">
      <div class="modal-footer">
{{-- <div id="loading-icon" class="loading-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="40" height="40">
  <img src="{{url('/static/images/loading.png')}}">
</div> --}}
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background:red; border-color: red;">Cerrar</button>
        {!!Form::submit('SUBIR', ['class' => 'btn btn-primary', 'style' => 'background: #d79e46; border-color: #d79e46;', 'id' => 'enviarBtn'])!!}
      </div>      
              </div>
        {!!Form::close()!!} {{-- </form>
 --}}      </div>
    </div>
  </div>
</div>
 <div class="modal fade" id="modalForGen" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="userEditInfoContainer"></div>
      </div>
    </div>
  </div>
</div>
    </main>
    <script src="{{url('/static/js/admin/location.js') }}" ></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
          const fileInput = document.getElementById("file-input");
          const addImagesButton = document.getElementById("add-images");
          const imageList = document.getElementById("image-list");
          const deletedImages = document.getElementById("deleted_images");
          const uploadForm = document.getElementById("upload-form");

          let selectedFiles = [];
          addImagesButton.addEventListener("click", function () {
              fileInput.click();
          });

          fileInput.addEventListener("change", function (event) {
              const files = Array.from(event.target.files);

              files.forEach(file => {
                  if (!selectedFiles.some(f => f.name === file.name)) {
                      selectedFiles.push(file);
                  }
              });

              updateImageList();
          });
          function updateImageList() {
              imageList.innerHTML = "";

              selectedFiles.forEach((file, index) => {
                  let listItem = document.createElement("li");
                  listItem.classList.add("list-group-item", "d-flex", "justify-content-between", "align-items-center");

                  let imgThumbnail = document.createElement("img");
                  imgThumbnail.src = URL.createObjectURL(file);
                  imgThumbnail.style.width = "50px";
                  imgThumbnail.style.height = "50px";
                  imgThumbnail.style.objectFit = "cover";
                  imgThumbnail.style.marginRight = "10px";
                  imgThumbnail.classList.add("img-thumbnail");
                  let textContainer = document.createElement("span");
                  textContainer.textContent = file.name;
                  let removeButton = document.createElement("button");
                  removeButton.classList.add("btn", "btn-danger", "btn-sm");
                  removeButton.textContent = "X";
                  removeButton.addEventListener("click", function () {
                      removeImage(index);
                  });

                  listItem.appendChild(imgThumbnail);
                  listItem.appendChild(textContainer);
                  listItem.appendChild(removeButton);
                  imageList.appendChild(listItem);
              });

              updateFileInput();
          }

          function removeImage(index) {
              let removedFile = selectedFiles.splice(index, 1)[0];
              deletedImages.value += removedFile.name + ",";
              updateImageList();
          }
          function updateFileInput() {
              const dataTransfer = new DataTransfer();

              selectedFiles.forEach(file => {
                  dataTransfer.items.add(file);
              });

              fileInput.files = dataTransfer.files;
          }
          uploadForm.addEventListener("submit", function () {
              updateFileInput();
          });
      });
</script>
    @endsection