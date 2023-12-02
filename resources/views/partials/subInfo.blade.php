{!!Form::open(['url'=> 'admin/products/postsubtInfo/'.$product->id_producto, 'files' => true, 'style' => 'padding: 0;'])!!}
          {{-- <form id="formProductos" name="formProductos" class="form-horizontal" action="{{url('admin/products/addNewGen')}}" method="POST" style="padding: 0;"> --}}
              @csrf
              <input type="hidden" id="idProducto" name="idProducto" value="{{$product->idproducto}}">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
              {{-- <div class="form-check">
                <input class="form-check-input" type="checkbox" name="destacado" id="destacado">
                <label class="form-check-label" for="destacado">
                  Marcar deste producto como <b>destacado</b>
                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input class="form-check-input" type="checkbox" name="premium" id="premium">
                <label class="form-check-label" for="premium">
                  Este producto es calidad <b style="color: #d79e46;">premium<b>
                </label>
              </div> --}}
              <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                      <label class="control-label">Título del Anuncio <span class="required">*</span></label>
                      <input class="form-control" maxlength="100" id="txtNombre" name="txtNombre" type="text" value="{{$product->nombre}}" required="">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Características</label>
                      <textarea class="form-control" maxlength="1000" id="txtDescripcion" name="txtDescripcion" >{{$product->descripcion}}</textarea>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Enlance Youtube</label>
                      <input class="form-control" id="txtLink" name="txtLink" type="text"value="{{$product->yt}}">
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="estados">Estado:</label>
                      <select class="form-control" name="estados" id="estados">
                        <option value="1" {{ $product->estado == 1 ? 'selected' : '' }}>Yucatán</option>
                        <option value="2" {{ $product->estado == 2 ? 'selected' : '' }}>Campeche</option>
                        <option value="3" {{ $product->estado == 3 ? 'selected' : '' }}>Quintana Roo</option>
                        <option value="4" {{ $product->estado == 4 ? 'selected' : '' }}>Chiapas</option>
                        <option value="5" {{ $product->estado == 5 ? 'selected' : '' }}>Tabasco</option>
                      </select>
                    </div>
                    <div class="row">   
                      <div class="form-group col-md-4">
                        <label class="control-label"> Peso del ganado <span class="required">*</span></label>
                        <input maxlength="5" class="form-control" id="txtCodigo" name="txtCodigo" type="text" placeholder="Peso en kilogramos" required=""value="{{$product->peso}}">
                      </div>
                      <div class="form-group col-md-4">
                        <label class="control-label"> Edad del ganado <span class="required">*</span></label>
                        <input maxlength="5" class="form-control" id="txtEdad" name="txtEdad" type="number" placeholder="Edad en años" required="" value="{{$product->edad}}">  
                      </div>
                      <div class="form-group col-md-4">
                        <label class="control-label">Ejemplares<span class="required">*</span></label>
                        <input class="form-control" maxlength="5" id="txtStock" name="txtStock" type="number" required="" value="{{$product->cantidad}}">
                      </div>
                  </div>
                    <div class="row">   
                      <div class="form-group col-md-4">
                          <label class="control-label">Precio minimo</label>
                          <input value="{{$product->precioMin}}" type="number" id="min" name="min" class="form-control">
                      </div>
                      <div class="form-group col-md-4">
                        <label class="control-label">Precio maximo</label>
                          <input value="{{$product->precioMax}}" type="number" id="max" name="max" class="form-control">
                      </div>
                      <div class="form-group col-md-4">
                        <label class="control-label">Fecha de cierre</label>
                        <input value="{{$fechaCierre}}"  type="date" id="fecha_fin" name="fecha_fin" class="form-control">
                      </div>
                  </div>  
                </div>
                <div class="col-md-4">
                  <div class="row">
                  </div>

                    <div class="row">
                          <div class="form-group col-md-12">
                            <label class="control-label">Nombre del rancho</label>
                            <input class="form-control" maxlength="50" id="txtRancho" name="txtRancho" type="text"value="{{$product->rancho}}" >
                        </div>
                       <div class="form-group col-md-6">
                            <label class="control-label" for="listVacu">Vacunado</label>
                            <select class="form-control selectpicker" id="listVacu" name="listVacu">
                              <option value="{{$product->vacunado}}" selected >{{$product->vacunado}}</option>
                              <option value="Vacunado">Vacunado</option>
                              <option value="NO Vacunado">No Vacunado</option>
                            </select>
                      </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="listArete">Arete</label>
                            <select class="form-control selectpicker" id="listArete" name="listArete" >
                              <option value="{{$product->arete}}" selected >{{$product->arete}}</option>
                              <option value="Con Arete">Con Arete</option>
                              <option value="Sin Arete">Sin Arete</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="listCert">Certicado</label>
                            <select class="form-control selectpicker" id="listCert" name="listCert" >
                              <option value="{{$product->certificado}}" selected >{{$product->certificado}}</option>
                              <option value="Certificado">Cuenta con certificado</option>
                              <option value="NO certificado">NO cuenta con certificado</option>
                            </select>
                        </div> 
                        <div class="form-group col-md-6">
                            <label class="control-label" class="control-label">Tipo</label>
                            <select class="form-control selectpicker" id="txtTipo" name="txtTipo" >
                              <option value="{{$product->tipo}}" selected>{{$product->tipo}}</option>
                              <option value="Toro">Toro</option>
                              <option value="Torete">Torete</option>
                              <option value="Novillonas de registro puro">Novillonas de registro puro</option>
                              <option value="Destetes de resgistro puro">Destetes de resgistro puro </option>
                              <option value="Semental joven">Semental joven</option>
                              <option value="Semental">Semental</option>
                            </select>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="listStatus">En venta <span class="required">*</span></label>
                            <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                              <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Activo</option>
                              <option value="2" {{ $product->status == 2 ? 'selected' : '' }}>Terminada</option>
                            </select>
                        </div>                        
                        <div class="form-group col-md-6">
                            <label class="control-label"   for="listEstatus">Estatus</label>
                            <select class="form-control selectpicker" id="listEstatus" name="listEstatus" >
                              <option value="{{$product->estatus}}" selected>{{$product->estatus}}</option>
                              <option value="Disponible">Disponible</option>
                              <option value="Reservado">Reservado</option>
                              <option value="Vendido">Vendido</option>
                              <option value="Enviado">Enviado</option>
                            </select>
                        </div>
                    </div>
                </div>
              </div>
              <div class="container">
                    <input type="file" id="file-inputPart" name="imagenes-cargadas[]" multiple style="display:none;">
                    <button type="button" id="add-imagesPart" class="btn btn-primary" style="background: #d79e46; border-color: #d79e46">Agregar imágenes</button>
                    <br>
                <div id="image-containerDelete" class="d-flex flex-wrap mt-3" >
                    @foreach($images as $image)
                        <div class="image-wrapperDelete" data-path="{{ $image['path'] }}" style="position: relative; margin-inline-end: 10px; margin-block: 5px; border: 3px inset rgb(162, 80, 255); border-radius: 5px;">
                            <img style="width: 10rem;height: 7.5rem;" src="{{ $image['url'] }}" alt="imagen">
                            <button type="button"  data-path="{{ $image['path'] }}" style=" position: absolute;top: 0;right: 0;width: 30px;height: 30px;background-color: #f3395b;border-radius: 50%;color: white;font-size: 18px;text-align: center;line-height: 27px;vertical-align: middle;cursor: pointer;border: none;" {{-- onclick="handleDeleteImagePart('{{ $image['path'] }}', {{$product->id_producto}})" --}}>X</button>
                        </div>
                    @endforeach

                </div>

                <div id="hidden-inputs"></div>
                <input type="hidden" name="deleted_images" id="deleted_images">
                <input type="hidden" name="images" id="images" value="">
              </div>
              <div class="tile-footer">
      <div class="modal-footer">
<div id="loading-icon" class="loading-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="40" height="40">
  <img src="{{url('/static/images/loading.png')}}">
</div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background:red; border-color: red;">Cerrar</button>
        {!!Form::submit('SUBIR', ['class' => 'btn btn-primary', 'style' => 'background: #d79e46; border-color: #d79e46;', 'id' => 'enviarBtn'])!!}
      </div>      
              </div>
{!!Form::close()!!}
<script >
document.getElementById('add-Newimages').addEventListener('click', () =>{
  let newFileInput = document.getElementById('newFile-input');
  newFileInput.click();
});
</script>