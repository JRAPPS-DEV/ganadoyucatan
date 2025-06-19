@extends('Admin.sidebar')
@section('main')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style type="text/css">
  .control-label{
    color: black;
    font-weight: bold;
  }    
  @keyframes rotate {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
  }
#loading-icon {
  display: none;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(0deg);
  animation: rotate 1s linear infinite;
}

@keyframes rotate {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}
</style>

<main class="app-content">
  <div class="app-title">
    <div class="d-flex justify-content-between align-items-center">
      <h1>Panel de Control Ganadero</h1>
      <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-plus-circle"></i> Publicar Ganado
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#agregarGenetico">Ganado Genético</a></li>
          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#agregarComercial">Ganado Comercial</a></li>
          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#agregarSubasta">Subasta Ganadera</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Tabla de Ganado Genético -->
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="section-title genetico-title">Ganado Genético</div>
        <div class="tile-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="tableGenetico">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Raza</th>
                  <th>Precio</th>
                  <th>En venta</th>
                  <th>Visualizaciones</th>
                  <th>Rancho</th>
                  <th>Ubicación</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($geneticos as $p)
                  <tr>
                    <td>{{$p->nombre}}</td>
                    <td>{{$p->raza}}</td>
                    <td>{{$p->precio}}</td>
                    <td>@if($p->status == 1)<span class="badge badge-success">Activo</span>@else <span class="badge badge-danger">Inactivo</span>@endif</td>
                    <td>{{$p->visits->count()}}</td>
                    <td>{{$p->rancho}}</td>
                    <td>{{$p->location->nombre}}</td>
                    <td>
                      <button style="background-color:#d79e46;border-color: #d79e46;" class="btn btn-info btn-sm" onclick="openProductInNewTabGen('{{$p->idproducto}}', '{{$p->ruta}}')" title="Ver producto"><i class="far fa-eye"></i></button>
                      <button class="btn btn-primary btn-sm editProductBtnGenetico" data-id="{{$p->idproducto}}" title="Editar producto"><i class="fas fa-pencil-alt"></i></button>
                      <a href="{{ route('deleteGen', $p->idproducto) }}" class="btn btn-danger" title="Eliminar producto" onclick="confirmation(event)"><i class="far fa-trash-alt"></i></a>
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

  <!-- Tabla de Ganado Comercial -->
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="section-title comercial-title">Ganado Comercial</div>
        <div class="tile-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="tableComercial">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Tipo</th>
                  <th>Rancho</th>
                  <th>Visualizaciones</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($comerciales as $p)
                  <tr>
                    <td>{{$p->nombre}}</td>
                    <td>{{$p->stock}}</td>
                    <td>{{$p->precio}}</td>
                    <td>{{$p->tipo}}</td>
                    <td>{{$p->rancho}}</td>
                    <td>{{$p->visits->count()}}</td>
                    <td>
                      <button style="background-color:#425b28;border-color: #425b28;" class="btn btn-info btn-sm" onclick="openProductComercialInNewTab('{{$p->idproducto}}')" title="Ver producto"><i style="color:white;" class="far fa-eye"></i></button>
                      <button class="btn btn-primary btn-sm editProductBtnComercial" data-id="{{$p->idproducto}}" title="Editar producto"><i class="fas fa-pencil-alt"></i></button>
                      <a href="{{ route('deleteCom', $p->idproducto) }}" class="btn btn-danger" title="Eliminar producto" onclick="confirmation(event)"><i class="far fa-trash-alt"></i></a>
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

  <!-- Tabla de Subastas -->
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="section-title subasta-title">Subasta Ganadera</div>
        <div class="tile-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="tableSubasta">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Visualizaciones</th>
                  <th>Oferta Actual</th>
                  <th>En venta</th>
                  <th>Estatus</th>
                  <th>Rancho</th>
                  <th>Peso</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($subastas as $p)
                  <tr>
                    <td>{{$p->nombre}}</td>
                    <td>{{$p->visits->count()}}</td>
                    <td>{{$p->ofertas->count()}}</td>
                    <td>@if($p->status == 1)<span class="badge badge-success">Abierta</span>@else <span class="badge badge-danger">Finalizada</span>@endif</td>
                    <td>{{$p->estatus}}</td>
                    <td>{{$p->rancho}}</td>
                    <td>{{$p->peso}}</td>
                    <td>
                      <button style="background-color:#c31b36;border-color: #c31b36;" class="btn btn-info btn-sm" onclick="openProductSubastaInNewTab('{{$p->id_producto}}')" title="Ver producto"><i class="far fa-eye"></i></button>
                      <button class="btn btn-primary btn-sm editProductBtnSubasta" data-id="{{$p->id_producto}}" title="Editar producto"><i class="fas fa-pencil-alt"></i></button>
                      <a href="{{ route('deleteSub', $p->id_producto) }}" class="btn btn-danger" title="Eliminar producto" onclick="confirmation(event)"><i class="far fa-trash-alt"></i></a>
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
</main>
<!-- Modal para Ganado Genético -->
<div class="modal fade" id="agregarGenetico" tabindex="-1" aria-labelledby="agregarGenetico" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div style="background: #d79e46; border-color:#d79e46;" class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Agregar Ganado Genético</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    {!!Form::open(['url'=> 'admin/products/addNewGen', 'files' => true, 'style' => 'padding: 0;'])!!}
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
                      <label class="control-label">Enlance Youtube</label>
                      <input class="form-control" id="txtLink" name="txtLink" type="text">
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
                     <!-- Incluye Envío -->
                          <div class="form-group col-md-6">
                              <div class="checkbox">
                                  <label class="control-label">
                                      <input type="checkbox" id="chkIncluyeEnvio" name="chkIncluyeEnvio" value="1">
                                      Incluye Envío
                                  </label>
                              </div>
                          </div>

                          <!-- Precio del Envío (se muestra solo si se marca incluye envío) -->
                          <div class="form-group col-md-6" id="divPrecioEnvio" style="display: none;">
                              <label class="control-label">Precio del Envío</label>
                              <input class="form-control" id="txtPrecioEnvio" name="txtPrecioEnvio" 
                                     type="number" step="0.01" min="0">
                              <small class="form-text text-muted">Costo del envío (opcional)</small>
                          </div>
                          <!-- Configuración de Envío (Mapa) -->
                        <div id="divConfiguracionEnvio" style="display: none;">
                            <div class="form-group col-md-12">
                                <h5>Configuración del Área de Envío</h5>
                                <hr>
                            </div>
                            
                            <!-- Radio de Envío -->
                            <div class="form-group col-md-6">
                                <label class="control-label">Radio de Envío (km)</label>
                                <input class="form-control" id="txtEnvioRadio" name="txtEnvioRadio" 
                                       type="number" min="1" max="500" placeholder="Ej: 50">
                                <small class="form-text text-muted">Distancia máxima para envío</small>
                            </div>
                            
                            <!-- Buscar ubicación -->
{{--                             <div class="form-group col-md-6">
                                <label class="control-label">Buscar Ubicación</label>
                                <input class="form-control" id="txtBuscarUbicacion" type="text" 
                                       placeholder="Buscar dirección...">
                                <small class="form-text text-muted">Escribe para buscar una dirección</small>
                            </div> --}}
                            
                            <!-- Mapa -->
                            <div class="form-group col-md-12">
                                <label class="control-label">Seleccionar Centro de Envío</label>
                                <div id="mapEnvio" style="height: 400px; width: 100%; border: 1px solid #ccc;"></div>
                                <small class="form-text text-muted">Haz clic en el mapa para seleccionar el centro de tu área de envío</small>
                            </div>
                            
                            <!-- Campos ocultos para coordenadas -->
                            <input type="hidden" id="txtEnvioLatitud" name="txtEnvioLatitud">
                            <input type="hidden" id="txtEnvioLongitud" name="txtEnvioLongitud">
                            <input type="hidden" id="txtEnvioDireccion" name="txtEnvioDireccion">
                            
                            <!-- Información seleccionada -->
                            <div class="form-group col-md-12">
                                <div id="infoUbicacionSeleccionada" class="alert alert-info" style="display: none;">
                                    <strong>Ubicación seleccionada:</strong>
                                    <p id="direccionSeleccionada"></p>
                                    <small>Radio de envío: <span id="radioSeleccionado"></span> km</small>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-4">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <div class="form-group">
                          <label class="control-label"> Peso del ganado <span class="required">*</span></label>
                          <input maxlength="5" class="form-control" id="txtCodigo" name="txtCodigo" type="text" placeholder="Peso en kilogramos" required="">
                          
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <div class="form-group">
                          <label class="control-label"> Edad del ganado <span class="required">*</span></label>
                          <input maxlength="5" class="form-control" id="txtEdad" name="txtEdad" type="number" placeholder="Edad en años" required="">
                          
                      </div>
                    </div>
                  </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Precio <span class="required">*</span></label>
                            <input maxlength="11" class="form-control" id="txtPrecio" name="txtPrecio" type="text" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Cantidad Disponible<span class="required">*</span></label>
                            <input class="form-control" maxlength="5" id="txtStock" name="txtStock" type="number" required="">
                        </div>
                        <!-- Imagen de Arete (Obligatorio) -->
                          <div class="form-group col-md-6">
                              <label class="control-label">Imagen del Arete<span class="required">*</span></label>
                              <input class="form-control" id="txtAreteImagen" name="txtAreteImagen" type="file" 
                                     accept="image/*" required="">
                              <small class="form-text text-muted">Formatos permitidos: JPG, PNG, GIF</small>
                          </div>

                          <!-- Certificado de Propiedad -->
                          <div class="form-group col-md-6">
                              <label class="control-label">Certificado de Propiedad</label>
                              <input class="form-control" id="txtCertificadoPropiedad" name="txtCertificadoPropiedad" 
                                     type="file" accept="image/*">
                              <small class="form-text text-muted">Imagen del certificado (Opcional)</small>
                          </div>

                          <!-- Historial del Ganado -->
                          <div class="form-group col-md-6">
                              <label class="control-label">Historial del Ganado</label>
                              <input class="form-control" id="txtHistorialGanado" name="txtHistorialGanado" 
                                     type="file" accept="image/*,.pdf">
                              <small class="form-text text-muted">Imagen o PDF del historial (Opcional)</small>
                          </div>

                          <!-- Precio a Tratar -->
                          <div class="form-group col-md-6">
                              <div class="checkbox">
                                  <label class="control-label">
                                      <input type="checkbox" id="chkPrecioTratar" name="chkPrecioTratar" value="1">
                                      Precio a Tratar
                                  </label>
                                  <small class="form-text text-muted">Marcar si el precio es negociable</small>
                              </div>
                          </div>


                          {{-- <div class="form-group col-md-6">
                            <label class="control-label">Nombre del rancho</label>
                            <input class="form-control" maxlength="50" id="txtRancho" name="txtRancho" type="text" >
                        </div> --}}
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
                       <div class="form-group col-md-6">
                            <label class="control-label" for="listVacu">Vacunado</label>
                            <select class="form-control selectpicker" id="listVacu" name="listVacu">
                              <option value="Vacunado">Vacunado</option>
                              <option value="NO Vacunado">No Vacunado</option>
                            </select>
                      </div>{{-- 
                        <div class="form-group col-md-6">
                            <label class="control-label" for="listArete">Arete</label>
                            <select class="form-control selectpicker" id="listArete" name="listArete" >
                              <option value="Con Arete">Con Arete</option>
                              <option value="Sin Arete">Sin Arete</option>
                            </select>
                        </div> --}}
                       {{--  <div class="form-group col-md-6">
                            <label class="control-label" for="listCert">Certicado</label>
                            <select class="form-control selectpicker" id="listCert" name="listCert" >
                              <option value="Certificado">Cuenta con certificado</option>
                              <option value="NO certificado">NO cuenta con certificado</option>
                            </select>
                        </div>  --}}
                        <div class="form-group col-md-6">
                            <label class="control-label" class="control-label">Tipo</label>
                            <select class="form-control selectpicker" id="txtTipo" name="txtTipo" >
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
              </div>
              <div class="container">
                    <input type="file" id="file-inputGen" name="imagenes-cargadas[]" multiple style="display:none;">
                    <button type="button" id="add-imagesGen" class="btn btn-primary" style="background: #d79e46; border-color: #d79e46">Agregar imágenes genetico</button>
                    <br>
                    <div id="image-container" class="d-flex flex-wrap mt-3" >
                        <!-- Imágenes aquí -->
                    </div>
                <div id="hidden-inputs"></div>
                <input type="hidden" name="deleted_images" id="deleted_images">
                <input type="hidden" name="images" id="images" value="">
              </div>              
              <div class="container">
                    <label for="video">Cargar video:</label>
                    <input type="file" name="video" id="video" accept="video/mp4, video/avi, video/mov, video/mpeg, video/quicktime">
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
      </div>
    </div>
  </div>
