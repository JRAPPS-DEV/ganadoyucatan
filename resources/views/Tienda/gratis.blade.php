<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Publicar Ganado - Tianguis Ganadero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
        }
        .container {
            margin-top: 40px;
            max-width: 900px;
        }
        .control-label {
            color: #425b28;
            font-weight: bold;
        }
        .required {
            color: red;
        }
        .btn-primary {
            background-color: #425b28;
            border-color: #425b28;
        }
        .btn-primary:hover {
            background-color: #557e37;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Publicar Ganado en el Tianguis</h2>
        <p class="text-muted">Publica tu ganado sin necesidad de registrarte</p>
    </div>

    {{-- Mensajes --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Formulario --}}
    <form action="{{ url('/tianguis/publicar') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <label class="control-label">Nombre del Producto <span class="required">*</span></label>
                <input type="text" name="nombre" class="form-control" maxlength="50" required>

                <label class="control-label mt-3">Descripción</label>
                <textarea name="descripcion" class="form-control" maxlength="250"></textarea>

                <label class="control-label mt-3">Precio <span class="required">*</span></label>
                <input type="text" name="precio" class="form-control" required>

                <label class="control-label mt-3">Número de contacto <span class="required">*</span></label>
                <input type="text" name="numero" class="form-control" required>

                <label class="control-label mt-3">Peso (kg)</label>
                <input type="text" name="pesoG" class="form-control">

                <label class="control-label mt-3">Cantidad Disponible</label>
                <input type="number" name="txtStock" class="form-control">

                <label class="control-label mt-3">Raza</label>
                <select name="txtRaza" class="form-control">
                    <option value="Brahman rojo">Brahman rojo</option>
                    <option value="Brahman gris">Brahman gris</option>
                    <option value="Angus">Angus</option>
                    <option value="Simmental">Simmental</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="control-label">Vacunado</label>
                <select name="listVacu" class="form-control">
                    <option value="Vacunado">Vacunado</option>
                    <option value="NO Vacunado">No Vacunado</option>
                </select>

                <label class="control-label mt-3">Arete</label>
                <select name="listArete" class="form-control">
                    <option value="Con Arete">Con Arete</option>
                    <option value="Sin Arete">Sin Arete</option>
                </select>

                <label class="control-label mt-3">Certificado</label>
                <select name="listCert" class="form-control">
                    <option value="Certificado">Cuenta con certificado</option>
                    <option value="NO certificado">No cuenta con certificado</option>
                </select>

                <label class="control-label mt-3">Tipo de Ganado</label>
                <select name="lisTipo" class="form-control">
                    <option value="Toro">Toro</option>
                    <option value="Vaca">Vaca</option>
                    <option value="Ternero">Ternero</option>
                    <option value="Novilla">Novilla</option>
                    <option value="Otro">Otro</option>
                </select>

                <label class="control-label mt-3">Propietario</label>
                <input type="text" name="propietario" class="form-control">

                <label class="control-label mt-3">Enlace de YouTube</label>
                <input type="text" name="txtLink" class="form-control">

                <label class="control-label mt-3">Estado</label>
                <select name="estados" class="form-control">
                    <option value="1">Yucatán</option>
                    <option value="2">Campeche</option>
                    <option value="3">Quintana Roo</option>
                </select>

                <label class="control-label mt-3">Ciudad</label>
                <select name="ciudades" class="form-control">
                    <option value="1">Mérida</option>
                    <option value="2">Valladolid</option>
                    <option value="3">Tizimín</option>
                </select>
            </div>
        </div>

        <hr>
        <h5 class="mt-4">Imágenes del Ganado (máx. 9)</h5>
        <div class="row">
            @for($i = 1; $i <= 9; $i++)
                <div class="col-md-4 mb-3">
                    <label class="form-label">Imagen {{ $i }}</label>
                    <input type="file" name="imagen{{ $i }}" class="form-control" accept="image/*">
                </div>
            @endfor
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Publicar</button>
        </div>
    </form>
</div>
</body>
</html>
