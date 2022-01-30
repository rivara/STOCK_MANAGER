@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h6>Equipos</h6>
@stop

@section('content')
    <div class="card" style="padding: 10px" >
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Descripción del activo:</label>
                        <select id="activo" class="form-control"  onchange="seleccionTarea()">
                            @foreach($assetCat as $key => $asset)
                            <option   value="{{$asset->id}}" name="{{$asset->name}}">
                                {{$asset->name}}
                            </option>
                            @endforeach
                            <option selected value='10'>Todas</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="subactivo"></div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <h3 id="titulo" style="display:none">Equipos</h3>
                        <table class="table table-bordered" id="listado_equipos"></table>
                    </div>
                </div>
            </div>
        </div>
@stop


@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script>
function seleccionTarea(){
  $.ajaxSetup({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
     });
     var id =$("#activo option:selected").val();
     $.ajax({
            type:'post',
            url:'Equipos',
            data:{id:id},
            success: function(data) {
                $("#subactivo").empty();
//smi 20210217
                if (id == '10'){

                    parte=" <label>Descripción del subactivo:</label>";
                    parte=parte+"<select id='subactivo' class='form-control'  onchange='seleccionSubTarea()'>";
                    parte=parte+"<option selected></option>";
                    parte=parte+"<option value='100'>Todas</option>";

                    $("#subactivo").append(parte);

                }else{

                    if(data.array.length!=65)
                    {
                    parte=" <label>Descripción del subactivo:</label>";
                        parte=parte+"<select id='subactivo' class='form-control'  onchange='seleccionSubTarea()'>";
                        parte=parte+"<option></option>";
                        for (i = 0; i < data.array.length; i++) {
                            parte=parte+"<option value="+data.array[i].id+">"+data.array[i].asset_subcategory+"</option>";
                        }
                        parte=parte+"</select>";
                        $("#subactivo").append(parte);

                    }else{
                        parte=" <label>Descripción del subactivo:</label>";
                        parte=parte+"<select id='subactivo' class='form-control'  onchange='seleccionSubTarea()'>";
                        parte=parte+"<option selected></option>";
                        parte=parte+"<option value='100'>Todas</option>";

                        $("#subactivo").append(parte);

                    }
                }
             },
            error:function() {
                alert("error");
            }
        });

}


function seleccionSubTarea(){

     $('#titulo').css({"display":"block"});
     $.ajaxSetup({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
     });

    $('#listado_equipos').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        responsive: true,
        searching: true,
        ajax: {
            url: "{{ route('dnota.listado_equipos_2') }}",
            data: function (d){
                d.activo=$("#activo option:selected").val();
                d.subactivo=$("#subactivo option:selected").val();
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
            { data: 'start_date', name: 'start_date' ,title:'Fecha instalación'},
            { data: 'end_date', name: 'end_date' ,title:'Fecha retirada'},
            { data: 'notes', name: 'notes' ,title:'Observaciones'},
            { data: 'regulations', name: 'regulations' ,title:'Normativas'}
    ],
        columnDefs: [{
                data: 'id',
                render : function(data){
                return '<form action="{{route('dnota.EquiposHistorico')}}" method="GET"> <input type="hidden" name="id" value="'+data+'" /><input type="submit"  style="margin-bottom: 10px;" class="btn btn-success pull-right"  value="Histórico"'+data+'/></form>'
                },
          targets :13
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
          targets :9
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
        targets :10
        }

        ]
    })
}

    </script>
@stop