</div>

<!-- Modal para Ganado Comercial -->
<div class="modal fade" id="agregarComercial" tabindex="-1" aria-labelledby="agregarComercial" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div style="background: #425b28; border-color:#425b28;" class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Agregar Ganado Comercial</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            {!!Form::open(['url'=> 'admin/products/addNewCom', 'files' => true, 'style' => 'padding: 0;'])!!}
        {{-- <form id="formProductos" name="formProductos" class="form-horizontal" style="padding: 0;"> --}}
              <input type="hidden" id="idProducto" name="idProducto" value="">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
              <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                      <label class="control-label">Título del Anuncio <span class="required">*</span></label>
                      <input class="form-control" maxlength="50" id="txtNombre" name="txtNombre" type="text" required="">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Características</label>
                      <textarea class="form-control" maxlength="250" id="txtDescripcion" name="txtDescripcion" ></textarea>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Enlance Youtube</label>
                      <input class="form-control" id="txtLink" name="txtLink" type="text">
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="estadosCom">Estado:</label>
                      <select class="form-control" name="estadosCom" id="estadosCom">
                          <option value=""></option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="ciudadesCom">Ciudad:</label>
                        <select  class="form-control" name="ciudadesCom" id="ciudadesCom">
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="comisariasCom">Comisarias:</label>
                        <select class="form-control"  name="comisariasCom" id="comisariasCom">
                        </select>
                    </div>
                     <!-- Incluye Envío -->
                          <div class="form-group col-md-6">
                              <div class="checkbox">
                                  <label class="control-label">
                                      <input type="checkbox" id="chkIncluyeEnviot" name="chkIncluyeEnviot" value="1">
                                      Incluye Envío
                                  </label>
                              </div>
                          </div>

                          <!-- Precio del Envío (se muestra solo si se marca incluye envío) -->
                          <div class="form-group col-md-6" id="divPrecioEnviot" style="display: none;">
                              <label class="control-label">Precio del Envío</label>
                              <input class="form-control" id="txtPrecioEnvio" name="txtPrecioEnviot" 
                                     type="number" step="0.01" min="0">
                              <small class="form-text text-muted">Costo del envío (opcional)</small>
                          </div>
                          <!-- Configuración de Envío (Mapa) -->
                        <div id="divConfiguracionEnviot" style="display: none;">
                            <div class="form-group col-md-12">
                                <h5>Configuración del Área de Envío</h5>
                                <hr>
                            </div>
                            
                            <!-- Radio de Envío -->
                            <div class="form-group col-md-6">
                                <label class="control-label">Radio de Envío (km)</label>
                                <input class="form-control" id="txtEnvioRadiot" name="txtEnvioRadiot" 
                                       type="number" min="1" max="500" placeholder="Ej: 50">
                                <small class="form-text text-muted">Distancia máxima para envío</small>
                            </div>
                            
                            <!-- Buscar ubicación -->
{{--                             <div class="form-group col-md-6">
                                <label class="control-label">Buscar Ubicación</label>
                                <input class="form-control" id="txtBuscarUbicaciont" type="text" 
                                       placeholder="Buscar dirección...">
                                <small class="form-text text-muted">Escribe para buscar una dirección</small>
                            </div> --}}
                            
                            <!-- Mapa -->
                            <div class="form-group col-md-12">
                                <label class="control-label">Seleccionar Centro de Envío</label>
                                <div id="mapEnviot" style="height: 400px; width: 100%; border: 1px solid #ccc;"></div>
                                <small class="form-text text-muted">Haz clic en el mapa para seleccionar el centro de tu área de envío</small>
                            </div>
                            
                            <!-- Campos ocultos para coordenadas -->
                            <input type="hidden" id="txtEnvioLatitudt" name="txtEnvioLatitudt">
                            <input type="hidden" id="txtEnvioLongitudt" name="txtEnvioLongitudt">
                            <input type="hidden" id="txtEnvioDirecciont" name="txtEnvioDirecciont">
                            
                            <!-- Información seleccionada -->
                            <div class="form-group col-md-12">
                                <div id="infoUbicacionSeleccionadat" class="alert alert-info" style="display: none;">
                                    <strong>Ubicación seleccionada:</strong>
                                    <p id="direccionSeleccionadat"></p>
                                    <small>Radio de envío: <span id="radioSeleccionado"></span> km</small>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-4">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <div class="form-group">
                          <label class="control-label"> Peso del ganado <span class="required">*</span></label>
                          <input maxlength="5" class="form-control" id="pesoG" name="pesoG" type="text" placeholder="Peso en kilogramos" required="">
                          
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <div class="form-group">
                          <label class="control-label"> Edad del ganado <span class="required">*</span></label>
                          <input maxlength="5" class="form-control" id="txtEdad" name="txtEdad" type="number" placeholder="Edad en años" required="">
                          
                      </div>
                    </div>
                  </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Precio <span class="required">*</span></label>
                            <input maxlength="11" class="form-control" id="precio" name="precio" type="text" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Cantidad Disponible<span class="required">*</span></label>
                            <input class="form-control" maxlength="5" id="txtStock" name="txtStock" type="text" required="">
                        </div>
                          <div class="form-group col-md-6">
                            <label class="control-label">Nombre del rancho</label>
                            <input class="form-control" maxlength="50" id="txtRancho" name="txtRancho" type="text" >
                        </div>   
                                             <!-- Imagen de Arete (Obligatorio) -->
                          <div class="form-group col-md-6">
                              <label class="control-label">Imagen del Arete<span class="required">*</span></label>
                              <input class="form-control" id="txtAreteImagent" name="txtAreteImagent" type="file" 
                                     accept="image/*" required="">
                              <small class="form-text text-muted">Formatos permitidos: JPG, PNG, GIF</small>
                          </div>

                          <!-- Certificado de Propiedad -->
                          <div class="form-group col-md-6">
                              <label class="control-label">Certificado de Propiedad</label>
                              <input class="form-control" id="txtCertificadoPropiedadt" name="txtCertificadoPropiedadt" 
                                     type="file" accept="image/*">
                              <small class="form-text text-muted">Imagen del certificado (Opcional)</small>
                          </div>

                          <!-- Historial del Ganado -->
                          <div class="form-group col-md-6">
                              <label class="control-label">Historial del Ganado</label>
                              <input class="form-control" id="txtHistorialGanadot" name="txtHistorialGanadot" 
                                     type="file" accept="image/*,.pdf">
                              <small class="form-text text-muted">Imagen o PDF del historial (Opcional)</small>
                          </div>

                          <!-- Precio a Tratar -->
                          <div class="form-group col-md-6">
                              <div class="checkbox">
                                  <label class="control-label">
                                      <input type="checkbox" id="chkPrecioTratart" name="chkPrecioTratart" value="1">
                                      Precio a Tratar
                                  </label>
                                  <small class="form-text text-muted">Marcar si el precio es negociable</small>
                              </div>
                          </div>
                         <!-- <div class="form-group col-md-6">
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
                              <option value="Indubrazil">Indubrazil </option>
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
                        </div> -->
                       <div class="form-group col-md-6">
                            <label class="control-label" for="listVacu">Vacunado</label>
                            <select class="form-control selectpicker" id="listVacu" name="listVacu">
                              <option value="Vacunado">Vacunado</option>
                              <option value="NO Vacunado">No Vacunado</option>
                            </select>
                      </div>
{{--                         <div class="form-group col-md-6">
                            <label class="control-label" for="listArete">Arete</label>
                            <select class="form-control selectpicker" id="listArete" name="listArete" >
                              <option value="Con Arete">Con Arete</option>
                              <option value="Sin Arete">Sin Arete</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="listCert">Certicado</label>
                            <select class="form-control selectpicker" id="listCert" name="listCert" >
                              <option value="Certificado">Cuenta con certificado</option>
                              <option value="NO certificado">NO cuenta con certificado</option>
                            </select>
                        </div>  --}}
                        <div class="form-group col-md-6">
                            <label class="control-label" class="control-label">Tipo</label>
                                <select class="form-control selectpicker" id="txtTipo" name="txtTipo" >
                                <option value="Destetes">Destetes</option>
                                <option value="Novillas">Novillas</option>
                                <option value="Ternero">Ternero</option>
                                <option value="Toro de engorda">Toro de engorda</option>
                                <option value="Vaca de engorda">Vaca de engorda</option>
                                <option value="Vaquillona">Vaquillona</option>
                                <option value="Vaquillonas preñadas">Vaquillonas preñadas</option>
                                <option value="Ganado para matadero">Ganado para matadero</option>
                                <option value="Vaca terminada<">Vaca terminada</option>
                                <option value="Toro terminado">Toro terminado</option>
                                <option value="Novillonas de registro">Novillonas de registro</option>
                                <option value="Novillonas preñada">Novillonas preñadas</option>
                                <option value="Toro para cebar">Toro para cebar</option>
                                <option value="Vaca para cebar">Vaca para cebar</option>
                                <option value="Vaca Semiterminada">Vaca Semiterminada</option>
                                <option value="Toro Semiterminado">Toro Semiterminado</option>
                                <option value="Toro Castrado">Toro Castrado</option>
                               <option value="pie de cria">pie de cria</option>
                               <option value="novillonas para empadre">novillonas para empadre</option>
                            </select>
                        </div> 
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
                    <input type="file" id="file-inputCom" name="imagenes-cargadasCom[]" multiple style="display:none;" required="Agregar al menos una imagen">
                    <button type="button" id="add-imagesCom" class="btn btn-primary" style="background: #425b28; border-color: #425b28">Agregar imágenes Comercial</button>
                    <br>
                    <div id="image-containerCom" class="d-flex flex-wrap mt-3" >
                        <!-- Imágenes aquí -->
                    </div>
                <div id="hidden-inputs"></div>
                <input type="hidden" name="deleted_images" id="deleted_images">
                <input type="hidden" name="imagesCom" id="imagesCom" value="">
              </div>              
              <div class="container">
                    <label for="video">Cargar video:</label>
                    <input type="file" name="video" id="video" accept="video/mp4, video/avi, video/mov, video/mpeg, video/quicktime">
              </div>
              
              <div class="tile-footer">
                <div class="modal-footer">
                  <div id="loading-icon" class="loading-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="40" height="40">
                    <img src="{{url('/static/images/loading.png')}}">
                  </div>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background:red; border-color: red;">Cerrar</button>
                   {!!Form::submit('SUBIR', ['class' => 'btn btn-primary', 'style' => 'background: #425b28; border-color: #425b28;', 'id' => 'enviarBtn'])!!}
                </div>
              </div>      
              </div>
          {!!Form::close()!!} 
      </div>
    </div>
  </div>
