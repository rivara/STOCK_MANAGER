@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h6>Actuaciones Por Equipo</h6>
@stop


@section('content')
@isset($asset_id)
    <div id="assetId" value={{$asset_id}}></div>
@endisset
<div class="card" style="padding: 10px" >

                    <div class="row">
                        <div class="col-md-12"></div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Equipo:</label>
                                <select  id="equipo" class="form-control select2"  onchange="seleccion()">
                                    <option>&nbsp;</option>
                                    <option value="#">Todas</option>

                                    @isset($asset_id)
                                        <option selected  value={{$asset_id}}>{{$asset_name}}</option>
                                    @endisset

                                    @foreach($assets as $key => $asset)
                                    <option   value="{{$asset->id}}" name="{{$asset->name}}">
                                    {{$asset->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Descripción de la tarea:</label>
                                <select id="tarea" class="form-control"  onchange="seleccion()">
                                    <option selected  value="0"  name="todas">Todas</option>
                                    @foreach($taskTag as $key => $task)
                                    <option   value="{{$task->id}}" name="{{$task->name}}">
                                        {{$task->name}}
                                    </option>
                                    @endforeach
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

                        <div class="col-md-12">
                            <div class="table-responsive">
                                <h3 id="titulo" style="display:none">Actuaciones</h3>
                                <table class="table table-bordered" id="listado_tareas_globales_act_porEquipo">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@stop

@section('js')

<script type="text/javascript" src="{{asset('vendor/moment/moment.min.js')}}"></script>
    <script>
  $(".select2").select2({
  tags: true
});

/// si viene de una eliminacion o edicion

var value = $("#assetId").attr('value');

  if (value != undefined){
     var equipo =value;
     var estado =$("#estado option:selected").val();
     var tarea =$("#tarea option:selected").val();
     var fechaInicio=$("#fechaInicio").val();
     var fechaFin=$("#fechaFin").val();

    $('#titulo').css({"display":"block"});
     $.ajaxSetup({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
     });

 $('#listado_testadoareas_globales_act_porEquipo').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        responsive: true,
        searching: true,
        ajax: {
            url: "{{ route('dnota.listado_tareas_globales_act_porEquipo') }}",
            data: function (d) {
                d.equipo=value,
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
            { data: 'nameaset', name:'nameaset',title:'Nombre'},
            { data: 'taskname', name:'taskname',title:'Tipo' },
            { data: 'incidence_category', name:'incidence_category',title:'Tipo Incidencia' },
            { data: 'incidence_subcategory', name:'incidence_subcategory' ,title:'Subtipo Incidencia'},
            { data: 'lost_data', name:'lost_data' ,title:'Pérdida Datos'},
            { data: 'period', name:'period' ,title:'Periodicidad'},
            { data: 'start_date', name:'start_date',title:'Fecha Inicio' },
            { data: 'end_date', name:'end_date' ,title:'Fecha Fin'},
            { data: 'due_date', name:'due_date' ,title:'Fecha Ejecución'},
            { data: 'status', name:'status',title:'Estado' },
            { data: 'description', name:'description' ,title:'Descripción'},
            { data: 'estacion', name:'estacion' ,title:'Estación'},
            { data: 'users', name:'users' ,title:'Usuario'}

        ],
        columnDefs: [{
            title:'Registro',
            data: 'link',
            render : function(data){
                    if (data != null){
                        var array = data.split(" ");
                        var back =" ";
                        var cuenta= array.length - 1;
                        for (i = 0; i <= cuenta; i++) {
                            back=back+"<a href="+array[i]+">"+array[i]+"</a>";
                    }
                return back;
                    }else{
                return data;
                }
            },
                targets :14
        },
        {
          title:'Patrones',
          render : function(data, type, full, meta){
                if(full.taskname  =='Calibración'){
                    return '<form action="{{route('dnota.Registros')}}" method="get"><input type="hidden" name="id" value="'+full.id+'"><input type="hidden" name="nombre" value="'+full.category+'"><input type="submit"  style="margin-bottom: 10px;" class="btn btn-warning pull-right"  value="Patrones"/></form>';
                }else{
                    return "";
                }
          },
          targets :15
        },
        {
          title:'Pérdida Datos',
          render : function(data, type, full, meta){
             var bool;
            if(full.lost_data == 0){
                bool="N";
            }else{
                bool="S";
            }
            return bool;
          },
          targets :5
        },
//smi 20210216
{
          title:'Fecha inicio',
          render : function(data, type, full, meta){
              if (full.start_date==null){
                  return full.start_date;
              }else{
                  return moment(full.start_date).format('DD/MM/YYYY');
              }

          },
          targets :7
        },

        {
        title:'Fecha fin',
        render : function(data, type, full, meta){
            if (full.end_date==null){
                  return full.end_date;
              }else{
                  return moment(full.end_date).format('DD/MM/YYYY');
              }
        },
        targets :8
        },
        {
        title:'Fecha ejecucion',
        render : function(data, type, full, meta){
            if (full.due_date==null){
                return full.due_date;
            }else{
                return moment(full.due_date).format('DD/MM/YYYY');
            }
        },
        targets :9
        }


        ]

    });



  }

//salir
   function evento(){
    document.getElementById('logout-form').submit();
    event.preventDefault();
   }


//funcion de seleccion
function seleccion(){
     var equipo =$("#equipo option:selected").val();
     var estado  =$("#estado option:selected").val();
     var tarea =$("#tarea option:selected").val();
     var fechaInicio=$("#fechaInicio").val();
     var fechaFin=$("#fechaFin").val();

     $('#titulo').css({"display":"block"});
     $.ajaxSetup({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
     });

 $('#listado_tareas_globales_act_porEquipo').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        responsive: true,
        searching: true,
        ajax: {
            url: "{{ route('dnota.listado_tareas_globales_act_porEquipo') }}",
            data: function (d) {
                d.equipo=equipo,
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
            { data: 'nameaset', name:'nameaset',title:'Nombre'},
            { data: 'taskname', name:'taskname',title:'Tipo' },
            { data: 'category', name:'category',title:'Tipo Incidencia' },
            { data: 'subcategory', name:'subcategory' ,title:'Subtipo Incidencia'},
            { data: 'lost_data', name:'lost_data' ,title:'Pérdida Datos'},
            { data: 'period', name:'period' ,title:'Periodicidad'},
            { data: 'start_date', name:'start_date',title:'Fecha Inicio' },
            { data: 'end_date', name:'end_date' ,title:'Fecha Fin'},
            { data: 'due_date', name:'due_date' ,title:'Fecha Ejecución'},
            { data: 'status', name:'status',title:'Estado' },
            { data: 'description', name:'description' ,title:'Descripción'},
            { data: 'estacion', name:'estacion' ,title:'Estación'},
            { data: 'users', name:'users' ,title:'Usuario'}

        ],
        columnDefs: [{
            title:'Registro',
            data: 'link',
            render : function(data){
                    if (data != null){
                        var array = data.split(" ");
                        var back =" ";
                        var cuenta= array.length - 1;
                        for (i = 0; i <= cuenta; i++) {
                            back=back+"<a href="+array[i]+">"+array[i]+"</a>";
                    }
                return back;
                    }else{
                return data;
                }
            },
                targets :14
        },
        {
          title:'Patrones',
          render : function(data, type, full, meta){
                if(full.taskname  =='Calibración'){
                    return '<form action="{{route('dnota.Registros')}}" method="get"><input type="hidden" name="id" value="'+full.id+'"><input type="hidden" name="nombre" value="'+full.category+'"><input type="submit"  style="margin-bottom: 10px;" class="btn btn-warning pull-right"  value="Patrones"/></form>';
                }else{
                    return "";
                }
          },
          targets :15
        },
        {
          title:'Pérdida Datos',
          render : function(data, type, full, meta){
             var bool;
            if(full.lost_data == 0){
                bool="N";
            }else{
                bool="S";
            }
            return bool;
          },
          targets :5
        },
        {
          title:'Fecha inicio',
          render : function(data, type, full, meta){
              if (full.start_date==null){
                  return full.start_date;
              }else{
                  return moment(full.start_date).format('DD/MM/YYYY');
              }

          },
          targets :7
        },

        {
        title:'Fecha fin',
        render : function(data, type, full, meta){
            if (full.end_date==null){
                  return full.end_date;
              }else{
                  return moment(full.end_date).format('DD/MM/YYYY');
              }
        },
        targets :8
        },
        {
        title:'Fecha ejecucion',
        render : function(data, type, full, meta){
            if (full.due_date==null){
                return full.due_date;
            }else{
                return moment(full.due_date).format('DD/MM/YYYY');
            }
        },
        targets :9
        }

        ]
    });
}
   </script>    
    
    
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>    
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>    
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>   
    


    <script>
        $(function() {
  let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
  let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
  let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
  let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
  let printButtonTrans = '{{ trans('global.datatables.print') }}'
 

  let languages = {
    'es': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json',
        'ca': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Catalan.json',
        'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
  };

  $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
  $.extend(true, $.fn.dataTable.defaults, {
    language: {
      url: languages['{{ app()->getLocale() }}']
    },
    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
    }, {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    select: {
      style:    'multi+shift',
      selector: 'td:first-child'
    },
    order: [],
    pageLength: 500,
    dom: 'lBfrtip<"actions">',
    buttons: [
     
      {
        extend: 'copy',
        className: 'btn-default',
        text: copyButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'csv',
        className: 'btn-default',
        text: csvButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'excel',
        className: 'btn-default',
        text: excelButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'pdf',
        className: 'btn-default',
        text: pdfButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'print',
        className: 'btn-default',
        text: printButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      }
    ]
  });

  $.fn.dataTable.ext.classes.sPageButton = '';
});

    </script>



    </script>
@stop
