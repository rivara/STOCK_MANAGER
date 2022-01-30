@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h6>Administracion</h6>
@stop

@section('content')
<div class="card" style="padding: 10px" >
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                  <a class="nav-link btn" id="cambio1" onclick="cambio('op1')">Usuarios</a>
                                </li>
                                <li class="nav-item">
                                  <a  class="nav-link btn" id="cambio2" onclick="cambio('op2')">Resumenes</a>
                                </li>
                              </ul>
                        </div>
                        <div class="col-md-12 part" id="op1" style="display: none">
                            <br>
                            <div class="table-responsive">
                                <h4 id="titulo_usuarios" style="display:none">Listado de Usuarios</h4>
                                <table class="table table-bordered" id="listado_usuarios">
                                </table>
                            </div>

                        </div>

                        <div class="col-md-12 part" id="op2" style="display: none">
                            <br>
                            <div class="table-responsive">
                                <h4 id="titulo_resumen" style="display:none">Resumen</h4>

                            </div>

                        </div>

                    </div>
                </div>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" />

@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script>

function cambio(op){

    $('.part').css("display","none");
    $('#'+op).css("display","block");

    if (op == "op1"){

        document.getElementById("cambio1").className = "nav-link active btn";
        document.getElementById("cambio2").className = "nav-link btn";
        $('#titulo_usuarios').css({"display":"block"});

        $('#listado_usuarios').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            destroy: true,
            ajax: {
                url: "{{ route('dnota.listado_usuarios') }}"
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
                { data: 'name', name:'name',title:'Nombre' },
                { data: 'email', name:'email',title:'Email'},
                { data: 'title', name:'title',title:'Rol'}
            ]
        });

    }else{
        document.getElementById("cambio2").className = "nav-link active btn";
        document.getElementById("cambio1").className = "nav-link btn";
        $('#titulo_resumen').css({"display":"block"});
    }

}

    </script>
@stop