</div>

<!-- Modal para Subasta -->
<div class="modal fade" id="agregarSubasta" tabindex="-1" aria-labelledby="agregarSubasta" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div style="background: #c31b36; border-color:#c31b36;" class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Agregar Nueva Subasta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            {!!Form::open(['url'=> 'admin/products/addNewSub', 'files' => true, 'style' => 'padding: 0;'])!!}
            @csrf
              <input type="hidden" id="idProducto" name="idProducto" value="">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Título del Anuncio <span class="required">*</span></label>
                      <input class="form-control" maxlength="100" id="txtNombre" name="txtNombre" type="text" required="">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Características</label>
                      <textarea class="form-control" maxlength="550" id="txtDescripcion" name="txtDescripcion" ></textarea>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Enlance Youtube</label>
                      <input class="form-control" id="txtLink" name="txtLink" type="text" >
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="estadosSub">Estado:</label>
                      <select class="form-control" name="estadosSub" id="estadosSub">
                          <option value=""></option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="ciudadesSub">Ciudad:</label>
                        <select  class="form-control" name="ciudadesSub" id="ciudadesSub">
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="comisariasSub">Comisarias:</label>
                        <select class="form-control"  name="comisariasSub" id="comisariasSub">
                        </select>
                    </div>
                        <!-- Incluye Envío -->
                          <div class="form-group col-md-6">
                              <div class="checkbox">
                                  <label class="control-label">
                                      <input type="checkbox" id="chkIncluyeEnvios" name="chkIncluyeEnvios" value="1">
                                      Incluye Envío
                                  </label>
                              </div>
                          </div>

                          <!-- Precio del Envío (se muestra solo si se marca incluye envío) -->
                          <div class="form-group col-md-6" id="divPrecioEnviot" style="display: none;">
                              <label class="control-label">Precio del Envío</label>
                              <input class="form-control" id="txtPrecioEnvios" name="txtPrecioEnvios" 
                                     type="number" step="0.01" min="0">
                              <small class="form-text text-muted">Costo del envío (opcional)</small>
                          </div>
                          <!-- Configuración de Envío (Mapa) -->
                        <div id="divConfiguracionEnvios" style="display: none;">
                            <div class="form-group col-md-12">
                                <h5>Configuración del Área de Envío</h5>
                                <hr>
                            </div>
                            
                            <!-- Radio de Envío -->
                            <div class="form-group col-md-6">
                                <label class="control-label">Radio de Envío (km)</label>
                                <input class="form-control" id="txtEnvioRadios" name="txtEnvioRadios" 
                                       type="number" min="1" max="500" placeholder="Ej: 50">
                                <small class="form-text text-muted">Distancia máxima para envío</small>
                            </div>
                            
                            <!-- Buscar ubicación -->
{{--                             <div class="form-group col-md-6">
                                <label class="control-label">Buscar Ubicación</label>
                                <input class="form-control" id="txtBuscarUbicaciont" type="text" 
                                       placeholder="Buscar dirección...">
                                <small class="form-text text-muted">Escribe para buscar una dirección</small>
                            </div> --}}
                            
                            <!-- Mapa -->
                            <div class="form-group col-md-12">
                                <label class="control-label">Seleccionar Centro de Envío</label>
                                <div id="mapEnviot" style="height: 400px; width: 100%; border: 1px solid #ccc;"></div>
                                <small class="form-text text-muted">Haz clic en el mapa para seleccionar el centro de tu área de envío</small>
                            </div>
                            
                            <!-- Campos ocultos para coordenadas -->
                            <input type="hidden" id="txtEnvioLatituds" name="txtEnvioLatituds">
                            <input type="hidden" id="txtEnvioLongituds" name="txtEnvioLongituds">
                            <input type="hidden" id="txtEnvioDireccions" name="txtEnvioDireccions">
                            
                            <!-- Información seleccionada -->
                            <div class="form-group col-md-12">
                                <div id="infoUbicacionSeleccionadas" class="alert alert-info" style="display: none;">
                                    <strong>Ubicación seleccionada:</strong>
                                    <p id="direccionSeleccionadas"></p>
                                    <small>Radio de envío: <span id="radioSeleccionados"></span> km</small>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <div class="form-group">
                          <label class="control-label"> Peso del ganado <span class="required">*</span></label>
                          <input maxlength="5" class="form-control" id="txtCodigo" name="txtCodigo" type="number" placeholder="Peso en kilogramos" required="">
                          
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <div class="form-group">
                          <label class="control-label"> Edad del ganado <span class="required">*</span></label>
                          <input maxlength="5" class="form-control" id="txtEdad" name="txtEdad" type="number" placeholder="Edad en años" required="">
                          
                      </div>
                    </div>
                  </div>

                    <div class="row">{{-- 
                        <div class="form-group col-md-6">
                            <label class="control-label">Precio <span class="required">*</span></label>
                            <input maxlength="11" class="form-control" id="txtPrecio" name="txtPrecio" type="text" required="">
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label class="control-label">Cantidad Disponible<span class="required">*</span></label>
                            <input class="form-control" maxlength="5" id="txtStock" name="txtStock" type="text" required="">
                        </div>
                          <div class="form-group col-md-6">
                            <label class="control-label">Nombre del rancho</label>
                            <input class="form-control" maxlength="50" id="txtRancho" name="txtRancho" type="text" >
                        </div>
                         <div class="form-group col-md-6">
                            <label class="control-label">Tipo de Ganado</label>
                            <select class="form-control selectpicker" id="lisTipo" name="lisTipo" >
                                <option value="Destetes">Destetes</option>
                                <option value="Novillas">Novillas</option>
                                <option value="Ternero">Ternero</option>
                                <option value="Toro de engorda">Toro de engorda</option>
                                <option value="Vaca de engorda">Vaca de engorda</option>
                                <option value="Vaquillona">Vaquillona</option>
                                <option value="Vaquillonas preñadas">Vaquillonas preñadas</option>
                                <option value="Ganado para matadero">Ganado para matadero</option>
                                <option value="Vaca terminada<">Vaca terminada</option>
                                <option value="Toro terminado">Toro terminado</option>
                                <option value="Novillonas de registro">Novillonas de registro</option>
                                <option value="Novillonas preñada">Novillonas preñadas</option>
                                <option value="Toro para cebar">Toro para cebar</option>
                                <option value="Vaca para cebar">Vaca para cebar</option>
                                <option value="Vaca Semiterminada">Vaca Semiterminada</option>
                                <option value="Toro Semiterminado">Toro Semiterminado</option>
                                <option value="Toro Castrado">Toro Castrado</option>
                            </select>
                        </div>
                       <div class="form-group col-md-6">
                            <label class="control-label" for="listVacu">Vacunado</label>
                            <select class="form-control selectpicker" id="listVacu" name="listVacu">
                              <option value="Vacunado">Vacunado</option>
                              <option value="NO Vacunado">No Vacunado</option>
                            </select>
                      </div>                                             <!-- Imagen de Arete (Obligatorio) -->
                          <div class="form-group col-md-6">
                              <label class="control-label">Imagen del Arete<span class="required">*</span></label>
                              <input class="form-control" id="txtAreteImagens" name="txtAreteImagens" type="file" 
                                     accept="image/*" required="">
                              <small class="form-text text-muted">Formatos permitidos: JPG, PNG, GIF</small>
                          </div>

                          <!-- Certificado de Propiedad -->
                          <div class="form-group col-md-6">
                              <label class="control-label">Certificado de Propiedad</label>
                              <input class="form-control" id="txtCertificadoPropiedads" name="txtCertificadoPropiedads" 
                                     type="file" accept="image/*">
                              <small class="form-text text-muted">Imagen del certificado (Opcional)</small>
                          </div>

                          <!-- Historial del Ganado -->
                          <div class="form-group col-md-6">
                              <label class="control-label">Historial del Ganado</label>
                              <input class="form-control" id="txtHistorialGanados" name="txtHistorialGanados" 
                                     type="file" accept="image/*,.pdf">
                              <small class="form-text text-muted">Imagen o PDF del historial (Opcional)</small>
                          </div>

                          <!-- Precio a Tratar -->
                          <div class="form-group col-md-6">
                              <div class="checkbox">
                                  <label class="control-label">
                                      <input type="checkbox" id="chkPrecioTratars" name="chkPrecioTratars" value="1">
                                      Precio a Tratar
                                  </label>
                                  <small class="form-text text-muted">Marcar si el precio es negociable</small>
                              </div>
                          </div>
{{--                         <div class="form-group col-md-6">
                            <label class="control-label" for="listArete">Arete</label>
                            <select class="form-control selectpicker" id="listArete" name="listArete" >
                              <option value="Con Arete">Con Arete</option>
                              <option value="Sin Arete">Sin Arete</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="listCert">Certicado</label>
                            <select class="form-control selectpicker" id="listCert" name="listCert" >
                              <option value="Certificado">Cuenta con certificado</option>
                              <option value="NO certificado">NO cuenta con certificado</option>
                            </select>
                        </div> 
                        <div class="form-group col-md-6">
                        </div>  --}}
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Precio minimo</label>
                            <input type="number" id="min" name="min" class="form-control">
                        </div>                        
                        <div class="form-group col-md-6">
                            <label class="control-label">Precio maximo</label>
                            <input type="number" id="max" name="max" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                          <label class="control-label">Fecha de cierre</label>
                          <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required>
                        </div>                        
                        <div class="form-group col-md-6">
                          <label class="control-label">Hora de cierre</label>
                            <input type="time" id="hora_fin" name="hora_fin" class="form-control" required>
                        </div>
                    </div>
                </div>
              </div>
              <div class="container">
                    <input type="file" id="file-inputSub" name="imagenes-cargadasSub[]" multiple style="display:none;" required="Agregar al menos una imagen">
                    <button type="button" id="add-imagesSub" class="btn btn-primary" style="background: #c31b36; border-color: #c31b36">Agregar imágenes Subasta</button>
                    <br>
                    <div id="image-containerSub" class="d-flex flex-wrap mt-3" >
                        <!-- Imágenes aquí -->
                    </div>
                <div id="hidden-inputs"></div>
                <input type="hidden" name="deleted_images" id="deleted_images">
                <input type="hidden" name="imagesSub" id="imagesSub" value="">
              </div>              
              <div class="container">
                    <label for="video">Cargar video:</label>
                    <input type="file" name="video" id="video" accept="video/mp4, video/avi, video/mov, video/mpeg, video/quicktime">
              </div>

              
              <div class="tile-footer">
      <div class="modal-footer">
        <div id="loading-icon" class="loading-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="40" height="40">
          <img src="{{url('/static/images/loading.png')}}">
        </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background:red; border-color: red;">Cerrar</button>
         {!!Form::submit('SUBIR', ['class' => 'btn btn-primary', 'style' => 'background: #c31b36; border-color: #c31b36;', 'id' => 'enviarBtn'])!!}
      </div>
    </div>
    {!!Form::close()!!} 
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>     
<script src="{{url('/static/js/admin/location.js') }}" >
</script>    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script>
// Objetos para almacenar instancias separadas por sufijo
let maps = {};
let markers = {};
let circles = {};
let geocoder;
let autocompletes = {};

// Event listeners para todas las versiones
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar geocoder una sola vez
    if (typeof google !== 'undefined' && google.maps) {
        geocoder = new google.maps.Geocoder();
    }
    
    // Versión original (sin sufijo)
    const chkIncluyeEnvio = document.getElementById('chkIncluyeEnvio');
    if (chkIncluyeEnvio) {
        chkIncluyeEnvio.addEventListener('change', function() {
            const precioEnvioDiv = document.getElementById('divPrecioEnvio');
            const configuracionDiv = document.getElementById('divConfiguracionEnvio');
            
            if (this.checked) {
                if (precioEnvioDiv) precioEnvioDiv.style.display = 'block';
                if (configuracionDiv) configuracionDiv.style.display = 'block';
                
                // Inicializar mapa si no existe
                if (!maps['']) {
                    setTimeout(() => initMap(''), 100);
                }
            } else {
                if (precioEnvioDiv) precioEnvioDiv.style.display = 'none';
                if (configuracionDiv) configuracionDiv.style.display = 'none';
                clearFields('');
            }
        });
        
        const txtEnvioRadio = document.getElementById('txtEnvioRadio');
        if (txtEnvioRadio) {
            txtEnvioRadio.addEventListener('input', function() {
                actualizarCirculo('');
            });
        }
    }
    
    // Versión con 't'
    const chkIncluyeEnviot = document.getElementById('chkIncluyeEnviot');
    if (chkIncluyeEnviot) {
        chkIncluyeEnviot.addEventListener('change', function() {
            const precioEnvioDiv = document.getElementById('divPrecioEnviot');
            const configuracionDiv = document.getElementById('divConfiguracionEnviot');
            
            if (this.checked) {
                if (precioEnvioDiv) precioEnvioDiv.style.display = 'block';
                if (configuracionDiv) configuracionDiv.style.display = 'block';
                
                // Inicializar mapa si no existe
                if (!maps['t']) {
                    setTimeout(() => initMap('t'), 100);
                }
            } else {
                if (precioEnvioDiv) precioEnvioDiv.style.display = 'none';
                if (configuracionDiv) configuracionDiv.style.display = 'none';
                clearFields('t');
            }
        });
        
        const txtEnvioRadiot = document.getElementById('txtEnvioRadiot');
        if (txtEnvioRadiot) {
            txtEnvioRadiot.addEventListener('input', function() {
                actualizarCirculo('t');
            });
        }
    }
    
    // Versión con 's'
    const chkIncluyeEnvios = document.getElementById('chkIncluyeEnvios');
    if (chkIncluyeEnvios) {
        chkIncluyeEnvios.addEventListener('change', function() {
            const precioEnvioDiv = document.getElementById('divPrecioEnvios');
            const configuracionDiv = document.getElementById('divConfiguracionEnvios');
            
            if (this.checked) {
                if (precioEnvioDiv) precioEnvioDiv.style.display = 'block';
                if (configuracionDiv) configuracionDiv.style.display = 'block';
                
                // Inicializar mapa si no existe
                if (!maps['s']) {
                    setTimeout(() => initMap('s'), 100);
                }
            } else {
                if (precioEnvioDiv) precioEnvioDiv.style.display = 'none';
                if (configuracionDiv) configuracionDiv.style.display = 'none';
                clearFields('s');
            }
        });
        
        const txtEnvioRadios = document.getElementById('txtEnvioRadios');
        if (txtEnvioRadios) {
            txtEnvioRadios.addEventListener('input', function() {
                actualizarCirculo('s');
            });
        }
    }
});

