@extends('adminlte::page')
@section('content')


<div class="card">
    <div class="card-header">

        {{ trans('global.edit') }} {{ trans('cruds.task.title_singular') }}
    </div>
<div class="card-body">
        <div class="container">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                    <h1>
                        @isset($task[0]->estacion)
                            {{$task[0]->estacion}}
                        @endisset
                    </h1>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <table class="table">
                                <tbody>
                                    <tr>
                                    <td>id</td>
                                    <td>
                                        @isset($task[0]->id)
                                            {{$task[0]->id}}
                                        @endisset
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>Nombre</td>
                                    <td>
                                        @isset($task[0]->taskname)
                                            {{$task[0]->taskname}}
                                        @endisset
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>Equipo</td>
                                    <td>
                                        @isset($task[0]->aset)
                                            {{$task[0]->aset}}
                                        @endisset
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>Categoria</td>
                                    <td>
                                        @isset($task[0]->category)
                                            {{$task[0]->category}}
                                        @endisset
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>Subcategoria</td>
                                    <td>
                                        @isset($task[0]->subcategory)
                                            {{$task[0]->subcategory}}
                                        @endisset
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>Periodo</td>
                                    <td>
                                        @isset($task[0]->period)
                                            {{$task[0]->period}}
                                        @endisset
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>Fecha de inicio</td>
                                    <td>
                                        @isset($task[0]->start_date)
                                            {{$task[0]->start_date}}
                                        @endisset
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>Fecha de fin</td>
                                    <td>
                                        @isset($task[0]->end_date)
                                            {{$task[0]->end_date}}
                                        @endisset
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>Estado</td>
                                    <td>
                                        @isset($task[0]->status)
                                            {{$task[0]->status}}
                                        @endisset
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>Descripción</td>
                                    <td>
                                        @isset($task[0]->description)
                                            {{$task[0]->description}}
                                        @endisset
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
            </div>
    </div>
</div>
@endsection
