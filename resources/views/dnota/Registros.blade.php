@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h6>Estaciones- Equipos >> Actuaciones >>{{$id}} </h6>
@stop

@section('content')
<div class="card" style="padding: 10px" >
    <div class="container">
        <div class="row">

            <div class="col-md-11">
                <h1>Equipo {{$nombreEquipo}}</h1>
            </div>
            <div class="col-md-1">
               <!-- <a href='{# redirect()->getUrlGenerator()->previous() }}' class='btn btn-info'>Volver</a> -->
            </div>

            <div class="col-md-12">
                <table id ="listado_registros"class="table table-bordered"> </table>
            </div>

        </div>
    </div>
</div>
@stop




@section('js')

<script>
    //Registros de equipos
     $('#listado_registros').DataTable({
        responsive: true,
        ajax: {
            url: "{{ route('dnota.listado_registros') }}",
            data: function (d) {
                d.id ={{$id}}
            }
        },
        columns:[
            { data:'id', name:'id',title:'Id' },
            { data:'description', name:'description',title:'Patron'}

        ],
        columnDefs: [
            {
          render : function(data, type, full, meta){
                    if(full.description != '-'){
                       return '<form action= "{{ route('dnota.ActuacionesPorEquipoBack') }}" "" method="get"><input type="hidden" name="id" value="'+full.description+'"><input type="submit"   class="btn  btn-warning "  value="Certificados"/></form>';

                    }else{
                        return '';
                    }

          },
          targets :2
        }],

});

  </script>

@stop