function clearFields(suffix) {
    const txtPrecioEnvio = document.getElementById('txtPrecioEnvio' + suffix);
    const txtEnvioRadio = document.getElementById('txtEnvioRadio' + suffix);
    const txtEnvioLatitud = document.getElementById('txtEnvioLatitud' + suffix);
    const txtEnvioLongitud = document.getElementById('txtEnvioLongitud' + suffix);
    const txtEnvioDireccion = document.getElementById('txtEnvioDireccion' + suffix);
    const infoUbicacion = document.getElementById('infoUbicacionSeleccionada' + suffix);
    
    if (txtPrecioEnvio) txtPrecioEnvio.value = '';
    if (txtEnvioRadio) txtEnvioRadio.value = '';
    if (txtEnvioLatitud) txtEnvioLatitud.value = '';
    if (txtEnvioLongitud) txtEnvioLongitud.value = '';
    if (txtEnvioDireccion) txtEnvioDireccion.value = '';
    if (infoUbicacion) infoUbicacion.style.display = 'none';
}

// Inicializar mapa específico para cada sufijo
function initMap(suffix) {
    console.log('Inicializando mapa para sufijo: "' + suffix + '"');
    
    // Coordenadas de Mérida, Yucatán como centro inicial
    const meridaCoords = { lat: 20.9674, lng: -89.5926 };
    
    const mapElement = document.getElementById('mapEnvio' + suffix);
    if (!mapElement) {
        console.error('No se encontró el elemento del mapa: mapEnvio' + suffix);
        return;
    }
    
    // Crear mapa específico para este sufijo
    maps[suffix] = new google.maps.Map(mapElement, {
        zoom: 12,
        center: meridaCoords,
        mapTypeId: 'roadmap'
    });
    
    console.log('Mapa creado exitosamente para sufijo: "' + suffix + '"');
    
    // Inicializar geocoder si no existe
    if (!geocoder && typeof google !== 'undefined' && google.maps) {
        geocoder = new google.maps.Geocoder();
    }
    
    // Configurar autocompletado
    const input = document.getElementById('txtBuscarUbicacion' + suffix);
    if (input && typeof google !== 'undefined' && google.maps && google.maps.places) {
        console.log('Configurando autocompletado para: txtBuscarUbicacion' + suffix);
        
        // Limpiar el input
        input.value = '';
        
        autocompletes[suffix] = new google.maps.places.Autocomplete(input, {
            componentRestrictions: { country: 'mx' },
            fields: ['place_id', 'geometry', 'name', 'formatted_address'],
            types: ['address']
        });
        
        // Listener para autocompletado
        autocompletes[suffix].addListener('place_changed', function() {
            const place = autocompletes[suffix].getPlace();
            
            if (!place.geometry || !place.geometry.location) {
                console.log('No se pudo obtener la ubicación');
                return;
            }
            
            const location = place.geometry.location;
            maps[suffix].setCenter(location);
            maps[suffix].setZoom(15);
            
            actualizarUbicacion(location.lat(), location.lng(), place.formatted_address || place.name, suffix);
        });
        
        // Listener adicional para Enter
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });
        
        // Evitar que el formulario se envíe al presionar Enter en el campo de búsqueda
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                return false;
            }
        });
        
        console.log('Autocompletado configurado exitosamente para sufijo: "' + suffix + '"');
    }
    
    // Listener para clics en el mapa
    maps[suffix].addListener('click', function(event) {
        const lat = event.latLng.lat();
        const lng = event.latLng.lng();
        
        // Obtener dirección de las coordenadas
        if (geocoder) {
            geocoder.geocode({ location: { lat: lat, lng: lng } }, function(results, status) {
                if (status === 'OK' && results[0]) {
                    actualizarUbicacion(lat, lng, results[0].formatted_address, suffix);
                } else {
                    actualizarUbicacion(lat, lng, `${lat.toFixed(6)}, ${lng.toFixed(6)}`, suffix);
                }
            });
        }
    });
}

