@extends('adminlte::page')

<?php
    use App\Models\AssetLocation;
    $assets = AssetLocation::all();
?>
@section('title', 'Dashboard')
@section('content_header')

    <h6>Estaciones- Equipos</h6>
@stop
@section('content')

@if(session()->has('estacion'))
    <div id="add" value={{ session()->get('estacion')}}></div>
@endif

<div class="card" style="padding: 10px" >
            <div class="row" >
                <!-- top -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Estación:</label>
                        <select id="provincia_id" class="form-control"  onchange="seleccion()">
                            <option>&nbsp;</option>
                            @foreach($assets as $key => $asset)
                            <option   value="{{$asset->id}}" name="{{$asset->name}}">
                                {{$asset->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-8"></div>
                 <!-- lado 1 -->
                <div class="col-md-4">
                    <div id="mapid"></div>
                </div>
                <!-- lado 2 -->
                <div class="col-md-4">
                    <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">Provincia</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="provincia" disabled="disabled">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Municipio</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="municipio" disabled="disabled">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Zona</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="zona" disabled="disabled">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Red</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="cred" disabled="disabled">
                        </div>
                    </div>
                </div>
                <!-- lado 3 -->
                <div class="col-md-4">
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Código EOI</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="ceuropeo" disabled="disabled">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Dirección</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="direccion" disabled="disabled">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Coordenadas</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="coordenadas" disabled="disabled">
                        </div>
                    </div>

                 </div>
                 <h3 id="titulo" style="display:none">Equipos</h3>
                 <div class="table-responsive">
                    <table class="table table-bordered" id="tablaEquipos">

                    </table>
                 </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@stop


@section('js')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>

var map = new L.Map('mapid');

var value = $("#add").attr('value');

  if (value != undefined){

      $('#provincia_id').val(value);

       var id=$("#provincia_id option:selected").val();
       var name=$("#provincia_id option:selected").text();
      $.ajaxSetup({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
     });
     $.ajax({
            type:'post',
            url:'home',
            data:{id:id,name:name},
            success: function(data) {
                $('#provincia').val(data.provincia);
                $('#municipio').val(data.municipio);
                $('#estacion').val(data.estacion);
                $('#zona').val(data.zona);
                $('#cred').val(data.cred);
                $('#ceuropeo').val(data.ceuropeo);
                $('#direccion').val(data.direccion);
                $('#coordenadas').val(data.longitud+"   "+data.latitud);
                //MAPAS
                $('#mapid').html("<div id='map' style='width: 100%; height: 100%;'></div>");
                    var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                    osmAttribution = 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,'
                        ' <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
                            osmLayer = new L.TileLayer(osmUrl, {maxZoom: 18, attribution: osmAttribution});git
                            var map = new L.Map('map');
                            map.setView(new L.LatLng(data.latitud,data.longitud), 20 );
                            map.addLayer(osmLayer);
                            var marker = L.marker([data.latitud,data.longitud]).addTo(map);
                            marker.bindPopup("estacion").openPopup();
               },
                error:function() {
                    alert("error");
                }

        });

    $('#tablaEquipos').DataTable({
        destroy: true,
        searching: true,
        ajax: {
            url: "{{ route('dnota.listado_equipos') }}",
            data: function (d) {
                d.id=value;
            }
        },


        language: {
            sProcessing:    "Procesando...",
            sLengthMenu:    "Mostrar _MENU_ registros",
            sZeroRecords:   "No se encontraron resultados",
            sEmptyTable:    "Ningún dato disponible en esta tabla",
            sInfo:          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            sInfoEmpty:     "Mostrando registros del 0 al 0 de un total de 0 registros",
            sInfoFiltered:  "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix:   "",
            sSearch:        "Buscar:",
            sUrl:           "",
            sInfoThousands:  ",",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                "sFirst":    "Primero",
                "sLast":    "Último",
                "sNext":    "Siguiente",
                "sPrevious": "Anterior"
            },
            oAria: {
                sSortAscending:  ": Activar para ordenar la columna de manera ascendente",
                sSortDescending: ": Activar para ordenar la columna de manera descendente"
            }
        },

        columns: [
            { data: 'id', name: 'id',title:'Id' },
            { data: 'asset', name: 'asset',title:'Código Equipo' },
            { data: 'serial_number', name: 'serial_number' ,title:'Número de serie'},
            { data: 'type', name: 'type' ,title:'Tipo de Activo'},
            { data: 'subtype', name: 'subtype' ,title:'Subtipo de Activo'},
            { data: 'status', name: 'status',title:'Estado' },
            { data: 'location', name: 'location' ,title:'Ubicación'},
            { data: 'mark', name: 'mark' ,title:'Marca'},
            { data: 'sample', name: 'sample' ,title:'Modelo'},
            { data: 'start_date', name: 'start_date' ,title:'Fecha de alta'},
            { data: 'end_date', name: 'end_date' ,title:'Fecha retirada'},
            { data: 'notes', name: 'notes' ,title:'Observaciones'},
            { data: 'regulations', name: 'regulations' ,title:'Normativas'},
            { data: 'zona', name: 'zona' ,title:'Zona'},
            { data: 'network', name: 'network' ,title:'Red'}
        ],


        columnDefs: [{
                data: 'id',
                render : function(data){
                var zona =$("#provincia_id option:selected").text();
                return '<form action="{{route('dnota.EstacionDetalle')}}" method="GET"> <input type="hidden" name="id" value="'+data+'" /><input type="hidden" name="zona" value="'+zona+'" /><input type="submit"  style="margin-bottom: 10px;" class="btn btn-success pull-right"  value="Detalle"/></form>'
                },
          targets : 15
        },
        {
                data: 'id',
                render : function(data){
                var zona =$("#provincia_id option:selected").text();
                return '@can('asset_delete')<form action="{{ route('dnota.eliminarEquipo') }}" method="GET"><input type="hidden" name="id_asset" value="'+data+'" /><input type="hidden" name="id_provincia" value="'+$("#provincia_id option:selected").val()+'" /><input type="submit" class="btn btn-xs btn-danger" value="{{ trans("global.delete") }}"></form>@endcan @can('asset_edit')<form action="{{ route('dnota.editarEquipo') }}"  method="GET"><input type="hidden" name="id" value="'+data+'" /><input type="submit" class="btn btn-xs btn-info"" value="{{ trans('global.edit') }}"></form>@endcan'
                },
            targets : 16
        }]
    });

  }




function seleccion(){
 // var map = new L.Map('mapid');
       var id=$("#provincia_id option:selected").val();
       var name=$("#provincia_id option:selected").text();

        $('#titulo').css({"display":"block"});
    $.ajaxSetup({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
     });
      $.ajax({
            type:'post',
            url:'home',
            data:{id:id,name:name},
            success: function(data) {
                $('#provincia').val(data.provincia);
                $('#municipio').val(data.municipio);
                $('#zona').val(data.zona);
                $('#cred').val(data.cred);
                $('#ceuropeo').val(data.ceuropeo);
                $('#nred').val(data.nred);
                $('#direccion').val(data.direccion);
                $('#coordenadas').val(data.longitud+"   "+data.latitud);
                //MAPAS

                $('#mapid').html("<div id='map' style='width: 100%; height: 100%;'></div>");
                    var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                    osmAttribution = 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,'
                        ' <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
                            osmLayer = new L.TileLayer(osmUrl, {maxZoom: 18, attribution: osmAttribution});
                            var map = new L.Map('map');
                            map.setView(new L.LatLng(data.latitud,data.longitud), 20 );
                            map.addLayer(osmLayer);
                            var marker = L.marker([data.latitud,data.longitud]).addTo(map);
                            marker.bindPopup("estacion").openPopup();
               },
                error:function() {
                    alert("error");
                }

        });

    $('#tablaEquipos').DataTable({
        destroy: true,
        searching: true,
        ajax: {
            url: "{{ route('dnota.listado_equipos') }}",
            data: function (d) {
                d.id =$("#provincia_id option:selected" ).val();
            }
        },

        language: {
            sProcessing:    "Procesando...",
            sLengthMenu:    "Mostrar _MENU_ registros",
            sZeroRecords:   "No se encontraron resultados",
            sEmptyTable:    "Ningún dato disponible en esta tabla",
            sInfo:          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            sInfoEmpty:     "Mostrando registros del 0 al 0 de un total de 0 registros",
            sInfoFiltered:  "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix:   "",
            sSearch:        "Buscar:",
            sUrl:           "",
            sInfoThousands:  ",",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                "sFirst":    "Primero",
                "sLast":    "Último",
                "sNext":    "Siguiente",
                "sPrevious": "Anterior"
            },
            oAria: {
                sSortAscending:  ": Activar para ordenar la columna de manera ascendente",
                sSortDescending: ": Activar para ordenar la columna de manera descendente"
            }
        },


        columns: [
            { data: 'id', name: 'id',title:'Id' },
            { data: 'asset', name: 'asset',title:'Código Equipo' },
            { data: 'serial_number', name: 'serial_number' ,title:'Número de serie'},
            { data: 'type', name: 'type' ,title:'Tipo de Activo'},
            { data: 'subtype', name: 'subtype' ,title:'Subtipo de Activo'},
            { data: 'status', name: 'status',title:'Estado' },
            { data: 'location', name: 'location' ,title:'Ubicación'},
            { data: 'mark', name: 'mark' ,title:'Marca'},
            { data: 'sample', name: 'sample' ,title:'Modelo'},
            { data: 'start_date', name: 'start_date' ,title:'Fecha de alta'},
            { data: 'end_date', name: 'end_date' ,title:'Fecha retirada'},
            { data: 'notes', name: 'notes' ,title:'Observaciones'},
            { data: 'regulations', name: 'regulations' ,title:'Normativas'},
            { data: 'zona', name: 'zona' ,title:'Zona'},
            { data: 'network', name: 'network' ,title:'Red'}
        ],

        columnDefs: [{
            data: 'id',
                render : function(data){
                var zona =$("#provincia_id option:selected").text();
                return '<form action="{{route('dnota.EstacionDetalle')}}" method="GET"> <input type="hidden" name="id" value="'+data+'" /><input type="hidden" name="zona" value="'+zona+'" /><input type="submit"  style="margin-bottom: 10px;" class="btn btn-success pull-right"  value="Detalle"/></form>'
                },
                targets : 15
        },
        {
                data: 'id',
                render : function(data){
                var zona =$("#provincia_id option:selected").text();
                return '@can('asset_delete')<form action="{{ route('dnota.eliminarEquipo') }}" method="GET"><input type="hidden" name="id_asset" value="'+data+'" /><input type="hidden" name="id_provincia" value="'+$("#provincia_id option:selected").val()+'" /><input type="submit" class="btn btn-xs btn-danger" value="{{ trans("global.delete") }}"></form>@endcan @can('asset_edit')<form action="{{ route('dnota.editarEquipo') }}" method="GET"><input type="hidden" name="id" value="'+data+'" /><input type="submit" class="btn btn-xs btn-info"" value="{{ trans('global.edit') }}"></form>@endcan'
                },
                    targets : 16
        }]
    });

}









    </script>
@stop
