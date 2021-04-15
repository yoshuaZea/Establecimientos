@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>

    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css"
    integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
    crossorigin="">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.6/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" />
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Editar estbalecimiento</h1>

        <div class="row justify-content-center">
            <form
                action="{{ route('establecimiento.update', [ 'establecimiento' => $establecimiento->id ]) }}"
                method="post"
                class="col-md-9 col-xs-12 card card-body"
                enctype="multipart/form-data"
                id="form-establecimiento"
            >
                @csrf
                @method('put')
                <fieldset class="border p-4">
                    <legend class="text-primary">Nombre y categoría</legend>

                    <div class="form-group">
                        <label for="nombre" class="font-weight-bold">¿Cuál es el nombre de tu establecimiento?</label>
                        <input
                            type="text"
                            class="form-control required rsc @error('nombre') is-invalid @enderror"
                            id="nombre"
                            name="nombre"
                            placeholder="Ej. Restaurant la chingada"
                            value="{{ $establecimiento->nombre }}"
                        />
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="categoria" class="font-weight-bold">¿Qué categoría es?</label>
                        <select
                            type="text"
                            class="form-control required ond @error('categoria') is-invalid @enderror"
                            id="categoria"
                            name="categoria"
                        >
                            <option value="" selected disabled>- Selecciona -</option>
                            @foreach($categorias as $categoria)
                                <option
                                    value="{{ $categoria->id }}"
                                    {{ $establecimiento->categoria_id == $categoria->id ? 'selected' : null }}
                                >{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        @error('categoria')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="imagen_principal" class="font-weight-bold">Imagen principal</label>
                        <input
                            type="file"
                            class="form-control @error('imagen_principal') is-invalid @enderror"
                            id="imagen_principal"
                            name="imagen_principal"
                            value="{{ $establecimiento->imagen_principal }}"
                        />
                        @error('imagen_principal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <img class="w-25 mt-3 rounded" src="/storage/{{ $establecimiento->imagen_principal }}" alt="Imagen principal">
                    </div>

                </fieldset>

                <fieldset class="border p-4 mt-3">
                    <legend class="text-primary">Ubicación del establecimiento</legend>

                    <div class="form-group">
                        <label for="formbuscador" class="font-weight-bold">¿Cuál es la dirección?</label>
                        <input
                            type="text"
                            class="form-control @error('direccion') is-invalid @enderror"
                            id="formbuscador"
                            placeholder="Ej. Allende Cuernavaca 62410"
                        >
                        <p class="text-secondary mt-2 mb-3 text-center">
                            El asistente colocará una dirección estimada o mueve el pin hacia el lugar correcto.
                        </p>
                    </div>

                    <div class="form-group">
                        <div class="" id="mapa" style="height: 400px"></div>
                    </div>

                    <p class="informacion">
                        Confirma que los siguientes datos sean correctos
                    </p>

                    <div class="form-group">
                        <label for="direccion" class="font-weight-bold">Dirección</label>
                        <input
                            type="text"
                            class="form-control required rsc @error('direccion') is-invalid @enderror"
                            id="direccion"
                            name="direccion"
                            placeholder="Ej. Dirección"
                            value="{{ $establecimiento->direccion }}"
                        />
                        @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="colonia" class="font-weight-bold">Colonia</label>
                        <input
                            type="text"
                            class="form-control required rsc @error('colonia') is-invalid @enderror"
                            id="colonia"
                            name="colonia"
                            placeholder="Ej. Colonia"
                            value="{{ $establecimiento->colonia }}"
                        />
                        @error('colonia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lat" class="font-weight-bold">Latitud</label>
                        <input
                            type="text"
                            class="form-control required rsc @error('lat') is-invalid @enderror"
                            id="lat"
                            name="lat"
                            placeholder="1.121212"
                            value="{{ $establecimiento->lat }}"
                            readonly
                        />
                        @error('lat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lng" class="font-weight-bold">Latitud</label>
                        <input
                            type="text"
                            class="form-control required rsc @error('lng') is-invalid @enderror"
                            id="lng"
                            name="lng"
                            placeholder="1.121212"
                            value="{{ $establecimiento->lng }}"
                            readonly
                        />
                        @error('lng')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </fieldset>

                <fieldset class="border p-4 mt-3">
                    <legend  class="text-primary">Información Establecimiento: </legend>
                    <div class="form-group">
                        <label for="nombre" class="font-weight-bold">Teléfono</label>
                        <input 
                            type="tel" 
                            class="form-control required ond @error('telefono')  is-invalid  @enderror" 
                            id="telefono" 
                            placeholder="Teléfono Establecimiento"
                            name="telefono"
                            value="{{ $establecimiento->telefono }}"
                        >

                            @error('telefono')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="font-weight-bold">Descripción</label>
                        <textarea
                            class="form-control required rsc @error('descripcion')  is-invalid  @enderror" 
                            name="descripcion"
                        >{{ $establecimiento->descripcion }}</textarea>

                            @error('descripcion')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="font-weight-bold">Hora Apertura:</label>
                        <input 
                            type="time" 
                            class="form-control required @error('apertura')  is-invalid  @enderror" 
                            id="apertura" 
                            name="apertura"
                            value="{{ $establecimiento->apertura }}"
                        >
                        @error('apertura')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="font-weight-bold">Hora Cierre:</label>
                        <input 
                            type="time" 
                            class="form-control required @error('cierre')  is-invalid  @enderror" 
                            id="cierre" 
                            name="cierre"
                            value="{{ $establecimiento->cierre }}"
                        >
                        @error('cierre')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </fieldset>

                <fieldset class="border p-4 mt-3">
                    <legend  class="text-primary">Imagenes del Establecimiento: </legend>
                    <div class="form-group">
                        <div id="dropzone" class="dropzone form-control"></div>
                        <p id="error"></p>
                    </div>

                    @if(count($imagenes) > 0)
                        @foreach($imagenes as $imagen)
                            <input type="hidden" class="galeria" value="{{ $imagen->ruta_img }}"/>
                        @endforeach
                    @endif
                </fieldset>

                <input type="hidden" id="uuid" name="uuid" value="{{ $establecimiento->uuid }}" />

                <input type="submit" class="btn btn-block btn-primary mt-3" value="Guarcar cambios" />
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin="" defer></script>
    
    <script src="https://unpkg.com/esri-leaflet@2.5.3/dist/esri-leaflet.js"
        integrity="sha512-K0Vddb4QdnVOAuPJBHkgrua+/A9Moyv8AQEWi0xndQ+fqbRfAFd47z4A9u1AW/spLO0gEaiE1z98PK1gl5mC5Q=="
        crossorigin="" defer></script>

    <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js"
        integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA=="
        crossorigin="" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.6/dropzone-amd-module.js" integrity="sha512-/diY7kiMCU8WBbgrhBMJjMDtrsJGPP2LQG4gaw9tHRYlQ50sJLhAQZH/MSpEPdQHcY0YXYfsosyjMArCDTa3SA==" crossorigin="anonymous" defer></script>

@endsection
