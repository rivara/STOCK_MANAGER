@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h6>Estaciones- Equipos >> Actuaciones >>{{$idAsset}} </h6>
@stop


@section('content')
<div class="card" style="padding: 10px" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Editar Patrón {{$record->id}}</h1>
            </div>
            <div class="col-md-4">
                <form method="POST" action="{{ route("dnota.ActualizarRegistro") }}"  enctype="multipart/form-data">
                    @csrf
                   <div class="form-group">
                        <label for="exampleInputEmail1">description</label>
                            <select class="form-control select2" name="asset_id" id="asset_id">
                             <option value="{{$record->id }}">{{ $record->description }}</option>
                            @foreach($asset as $asse)
                               <option value="{{$asse->id }}">{{ $asse->name }}</option>
                            @endforeach
                            </select>
                    </div>

                    <div class="form-group">
                        <label>Tipo</label>
                        <input type="text" class="form-control" name="tipo" id="tipo" value="{{$record->type}}">

                    </div>
                    <div class="form-group">
                        <label>Url</label>
                        <input type="text" class="form-control" name="url" id="url" value="{{$record->url}}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                    <input id="idAsset" name="idAsset" type="hidden" value={{$idAsset}}>
                    <input id="id" name="id" type="hidden" value={{$record->id}}>


                </form>
            </div>
            <div class="col-md-8"></div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" />
@stop


@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>



@stop
