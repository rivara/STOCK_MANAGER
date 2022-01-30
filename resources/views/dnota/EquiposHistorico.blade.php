@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h6>Equipos {{$id}}</h6>
@stop

@section('content')
<div class="card" style="padding: 10px" >
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Histórico de {{$name}}</h2>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered" id="listado_historicos_equipos"></table>
                        </div>
                    </div>
                </div>
@stop




@section('js')
<script type="text/javascript" src="{{asset('vendor/moment/moment.min.js')}}"></script>

<script>
  $.ajaxSetup({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
     });

    $('#listado_historicos_equipos').DataTable({
       processing: true,
        serverSide: true,
        destroy: true,
        responsive: true,
        searching: false,
        ajax: {
            url: "{{route('dnota.listado_historicos_equipos') }}",
            data: function (d){
                d.id={{$id}}
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
            { data: 'id', name:'id',title:'Id'},
            { data: 'asset', name:'asset',title:'Equipo'},
            { data: 'location', name:'location' ,title:'Ubicación'},
            { data: 'start_date', name:'start_date',title:'Fecha Inicio' },
            { data: 'end_date', name:'end_date' ,title:'Fecha Fin'},
            { data: 'status', name:'status',title:'Estado' }

        ],

        columnDefs: [


            {
          title:'Fecha Inicio',
          render : function(data, type, full, meta){
              if (full.start_date==null){

                  return full.start_date;
              }else{
                return moment(full.start_date).format('DD/MM/YYYY');
              }

          },
          targets :3

        },

        {
          title:'Fecha Fin',
          render : function(data, type, full, meta){
              if (full.end_date==null){

                  return full.end_date;
              }else{
                return moment(full.end_date).format('DD/MM/YYYY');
              }

          },
          targets :4

        }



    ]
    })

    </script>
@stop
