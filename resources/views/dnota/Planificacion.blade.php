@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h6>Planificación</h6>
@stop

@section('content')
    <div class="card" style="padding: 10px" >
        <div class="container">
            <div class="row">

                <div class="col-md-10"></div>
                <div class="col-md-2">
                        <div class="float-left">abierto</div>
                        <div class="float-left square" style="background-color: #228B22;margin-top:8px;margin-left:30px"></div>
                        <br>
                        <div class="float-left">pendiente</div>
                        <div class="float-left square" style="background-color: #FFFF99;margin-top:8px;margin-left:10px"></div>
                        <br>
                        <div class="float-left">cerrado</div>
                        <div class="float-left square" style="background-color: grey;margin-top:8px;margin-left:28px"></div>
                </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Estación</label>

                                <select id="ubicacion_id" class="form-control"  onchange="seleccion()">
                                    @foreach($assetLocation as $key => $asset)
                                    <option   value="{{$asset->id}}" name="{{$asset->name}}">
                                        {{$asset->name}}
                                    </option>
                                    @endforeach
                                    @if(isset($location))
                                     <option id="seleccionado"  selected  value="{{$location->id}}" name="{{$location->name}}" >
                                            {{$location->name}}
                                    </option>
                                    @else
                                    <option  selected > vacio</option>
                                    @endif
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Año:</label>
                                 <input class="form-control" type="number" id="year"  min="2010"  onclick="seleccion()">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mes:</label>
                                <select id="month" class="form-control"  onchange="seleccion()">
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"  />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" />


@stop


@section('js')
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script src='{{asset('/js/fullcalendar/es.js')}}'></script>
<script src='{{asset('/js/spinner.js')}}'></script>


<script>



            function seleccion(){
                var location_id =$("#ubicacion_id option:selected" ).val();
                var month =$("#month option:selected" ).val();
                var year =$("#year").val();
                $.ajaxSetup({
                        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });

                $.ajax({
                    type:'POST',
                    url:'Planificacion',
                    data:{
                            location_id:location_id,
                            month:month,
                            year:year
                            },
                    success:function(data) {
                                var eventsList = [];
                                var i;
                                for (i = 0; i < data.d.length; i++) {
                                    var event ={
                                    title: "'"+data.d[i].name+"'",
                                    start:data.d[i].start,
                                    url : data.d[i].id,
                                    color:data.d[i].color
                                    };
                                eventsList.push(event);
                                }
                                $('#calendar').fullCalendar('destroy');
                                $('#calendar').fullCalendar('render');
                                $('#calendar').fullCalendar({locale: 'es', events:eventsList ,header:{right:''}});


                    date = moment(year+"-"+month+"-01", "YYYY-MM-DD");
                    $('#calendar').fullCalendar('gotoDate',date);

                    },
                    error:function() {alert("error");}
                    });
        }

        var val=$("#seleccionado").val();
        if(val !== undefined){

            var location_id =$("#ubicacion_id option:selected" ).val();
                var month =$("#month option:selected" ).val();
                var year =$("#year").val();
                $.ajaxSetup({
                        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });

                $.ajax({
                    type:'POST',
                    url:'Planificacion',
                    data:{
                            location_id:location_id,
                            month:month,
                            year:year
                            },
                    success:function(data) {

                                var eventsList = [];
                                var i;
                                for (i = 0; i < data.d.length; i++) {
                                    var event ={
                                    title: "'"+data.d[i].name+"'",
                                    start:data.d[i].start,
                                    url : data.d[i].id,
                                    color:data.d[i].color
                                    };
                                eventsList.push(event);
                                }

                    $('#calendar').fullCalendar({
                            events:eventsList
                            });
                    $('#calendar').render()
                    date = moment(year+"-"+month+"-01", "YYYY-MM-DD");
                    $('#calendar').fullCalendar('gotoDate',date);


                    },
                    error:function() {alert("error");}
                    });

        }

        $("input[type='number']").inputSpinner();
    </script>
@stop


