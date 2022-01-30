@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h6>Estaciones- Equipos >> Actuaciones</h6>
@stop

@section('content')
<div class="card" style="padding: 10px" >
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h1>Estacion de {{$nombreZona}}</h1>
                        </div>
                        <div class="col-md-6">
                            <h1>Equipo {{$nombreEquipo}}</h1>
                        </div>

                        <div class="col-md-12"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Estado de la actividad</label>
                                <select id="estado" class="form-control"  onchange="seleccion()">
                                    @foreach($taskStatus as $key => $taskStatu)
                                    <option   value="{{$taskStatu->id}}" name="{{$taskStatu->name}}">
                                        {{$taskStatu->name}}
                                    </option>
                                    @endforeach
                                    <option selected   value="4"  name="todas">todas</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tarea</label>
                                <select id="tarea" class="form-control"  onchange="seleccion()">
                                    @foreach($tasktag as $key => $task_tag)
                                    <option   value="{{$task_tag->id}}" name="{{$task_tag->name}}">
                                        {{$task_tag->name}}
                                    </option>
                                    @endforeach
                                    <option selected  value="0"  name="todas">todas</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group ">
                                <label>Fecha Inicio</label>
                                <div class="col-10">
                                  <input class="form-control" type="date"  id="fechaInicio"  onchange="seleccion()">
                                </div>
                                <small>mayor o igual</small>
                              </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group ">
                                <label>Fecha Fin</label>
                                <div class="col-10">
                                  <input class="form-control" type="date"  id="fechaFin"  onchange="seleccion()">
                                </div>
                                <small>menor o igual</small>
                              </div>
                        </div>
                        <div class="col-md-12"></div>
                        <div class="col-md-12">
                            <h3 id="titulo" style="display:none">Tareas</h3>
                            <div class="table-responsive">
                            <table class="table table-bordered" id="listado_tareas_locales">
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop




@section('js')
    <script>
     //carga de todos los elementos

     var id={{$id}};
     var estado =$("#estado option:selected").val();
     var tarea =$("#tarea option:selected").val();
     var fechaInicio=$("#fechaInicio").val();
     var fechaFin=$("#fechaFin").val();

        $('#listado_tareas_locales').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        searching: false,
        ajax: {
            url: "{{ route('dnota.listado_tareas_locales') }}",
            data: function (d) {
                d.id = id,
                d.estado=estado,
                d.tarea=tarea,
                d.fechaInicio=fechaInicio,
                d.fechaFin=fechaFin
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
            { data: 'id', name:'id',title:'Id' },
            { data: 'taskname', name:'taskname',title:'Tarea'},
            { data: 'category', name:'category',title:'Tipo Incidencia' },
            { data: 'subcategory', name:'subcategory' ,title:'Subtipo Incidencia'},
            { data: 'lost_data', name:'lost_data' ,title:'Pérdida Datos'},
            { data: 'period', name:'period' ,title:'Periodicidad'},
            { data: 'start_date', name:'start_date',title:'Fecha Inicio' },
            { data: 'end_date', name:'end_date' ,title:'Fecha Fin'},
            { data: 'status', name:'status',title:'Estado' }
        ]


        });
//salir
   function evento(){
    document.getElementById('logout-form').submit();
    event.preventDefault();
   }


//funcion de seleccion
function seleccion(){
 //carga de todos los elementos

     var id={{$id}};
     var estado =$("#estado option:selected").val();
     var tarea =$("#tarea option:selected").val();
     var fechaInicio=$("#fechaInicio").val();
     var fechaFin=$("#fechaFin").val();

        $('#listado_tareas_locales').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        searching: false,
        ajax: {
            url: "{{ route('dnota.listado_tareas_locales') }}",
            data: function (d) {
                d.id = id,
                d.estado=estado,
                d.tarea=tarea,
                d.fechaInicio=fechaInicio,
                d.fechaFin=fechaFin
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
            { data: 'id', name:'id',title:'Id' },
            { data: 'taskname', name:'taskname',title:'Tarea'},
            { data: 'category', name:'category',title:'Tipo Incidencia' },
            { data: 'subcategory', name:'subcategory' ,title:'Subtipo Incidencia'},
            { data: 'lost_data', name:'lost_data' ,title:'Pérdida Datos'},
            { data: 'period', name:'period' ,title:'Periodicidad'},
            { data: 'start_date', name:'start_date',title:'Fecha Inicio' },
            { data: 'end_date', name:'end_date' ,title:'Fecha Fin'},
            { data: 'status', name:'status',title:'Estado' }
        ]

        });
}





    </script>
@stop
