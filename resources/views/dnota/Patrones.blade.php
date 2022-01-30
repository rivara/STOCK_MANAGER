@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h6>Añade Patrones</h6>
@stop

@section('content')
    <div class="container">
        <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 card" style="padding: 10px">
                        <form method="GET" action="{{ route("dnota.GrabaPatrones") }}" enctype="multipart/form-data">
                            <div class="form-group">
                                <label  for="asset_id">patron 1</label>
                                <select class="form-control select2" name="patron1" id="patron1" >
                                    <option selected value="-"></option>
                                    @foreach($events as  $event)
                                        <option value="{{ $event->id }}">{{$event->asset}} {{$event->type}} {{$event->subtype}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label  for="asset_id">patron 2</label>
                                <select class="form-control select2" name="patron2" id="patron2" >
                                    <option selected value="-"></option>
                                    @foreach($events as  $event)
                                        <option value="{{ $event->id }}">{{$event->asset}} {{$event->type}} {{$event->subtype}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="asset_id">patron 3</label>

                                <select class="form-control select2" name="patron3" id="patron3" >
                                    <option selected value="-"></option>
                                    @foreach($events as  $event)
                                        <option value="{{ $event->id }}">{{$event->asset}} {{$event->type}} {{$event->subtype}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label  for="asset_id">patron 4</label>

                                <select class="form-control select2" name="patron4" id="patron4" >
                                    <option selected value="-"></option>
                                    @foreach($events as  $event)
                                        <option value="{{ $event->id }}">{{$event->asset}} {{$event->type}} {{$event->subtype}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label  for="asset_id">patron 5</label>

                                <select class="form-control select2" name="patron5" id="patron5" >
                                    <option selected value="-"></option>
                                    @foreach($events as  $event)
                                        <option value="{{ $event->id }}">{{$event->asset}} {{$event->type}} {{$event->subtype}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" id='id' name='id' value= {{$id}}>
                            <input type="hidden" id='idActuacion' name='idActuacion' value= {{$idActuacion}}>
                            <input type="submit" class="btn btn-primary" value="graba patrones">
                        </form>
                    </div>
                <div class="col-md-4"></div>
            </div>
    </div>

@stop

@section('js')
    <script>
        $(".select2").select2({
            tags: true
        });
    </script>
@stop