function actualizarUbicacion(lat, lng, direccion, suffix) {
    console.log('Actualizando ubicación para sufijo: "' + suffix + '"');
    
    // Actualizar campos ocultos
    const txtEnvioLatitud = document.getElementById('txtEnvioLatitud' + suffix);
    const txtEnvioLongitud = document.getElementById('txtEnvioLongitud' + suffix);
    const txtEnvioDireccion = document.getElementById('txtEnvioDireccion' + suffix);
    
    if (txtEnvioLatitud) txtEnvioLatitud.value = lat;
    if (txtEnvioLongitud) txtEnvioLongitud.value = lng;
    if (txtEnvioDireccion) txtEnvioDireccion.value = direccion;
    
    // Limpiar marcador y círculo anteriores de este sufijo específico
    if (markers[suffix]) markers[suffix].setMap(null);
    if (circles[suffix]) circles[suffix].setMap(null);
    
    // Crear nuevo marcador para este sufijo
    markers[suffix] = new google.maps.Marker({
        position: { lat: lat, lng: lng },
        map: maps[suffix],
        title: 'Centro de envío',
        draggable: true
    });
    
    // Listener para cuando se arrastra el marcador
    markers[suffix].addListener('dragend', function(event) {
        const newLat = event.latLng.lat();
        const newLng = event.latLng.lng();
        
        if (geocoder) {
            geocoder.geocode({ location: { lat: newLat, lng: newLng } }, function(results, status) {
                if (status === 'OK' && results[0]) {
                    actualizarUbicacion(newLat, newLng, results[0].formatted_address, suffix);
                } else {
                    actualizarUbicacion(newLat, newLng, `${newLat.toFixed(6)}, ${newLng.toFixed(6)}`, suffix);
                }
            });
        }
    });
    
    // Actualizar círculo
    actualizarCirculo(suffix);
    
    // Mostrar información
    const direccionSeleccionada = document.getElementById('direccionSeleccionada' + suffix);
    const infoUbicacion = document.getElementById('infoUbicacionSeleccionada' + suffix);
    
    if (direccionSeleccionada) direccionSeleccionada.textContent = direccion;
    if (infoUbicacion) infoUbicacion.style.display = 'block';
}

function actualizarCirculo(suffix) {
    const txtEnvioRadio = document.getElementById('txtEnvioRadio' + suffix);
    const radio = txtEnvioRadio ? txtEnvioRadio.value : null;
    
    if (!radio || !markers[suffix]) return;
    
    // Limpiar círculo anterior de este sufijo específico
    if (circles[suffix]) circles[suffix].setMap(null);
    
    // Crear nuevo círculo para este sufijo
    circles[suffix] = new google.maps.Circle({
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.15,
        map: maps[suffix],
        center: markers[suffix].getPosition(),
        radius: parseInt(radio) * 1000 // Convertir km a metros
    });
    
    // Ajustar zoom para mostrar todo el círculo
    const bounds = circles[suffix].getBounds();
    maps[suffix].fitBounds(bounds);
    
    // Actualizar información
    const radioSeleccionado = document.getElementById('radioSeleccionado');
    if (radioSeleccionado) radioSeleccionado.textContent = radio;
}

