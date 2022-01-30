@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Crea Incidencia
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route("dnota.GrabaAccion") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="tags">{{ trans('cruds.task.fields.tag') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control " name="tags[]" id="tags"  required  onchange="mantenimento()">
                                @foreach($tags as $id => $tag)
                                 <option value="{{ $tag->id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tags'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tags') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.tag_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required"  for="status_id">{{ trans('cruds.task.fields.status') }}</label>
                            <select class="form-control " name="status_id" id="status_id">
                                @foreach($statuses as $id => $status)
                                <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $task->status->id ?? '') == $id ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>

                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="location_id">{{ trans('cruds.task.fields.location') }}</label>


                            <select onchange="seleccionaubica()" class="form-control " name="location_id" id="location_id" required>
                                @foreach($locations as $id => $location)
                                <option value="{{ $id }}" {{ (old('location_id') ? old('location_id') : $task->location->id ?? '') == $id ? 'selected' : '' }}>{{ $location }}</option>
                            @endforeach
                            </select>
                            <small id="nota1" style="display: none">*Este equipo se enviará al taller</small>
                            <small id="nota2" style="display: none">*Este equipo viene del taller</small>
                            @if($errors->has('location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.location_helper') }}</span>




                        </div>
                        <!----------------------------->
                        <!-- si cambia se activa-->
                        <!-- sólo los equipos asociados a esa estación-->
                        <!----------------------------->

                        <div class="form-group">
                            <label class="required" for="asset_id">{{ trans('cruds.task.fields.asset') }}</label>
                            <div id="equipos">
                            </div>

                            @if($errors->has('asset'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('asset') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.asset_helper') }}</span>
                        </div>

                        <!---------------------------->
                        <!-- si cambia se activa-->
                        <!---------------------------->
                        <div class="form-group">
                            <label class="required" for="asset_status_id">{{ trans('cruds.task.fields.asset_status') }}</label>
                            <select class="form-control " name="asset_status_id" id="asset_status_id" required>
                                @foreach($asset_statuses as $id => $asset_status)
                                    <option value="{{$id}}">{{ $asset_status}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('asset_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('asset_status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.asset_status_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label class="required" for="period_id">{{ trans('cruds.task.fields.period') }}</label>
                            <select class="form-control " name="period_id" id="period_id">
                                @foreach($periods as $id =>  $period)
                                    <option value="{{ $id }}" >{{ $period }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('period'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('period') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.period_helper') }}</span>
                        </div>

                        <!--categoría-->
                        <div class="form-group">
                            <label class="required" for="incidence_category">{{ trans('cruds.task.fields.incidence_category') }}</label>


                            <select onchange="subtipoincidencia()" class="form-control " name="incidence_category_id" id="incidence_category_id" required>
                                @foreach($incidence_categories as $id =>  $incidence_category)
                                   <!-- <option value="{{ $id }}" > {{ (old('incidence_category') ? old('incidence_category') : $task->incidence_category->id ?? '') == $id ? 'selected' : '' }}>{{ $incidence_category }}</option>-->
                                   <option value="{{ $id }}" >{{ $incidence_category }}</option>
                                @endforeach
                                </select>
                            <small>poner N/A cuando no sea una incidencia</small>
                            @if($errors->has('incidence_category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('incidence_category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.incidence_category_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label class="required" for="incidence_subcategory">{{ trans('cruds.task.fields.incidence_subcategory') }}</label>
                            <div id="subincidencias">
                            </div>

                            @if($errors->has('incidence_subcategory'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('incidence_subcategory') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.incidence_subcategory_helper') }}</span>
                        </div>


                        <div class="form-group">
                            <label for="description">{{ trans('cruds.task.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.description_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <div>
                                <input type="hidden" name="lost_data" value="0">
                                <input type="checkbox" name="lost_data" id="lost_data" value="1" {{ old('lost_data', 0) == 1 ? 'checked' : '' }}>
                                <label for="lost_data">{{ trans('cruds.task.fields.lost_data') }}</label>
                            </div>
                            @if($errors->has('lost_data'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lost_data') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.lost_data_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label class="required"   for="start_date">{{ trans('cruds.task.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}">
                            @if($errors->has('start_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="due_date">{{ trans('cruds.task.fields.due_date') }}</label>
                            <input class="form-control date" type="text" name="due_date" id="due_date" value="{{ old('due_date') }}">
                            @if($errors->has('due_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('due_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.due_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required"  for="end_date">{{ trans('cruds.task.fields.end_date') }}</label>
                            <input class="form-control date" type="text" name="end_date" id="end_date" value="{{ old('end_date') }}">
                            @if($errors->has('end_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.end_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="assigned_to_id">{{ trans('cruds.task.fields.assigned_to') }}</label>
                            <select class="form-control" name="assigned_to_id" id="assigned_to_id">
                            <option selected></option>
                                @foreach($users as $id => $user)
                                    <option value="{{ $id }}">{{ $user}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="job_id">{{ trans('cruds.task.fields.job') }}</label>
                            <select class="form-control " name="job_id" id="job_id">
                                @foreach($jobs as $id => $job)
                                    <option value="{{ $id }}" {{ old('job_id') == $id ? 'selected' : '' }}>{{ $job }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('job'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.job_helper') }}</span>
                        </div>


                        <div class="form-group">
                            <label for="link_id">{{ trans('cruds.task.fields.link') }}</label>
                            <textarea name="link" id="link" class="form-control" rows="10" cols="30"></textarea>
                        </div>
                        <br>

                        <input type="hidden" id="cus" name="cus" value="3487">
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<!-- integrar en public y ver porque no graba -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>




$( function() {
 $(".date").datepicker({ dateFormat:'dd/mm/yy' });
} );


    // oculta estos campos cuando no se trata de una calibracion
    function mantenimento(){
       $type=$( "#tags option:selected" ).text();
       if($type=='Calibración'){
            $('#patrones').css("display","block");
       }else{
        $('#patrones').css("display","none");
       }


// tanto en retirada como instalacion se crerá cerrada (acciones completas)

       if($type=='Retirada'){
            $("#status_id").val(3);
            $("#nota1").css("display","block");
            $("#nota2").css("display","none");
            seleccionaubica();
       }

       if($type=='Instalación'){
        $("#nota1").css("display","none");
        $("#nota2").css("display","block");
            seleccionaubica();
       }


       if(($type=='Instalación')||($type=='Retirada')){
       $("#status_id").val(3);

       }else{
            $("#nota1").css("display","none");
            $("#nota2").css("display","none");
            $("#status_id").val(1);
       }

    }

    // devuelve las máquinas que estan en esa estación
    // en caso de ser instalacion agregar las de taller
     function seleccionaubica(){
      type=$("#tags option:selected").val();
      id=$("#location_id option:selected").val();

        $.ajaxSetup({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            type:'post',
            url:'BuscaEquipos',
            data:{id:id,type:type},
            success: function(data) {
             $("#equipos").empty();
            parte="<select class='form-control select2' name='asset_id' id='asset_id' required>";
            for (i = 0; i < data.length; i++) {
                parte=parte+"<option value="+data[i].id+">"+data[i].asset+"&nbsp;&nbsp;&nbsp;"+data[i].type+"&nbsp;&nbsp;"+data[i].subtype+"</option>";
            }
            parte=parte+"</select>";
            $("#equipos").append(parte);

            $(".select2").select2({
                tags: true
            });
            },
            error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Error - ' + errorMessage);
            }
            });

    }

    function subtipoincidencia(){

        id=$("#incidence_category_id option:selected").val();

        $.ajaxSetup({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            type:'post',
            url:'BuscaSubincidencia',
            data:{id:id},
            success: function(data) {
            $("#subincidencias").empty();
            parte="<select class='form-control' name='incidence_subcategory_id' id='incidence_subcategory_id' required>";
            for (i = 0; i < data.length; i++) {
                parte=parte+"<option value="+data[i].id+">"+data[i].subcategory+"&nbsp;&nbsp;&nbsp;</option>";
            }
            parte=parte+"</select>";
            $("#subincidencias").append(parte);


            },
            error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Error - ' + errorMessage);
            }
        });

    }

</script>
@stop