// Función para reinicializar mapas cuando sea necesario (útil para modales)
function reinitializeMap(suffix) {
    console.log('Reinicializando mapa para sufijo: "' + suffix + '"');
    
    // Limpiar instancias anteriores
    if (maps[suffix]) {
        maps[suffix] = null;
    }
    if (markers[suffix]) {
        markers[suffix] = null;
    }
    if (circles[suffix]) {
        circles[suffix] = null;
    }
    if (autocompletes[suffix]) {
        autocompletes[suffix] = null;
    }
    
    // Reinicializar
    setTimeout(() => initMap(suffix), 100);
}

// Función global para llamar desde fuera si es necesario
window.reinitializeMap = reinitializeMap;
</script>

<!-- Cargar Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChlMigtzXBtS2ghPfmP4go4ycprwktPy0&libraries=places&callback=initMap" async defer></script>
</script>
<script >
  $(document).ready(function(){
    $('#viewProduct').on('click', function(){
      var productId = $(this).data('id');
      var url = 'TianguisAdminInfo/' + productId;
      $('#TianguisnfoContainer').empty();
      $.ajax({
        type: 'GET',
        url : url,
        success: function(response){
          $('#TianguisnfoContainer').html(response);
          $('#modalForTianguis').modal('show');
        },
        error: function(xhr, staus, error){
          //
        }
      });
    });
  });
function confirmation(ev){
  ev.preventDefault();
  var url = ev.currentTarget.getAttribute('href');
  swal({
    title: "¿Desea eliminar este producto?",
    text: "Esta publicación se eliminará para siempre",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((confirmCancel)=>{
    if(confirmCancel){
      window.location.href = url;
    }
  });
}
  function openGenInNewTab(id, ruta){
  const url = `/tienda/producto/${id}/${ruta}`;
  const newTab = window.open(url, '_blank');
  if(newTab){
    newTab.focus();
  }else{
    alert('Se ha bloqueado la apertura de una nueva ventana');
  }
}
function openSubInNewTab(id){
  const url =  `/subastas/${id}`;
  const newTab = window.open(url, '_blank');
  if(newTab){
    newTab.focus();
  }else{
    alerT('Se ha bloqueado la apertura de una nueva ventada');
  }
}function openProductInNewTabGen(id, ruta) {
  const url = `/tienda/producto/${id}/${ruta}`;
  window.open(url, '_blank');
}

function openProductComercialInNewTab(id) {
  const url = `/tianguis/producto/${id}`;
  window.open(url, '_blank');
}

function openProductSubastaInNewTab(id) {
  const url = `/subastas/${id}`;
  window.open(url, '_blank');
}

// Función de confirmación para eliminación
function confirmation(ev) {
  ev.preventDefault();
  var url = ev.currentTarget.getAttribute('href');
  swal({
    title: "¿Desea eliminar este elemento?",
    text: "Esta acción no se puede revertir",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((confirmCancel) => {
    if (confirmCancel) {
      window.location.href = url;
    }
  });
}
{{-- 
// Event listeners para edición (falta agregar esta logica, a espera de aprobacion)
$(document).ready(function() {
  // Editar producto genético
  $('.editProductBtnGenetico').on('click', function() {
    var productId = $(this).data('id');
    // Lógica para editar producto genético
  });
  
  // Editar producto comercial
  $('.editProductBtnComercial').on('click', function() {
    var productId = $(this).data('id');
    // Lógica para editar producto comercial
  });
  
  // Editar subasta
  $('.editProductBtnSubasta').on('click', function() {
    var productId = $(this).data('id');
    // Lógica para editar subasta
  });
}); --}}
</script>
{{-- scripts controlar imagenes --}}
</script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
let imagesArrayGen = [];
let deletedImagesGen = [];
let maxFilesGen = 30;



function updateImagesInputGen() {
    let imagesInput = document.getElementById('images');
    imagesInput.value = JSON.stringify(imagesArrayGen);
    let imageWrapper = document.querySelector('.image-wrapper[data-index="0"]');
    let firstImageWrapper = document.querySelector('.image-wrapper');
    let imageWrappers = document.querySelectorAll('.image-wrapper');
    imageWrappers.forEach((imageWrapper) => {
        if (imageWrapper.getAttribute('data-index') !== '0') {
            imageWrapper.style.border = '';
            imageWrapper.style.borderRadius = '';
            let label = imageWrapper.querySelector('.image-label');
            if (label) {
                label.remove();
            }
        } else {
            imageWrapper.style.border = '3px inset #a250ff';
            imageWrapper.style.borderRadius = '5px';
            let label = imageWrapper.querySelector('.image-label');
            if (label) {
                label.innerHTML = 'Imagen principal';
            } else {
                label = document.createElement('div');
                label.classList.add('image-label');
                label.innerHTML = 'Imagen principal';
                imageWrapper.appendChild(label);
            }
        }
    });
    if (!imageWrapper) {
        firstImageWrapper.style.border = '3px inset #a250ff';
        firstImageWrapper.style.borderRadius = '5px';
        label = document.createElement('div');
        label.classList.add('image-label');
        label.innerHTML = 'Imagen principal';
        firstImageWrapper.appendChild(label);
    }
}
function addImageGen(image) {
    let container = document.getElementById('image-container');
    let newImage = document.createElement('div');
    newImage.setAttribute('class', 'image-wrapper');
    newImage.style.position = 'relative';
    newImage.style.marginInlineEnd = '10px';
    newImage.style.marginBlockEnd = '5px';
    newImage.style.marginBlockStart = '5px';
    newImage.style.maxHeight =  '125';
    newImage.setAttribute('data-path', image.path);
    newImage.innerHTML = `
        <img style="width: 10rem; height: 7.5rem" src="{{ url('/') }}${image.url}" alt="Image">
        <div class="loading-text" style="position:absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">Cargando...</div>
        <button type="button" class="delete-image" style="  position: absolute;top: 0;right: 0;width: 30px;height: 30px;background-color: #f3395b;border-radius: 50%;color: white;font-size: 18px;text-align: center;line-height: 27px;vertical-align: middle;cursor: pointer;border: none;" data-path="${image.path}">&#x2715;</button>
    `;
    container.appendChild(newImage);
    imagesArrayGen.push(image);
    updateImagesInputGen();
    let imageElement = newImage.querySelector('img');
    imageElement.onload = function() {
        newImage.querySelector('.loading-text').style.display = 'none';
    }
}

function deleteImageGen(imagePath) {
    let container = document.getElementById('image-container');
    let imageWrapper = container.querySelector(`.image-wrapper[data-path="${imagePath}"]`);
    console.log(imageWrapper);
    container.removeChild(imageWrapper);
    imagesArrayGen = imagesArrayGen.filter(image => image.path !== imagePath);
    updateImagesInputGen();
}
function updateImageOrderGen(){
  let container = document.getElementById('image-container');
  let imageWrapper = container.querySelectorAll('.image-wrapper');
  imagesArrayGen = [];
  for (let i = 0; i < imagesWrappers.length; i++){
    let imageId = parseInt(imageWrappers[i].getAttribute('data-id'));
    let image = {
      id: imageId,
      order: i
    };
    imagesArrayGen.push(image);
  }
  updateImagesInputGen();
}
function handleAddImageGen(file) {
    let loadingIcon = document.getElementById('loading-icon');
    loadingIcon.style.display = 'block';
    document.getElementById('enviarBtn').disabled = true;
    let formData = new FormData();
    formData.append('uploaded_image', file);
    formData.append('action', 'add');
    formData.append('_token', '{{ csrf_token() }}');

    fetch('{{ route('product.image_action') }}', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            let image = {
                path: data.image.path,
                url: '/uploads/' + data.image.path
            };
            addImageGen(image);
            loadingIcon.style.display = 'none';
            document.getElementById('enviarBtn').disabled = false;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('loading-icon').style.display = 'none';
            loadingIcon.classList.remove('rotate');
            document.getElementById('add-imagesGen').disabled = false;
        });
}

function handleDeleteImageGen(imagePath) {
    console.log("Image path:", imagePath);
    let formData = new FormData();
    formData.append('image_path', imagePath);
    formData.append('action', 'delete');
    formData.append('_token', '{{ csrf_token() }}');

    fetch('{{ route('product.image_action') }}', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                deleteImageGen(imagePath);
            } else {
                alert('Error al eliminar la imagen');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
function handleUpdateImageOrderGen(newOrder){
  fetch('{{route('product.image_action')}}', {
    method: 'POST',
    headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({
      action: 'update', 
      new_oder: newOrder
    })
  }).then(response => response.json()).then(data =>{
    if(data.error){
      alert('Error al cambiar la posición la imagen');
    }else{
      updateImageOrderGen();
    }
  }).catch(error => {
    console.error('Error:', error);
  });
}
/*nuevas funciones (listeners) */
document.getElementById('add-imagesGen').addEventListener('click', () => {
  let fileInput = document.getElementById('file-inputGen');
  fileInput.click();
});
document.getElementById('file-inputGen').addEventListener('change', (event) => {
    let files = event.target.files;
    if (imagesArrayGen.length + files.length <= maxFilesGen) {
        for (let i = 0; i < files.length; i++) {
            handleAddImageGen(files[i]);
        }
    } else {
        alert('Has alcanzado el límite máximo de imágenes permitidas.');
    }
});
document.addEventListener('click', function (event) {
    if (event.target.matches('.delete-image')) {
        let imagePath = event.target.getAttribute('data-path');
        handleDeleteImageGen(imagePath);
    }
});
document.addEventListener('DOMContentLoaded', function () {
    let sortable = Sortable.create(document.getElementById('image-container'), {
        animation: 150,
        onEnd: function (evt) {
            let oldIndex = evt.oldIndex;
            let newIndex = evt.newIndex;
            let movedItem = imagesArrayGen.splice(oldIndex, 1)[0];
            imagesArrayGen.splice(newIndex, 0, movedItem);
            let imageWrappers = document.querySelectorAll('#image-container > div');
            for (let i = 0; i < imageWrappers.length; i++) {
                imageWrappers[i].setAttribute('data-index', i);
            }

            updateImagesInputGen();
        }
    });
});
  $(document).on('click', '.editProductBtn', function() {
      var productId = $(this).data('id');
      var url = 'getProductInfo/' + productId;
      $('#userEditInfoContainer').empty();
      $.ajax({
        type: 'GET',
        url: url,
        success: function(response){
          $('#userEditInfoContainer').html(response);
          loadExistingImagesGen(productId);
          $('#modalForGen').modal('show');
          
        },
        error: function(xhr, status, error){
          //recordar poner los errores
        }
     });
  });
  function loadExistingImagesGen(productId) {
      let container = document.getElementById('image-container');
      container.innerHTML = '';
      $.ajax({
          type: 'GET',
          url: 'getProductImages/' + productId,
          success: function(response) {
              response.forEach(function(imageData) {
                let image = {
                    path: imageData.imagePath,
                    url: '/uploads/' + imageData.imagePath
            
                  };
                let imageJson = JSON.stringify(image);
                let imageObj = JSON.parse(imageJson);
                addImageGen(imageObj);
              });
          },
          error: function(xhr, status, error) {
              //ERRORes aqui igual
          }
      });
  }
  function openProductInNewTabGen(id, ruta){
    const url = `/tienda/producto/${id}/${ruta}`;
    const newTab = window.open(url, '_blank');
    if(newTab){
      newTab.focus();
    }else{
      alert('El navegador bloqueó la apertura de una nueva pestaña');
    }
  }
  function confirmation(ev){
  ev.preventDefault();
  var url = ev.currentTarget.getAttribute('href');
  swal({
    title: "¿Desea eliminar este producto?",
    text: "Esta publicación se eliminará para siempre",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((confirmCancel)=>{
    if(confirmCancel){
      window.location.href = url;
    }
  });
}
//funciones comercial
let imagesArrayCom = [];
let deletedImagesCom = [];
let maxFilesCom = 30;

function updateImagesInputCom() {
    let imagesInput = document.getElementById('imagesCom');
    imagesInput.value = JSON.stringify(imagesArrayCom);
    let imageWrapper = document.querySelector('.image-wrapper[data-index="0"]');
    let firstImageWrapper = document.querySelector('.image-wrapper');
    let imageWrappers = document.querySelectorAll('.image-wrapper');
    imageWrappers.forEach((imageWrapper) => {
        if (imageWrapper.getAttribute('data-index') !== '0') {
            imageWrapper.style.border = '';
            imageWrapper.style.borderRadius = '';
            let label = imageWrapper.querySelector('.image-label');
            if (label) {
                label.remove();
            }
        } else {
            imageWrapper.style.border = '3px inset #a250ff';
            imageWrapper.style.borderRadius = '5px';
            let label = imageWrapper.querySelector('.image-label');
            if (label) {
                label.innerHTML = 'Imagen principal';
            } else {
                label = document.createElement('div');
                label.classList.add('image-label');
                label.innerHTML = 'Imagen principal';
                imageWrapper.appendChild(label);
            }
        }
    });
    if (!imageWrapper) {
        firstImageWrapper.style.border = '3px inset #a250ff';
        firstImageWrapper.style.borderRadius = '5px';
        label = document.createElement('div');
        label.classList.add('image-label');
        label.innerHTML = 'Imagen principal';
        firstImageWrapper.appendChild(label);
    }
}
function addImageCom(image) {
    let container = document.getElementById('image-containerCom');
    let newImage = document.createElement('div');
    newImage.setAttribute('class', 'image-wrapper');
    newImage.style.position = 'relative';
    newImage.style.marginInlineEnd = '10px';
    newImage.style.marginBlockEnd = '5px';
    newImage.style.marginBlockStart = '5px';
    newImage.style.maxHeight =  '125';
    newImage.setAttribute('data-path', image.path);
    newImage.innerHTML = `
        <img style="width: 10rem; height: 7.5rem" src="{{ url('/') }}${image.url}" alt="Image">
        <div class="loading-text" style="position:absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">Cargando...</div>
        <button type="button" class="delete-image" style="  position: absolute;top: 0;right: 0;width: 30px;height: 30px;background-color: #f3395b;border-radius: 50%;color: white;font-size: 18px;text-align: center;line-height: 27px;vertical-align: middle;cursor: pointer;border: none;" data-path="${image.path}">&#x2715;</button>
    `;
    container.appendChild(newImage);
    imagesArrayCom.push(image);
    updateImagesInputCom();
    let imageElement = newImage.querySelector('img');
    imageElement.onload = function() {
        newImage.querySelector('.loading-text').style.display = 'none';
    }
}

function deleteImageCom(imagePath) {
    console.log("Image path:", imagePath);
    let container = document.getElementById('image-containerCom');
    let imageWrapper = container.querySelector(`.image-wrapper[data-path="${imagePath}"]`);
    console.log(imageWrapper);
    container.removeChild(imageWrapper);
    imagesArrayCom = imagesArrayCom.filter(image => image.path !== imagePath);
    updateImagesInputCom();
}
function updateImageOrderCom(){
  let container = document.getElementById('image-containerCom');
  let imageWrapper = container.querySelectorAll('.image-wrapper');
  imagesArrayCom = [];
  for (let i = 0; i < imagesWrappers.length; i++){
    let imageId = parseInt(imageWrappers[i].getAttribute('data-id'));
    let image = {
      id: imageId,
      order: i
    };
    imagesArrayCom.push(image);
  }
  updateImagesInputCom();
}
function handleAddImageCom(file) {
    let loadingIcon = document.getElementById('loading-icon');
    loadingIcon.style.display = 'block';
    document.getElementById('enviarBtn').disabled = true;
    let formData = new FormData();
    formData.append('uploaded_image', file);
    formData.append('action', 'add');
    formData.append('_token', '{{ csrf_token() }}');

    fetch('{{ route('product.image_actionC') }}', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            let image = {
                path: data.image.path,
                url: '/uploads/tianguis' + data.image.path
            };
            addImageCom(image);
            loadingIcon.style.display = 'none';
            document.getElementById('enviarBtn').disabled = false;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('loading-icon').style.display = 'none';
            loadingIcon.classList.remove('rotate');
            document.getElementById('add-imagesCom').disabled = false;
        });
}

function handleDeleteImageCom(imagePath) {
    let formData = new FormData();
    formData.append('image_path', imagePath);
    formData.append('action', 'delete');
    formData.append('_token', '{{ csrf_token() }}');

    fetch('{{ route('product.image_actionC') }}', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                deleteImageCom(imagePath);
            } else {
                alert('Error al eliminar la imagen');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
function handleUpdateImageOrderCom(newOrder){
  fetch('{{route('product.image_actionC')}}', {
    method: 'POST',
    headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({
      action: 'update', 
      new_oder: newOrder
    })
  }).then(response => response.json()).then(data =>{
    if(data.error){
      alert('Error al cambiar la posición la imagen');
    }else{
      updateImageOrderCom();
    }
  }).catch(error => {
    console.error('Error:', error);
  });
}
/*nuevas funciones (listeners) */
document.getElementById('add-imagesCom').addEventListener('click', () => {
  let fileInput = document.getElementById('file-inputCom');
  fileInput.click();
});
document.getElementById('file-inputCom').addEventListener('change', (event) => {
    let files = event.target.files;
    if (imagesArrayCom.length + files.length <= maxFilesCom) {
        for (let i = 0; i < files.length; i++) {
            handleAddImageCom(files[i]);
        }
    } else {
        alert('Has alcanzado el límite máximo de imágenes permitidas.');
    }
});
document.addEventListener('click', function (event) {
    if (event.target.matches('.delete-image')) {
        let imagePath = event.target.getAttribute('data-path');
        handleDeleteImageCom(imagePath);
    }
});
document.addEventListener('DOMContentLoaded', function () {
    let sortable = Sortable.create(document.getElementById('image-containerCom'), {
        animation: 150,
        onEnd: function (evt) {
            let oldIndex = evt.oldIndex;
            let newIndex = evt.newIndex;
            let movedItem = imagesArrayCom.splice(oldIndex, 1)[0];
            imagesArrayCom.splice(newIndex, 0, movedItem);
            let imageWrappers = document.querySelectorAll('#image-containerCom > div');
            for (let i = 0; i < imageWrappers.length; i++) {
                imageWrappers[i].setAttribute('data-index', i);
            }

            updateImagesInputCom();
        }
    });
});

$(document).ready(function(){
    $('.editProductBtn').on('click', function(){
    var productId = $(this).data('id');
    var url = 'getComInfo/' + productId;
    $('#comEditInfoContainer').empty();
    $.ajax({
      type: 'GET',
      url: url,
      success: function(response){
        $('#comEditInfoContainer').html(response);
        $('#modalForCom').modal('show');
      },
      error: function(xhr, status, error){
        //
      }
    });
  }); 
});
//subasta ganaera
let imagesArraySub= [];
let deletedImagesSub = [];
let maxFilesSub = 30;

function updateImagesInputSub() {
    let imagesInput = document.getElementById('imagesSub');
    imagesInput.value = JSON.stringify(imagesArraySub);
    let imageWrapper = document.querySelector('.image-wrapper[data-index="0"]');
    let firstImageWrapper = document.querySelector('.image-wrapper');
    let imageWrappers = document.querySelectorAll('.image-wrapper');
    imageWrappers.forEach((imageWrapper) => {
        if (imageWrapper.getAttribute('data-index') !== '0') {
            imageWrapper.style.border = '';
            imageWrapper.style.borderRadius = '';
            let label = imageWrapper.querySelector('.image-label');
            if (label) {
                label.remove();
            }
        } else {
            imageWrapper.style.border = '3px inset #a250ff';
            imageWrapper.style.borderRadius = '5px';
            let label = imageWrapper.querySelector('.image-label');
            if (label) {
                label.innerHTML = 'Imagen principal';
            } else {
                label = document.createElement('div');
                label.classList.add('image-label');
                label.innerHTML = 'Imagen principal';
                imageWrapper.appendChild(label);
            }
        }
    });
    if (!imageWrapper) {
        firstImageWrapper.style.border = '3px inset #a250ff';
        firstImageWrapper.style.borderRadius = '5px';
        label = document.createElement('div');
        label.classList.add('image-label');
        label.innerHTML = 'Imagen principal';
        firstImageWrapper.appendChild(label);
    }
}
function addImageSub(image) {
    let container = document.getElementById('image-containerSub');
    let newImage = document.createElement('div');
    newImage.setAttribute('class', 'image-wrapper');
    newImage.style.position = 'relative';
    newImage.style.marginInlineEnd = '10px';
    newImage.style.marginBlockEnd = '5px';
    newImage.style.marginBlockStart = '5px';
    newImage.style.maxHeight =  '125';
    newImage.setAttribute('data-path', image.path);
    newImage.innerHTML = `
        <img style="width: 10rem; height: 7.5rem" src="{{ url('/') }}${image.url}" alt="Image">
        <div class="loading-text" style="position:absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">Cargando...</div>
        <button type="button" class="delete-image" style="  position: absolute;top: 0;right: 0;width: 30px;height: 30px;background-color: #f3395b;border-radius: 50%;color: white;font-size: 18px;text-align: center;line-height: 27px;vertical-align: middle;cursor: pointer;border: none;" data-path="${image.path}">&#x2715;</button>
    `;
    container.appendChild(newImage);
    imagesArraySub.push(image);
    updateImagesInputSub();
    let imageElement = newImage.querySelector('img');
    imageElement.onload = function() {
        newImage.querySelector('.loading-text').style.display = 'none';
    }
}

function deleteImageSub(imagePath) {
    console.log("Image path:", imagePath);
    let container = document.getElementById('image-containerSub');
    let imageWrapper = container.querySelector(`.image-wrapper[data-path="${imagePath}"]`);
    console.log(imageWrapper);
    container.removeChild(imageWrapper);
    imagesArraySub = imagesArraySub.filter(image => image.path !== imagePath);
    updateImagesInputSub();
}
function updateImageOrderSub(){
  let container = document.getElementById('image-containerSub');
  let imageWrapper = container.querySelectorAll('.image-wrapper');
  imagesArraySub = [];
  for (let i = 0; i < imagesWrappers.length; i++){
    let imageId = parseInt(imageWrappers[i].getAttribute('data-id'));
    let image = {
      id: imageId,
      order: i
    };
    imagesArraySub.push(image);
  }
  updateImagesInputSub();
}
function handleAddImageSub(file) {
    let loadingIcon = document.getElementById('loading-icon');
    loadingIcon.style.display = 'block';
    document.getElementById('enviarBtn').disabled = true;
    let formData = new FormData();
    formData.append('uploaded_image', file);
    formData.append('action', 'add');
    formData.append('_token', '{{ csrf_token() }}');

    fetch('{{ route('product.image_actionS') }}', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            let image = {
                path: data.image.path,
                url: '/uploads/subasta' + data.image.path
            };
            addImageSub(image);
            loadingIcon.style.display = 'none';
            document.getElementById('enviarBtn').disabled = false;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('loading-icon').style.display = 'none';
            loadingIcon.classList.remove('rotate');
            document.getElementById('add-imagesSub').disabled = false;
        });
}

function handleDeleteImageSub(imagePath) {
    let formData = new FormData();
    formData.append('image_path', imagePath);
    formData.append('action', 'delete');
    formData.append('_token', '{{ csrf_token() }}');

    fetch('{{ route('product.image_actionS') }}', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                deleteImageSub(imagePath);
            } else {
                alert('Error al eliminar la imagen');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
function handleUpdateImageOrderSub(newOrder){
  fetch('{{route('product.image_actionS')}}', {
    method: 'POST',
    headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({
      action: 'update', 
      new_oder: newOrder
    })
  }).then(response => response.json()).then(data =>{
    if(data.error){
      alert('Error al cambiar la posición la imagen');
    }else{
      updateImageOrderSub();
    }
  }).catch(error => {
    console.error('Error:', error);
  });
}
/*nuevas funciones (listeners) */
document.getElementById('add-imagesSub').addEventListener('click', () => {
  let fileInput = document.getElementById('file-inputSub');
  fileInput.click();
});
document.getElementById('file-inputSub').addEventListener('change', (event) => {
    let files = event.target.files;
    if (imagesArraySub.length + files.length <= maxFilesSub) {
        for (let i = 0; i < files.length; i++) {
            handleAddImageSub(files[i]);
        }
    } else {
        alert('Has alcanzado el límite máximo de imágenes permitidas.');
    }
});
document.addEventListener('click', function (event) {
    if (event.target.matches('.delete-image')) {
        let imagePath = event.target.getAttribute('data-path');
        handleDeleteImageSub(imagePath);
    }
});
document.addEventListener('DOMContentLoaded', function () {
    let sortable = Sortable.create(document.getElementById('image-containerSub'), {
        animation: 150,
        onEnd: function (evt) {
            let oldIndex = evt.oldIndex;
            let newIndex = evt.newIndex;
            let movedItem = imagesArraySub.splice(oldIndex, 1)[0];
            imagesArraySub.splice(newIndex, 0, movedItem);
            let imageWrappers = document.querySelectorAll('#image-containerSub > div');
            for (let i = 0; i < imageWrappers.length; i++) {
                imageWrappers[i].setAttribute('data-index', i);
            }

            updateImagesInputSub();
        }
    });
});
function openProductInNewTab(id){
  const url = `/subastas/${id}`;
  const newTab = window.open(url, '_blank');
  if(newTab){
    newTab.focus();
  }else{
    alert('Se ha bloqueado la apertura de una nueva ventana');
  }
}
function confirmation(ev){
  ev.preventDefault();
  var url = ev.currentTarget.getAttribute('href');
  swal({
    title: "¿Desea eliminar esta subasta?",
    text: "Esta subasta se eliminará para siempre",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((confirmCancel)=>{
    if(confirmCancel){
      window.location.href= url;
    }
  });
}
$(document).ready(function(){
    $('.editProductBtn').on('click', function(){
    var productId = $(this).data('id');
    var url = 'getSubInfo/' + productId;
    $('#subEditInfoContianer').empty();
    $.ajax({
      type: 'GET',
      url: url,
      success: function(response){
        $('#subEditInfoContianer').html(response);
        $('#modalForSub').modal('show');
      },
      error: function (xhr, status, error){
        //error aun no implementando, recordar
      }
    });
  });
});
</script>
@endsection