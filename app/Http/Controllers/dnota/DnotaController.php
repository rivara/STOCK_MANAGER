<?php

namespace App\Http\Controllers\dnota;

use App\Models\Asset;
use App\Models\AssetLocation;
use App\Models\AssetStatus;
use App\Models\AssetCategory;
use App\Models\AssetsHistory;
use App\Models\IncidencesCategory;
use App\Models\IncidencesSubcategory;
use App\Models\Task;
use App\Models\TaskTag;
use App\Models\TaskStatus;
use App\Models\Mark;
use App\Models\Record;
use App\Models\Sample;
use App\Models\AssetSubCategory;
use App\Models\Period;
use App\Models\Job;
use App\Models\User;
use App\Models\Network;
use App\Models\Province;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAssetRequest;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;



class DnotaController extends Controller
{
    //////////////////////////////////////////////
    //                  HOME
    //////////////////////////////////////////////
    public function EquiposProvincias(Request $request)
    {
        $id = $request->input('id');
        $item = AssetLocation::find($id);
        $red = Network::where('id', $item->network_id)->value('network');
        $provincia = Province::where('id', $item->province_id)->value('province');
        $municipio = Municipality::where('id', $item->municipality_id)->value('municipality');
        $zone = Zone::where('id', $item->zone_id)->value('zone');

        return response()->json(array(
            'provincia' => $provincia,
            'municipio' => $municipio,
            'cred' => $red,
            'ceuropeo' => $item->name_cee,
            'direccion' => $item->address,
            'latitud' => $item->latitude,
            'zona' => $zone,
            'longitud' => $item->longitude,
            'altitud' => $item->altitude
        ));
    }


    public function EstacionDetalle(Request $request)
    {
        $idEquipo = $request->input('id');
        $nombreZona = $request->input('zona');
        $nombreEquipo = Asset::where('id', $request->input('id'))->value('name');
        $tasktag = TaskTag::all();
        $taskStatus = TaskStatus::all();
        return view('dnota/EstacionDetalle', ['id' => $idEquipo, 'nombreZona' => $nombreZona, 'nombreEquipo' => $nombreEquipo, 'tasktag' => $tasktag, 'taskStatus' => $taskStatus]);
    }


    public function EquiposZona(Request $request)
    {
        $assets = Asset::select(
            'assets.id as id',
            'assets.name as asset',
            'assets.serial_number',
            'asset_categories.name as type',
            'asset_sub_categories.asset_subcategory as subtype',
            'asset_statuses.name as status',
            'asset_locations.name as location',
            'marks.mark',
            'samples.sample',
            'assets.start_date',
            'assets.end_date',
            'assets.notes',
            'assets.regulations',
            'zones.zone as zona',
            'networks.network as network'
        )
            ->join('asset_categories', 'assets.category_id', '=', 'asset_categories.id')
            ->join('asset_sub_categories', 'assets.subcategory_id', '=', 'asset_sub_categories.id')
            ->join('asset_statuses', 'assets.status_id', '=', 'asset_statuses.id')
            ->join('asset_locations', 'assets.location_id', '=', 'asset_locations.id')
            ->join('marks', 'assets.mark_id', '=', 'marks.id')
            ->join('samples', 'assets.sample_id', '=', 'samples.id')
            ->join('zones', 'zones.id', '=', 'asset_locations.zone_id')
            ->join('networks', 'networks.id', '=', 'asset_locations.network_id')
            ->where('assets.location_id', $request->input('id'))
            ->get();
        return Datatables::of($assets)->make(true);
    }




    public function EstacionDetalleDatatable(Request $request)
    {

        if ($request->input('estado') != 4) {
            $estado[] = $request->input('estado');
        } else {
            $estado = [1, 2, 3];
        }

        //if ($request->input('tarea') != 8) {
        if ($request->input('tarea') != 0) {
            $tarea[] = $request->input('tarea');
        } else {
            //$tarea = [1, 2, 3, 4, 5, 6, 7, 8];
            $t_tareas = TaskTag::all()->pluck('id');
            for ($i = 0; $i < count($t_tareas); $i++) {
                $tarea[]=$t_tareas[$i]; 
            }
        }

        if (is_null($request->input('fechaInicio'))) {
            $inicio = "1969-01-01";
        } else {
            $inicio = $request->input('fechaInicio');
        }

        if (is_null($request->input('fechaFin'))) {
            $fin = date('Y-m-d', strtotime('+10 years'));
        } else {
            $fin = $request->input('fechaFin');
        }
        $idEquipo = $request->input('id');

        $tasks_mc = Task::select(
            'tasks.id as id',
            'task_tags.name as taskname',
            'incidences_categories.incidence_category as category',
            'incidences_subcategories.incidence_subcategory as subcategory',
            'tasks.lost_data',
            'periods.period as period',
            'tasks.start_date',
            'tasks.end_date',
            'task_statuses.name as status'
        )
            ->join('task_task_tag', 'task_task_tag.task_id', '=', 'tasks.id')
            ->join('task_tags', 'task_tags.id', '=', 'task_task_tag.task_tag_id')
            ->leftjoin('incidences_categories', 'tasks.incidence_category_id', '=', 'incidences_categories.id')
            ->leftjoin('incidences_subcategories', 'tasks.incidence_subcategory_id', '=', 'incidences_subcategories.id')
            ->join('periods', 'tasks.period_id', '=', 'periods.id')
            ->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')
            ->whereNull('tasks.incidence_category_id')
            ->whereNull('tasks.incidence_subcategory_id')
            ->whereIn('tasks.status_id', $estado)
            ->whereIn('task_tags.id', $tarea)
            ->where('tasks.start_date', '>=',  $inicio)
            ->where('tasks.end_date', '<=',  $fin)
            ->where('tasks.asset_id', $idEquipo);


        $tasks_i = Task::select(
            'tasks.id as id',
            'task_tags.name as taskname',
            'incidences_categories.incidence_category as category',
            'incidences_subcategories.incidence_subcategory as subcategory',
            'tasks.lost_data',
            'periods.period as period',
            'tasks.start_date',
            'tasks.end_date',
            'task_statuses.name as status'
        )
            ->join('task_task_tag', 'task_task_tag.task_id', '=', 'tasks.id')
            ->join('task_tags', 'task_tags.id', '=', 'task_task_tag.task_tag_id')
            ->join('incidences_categories', 'tasks.incidence_category_id', '=', 'incidences_categories.id')
            ->join('incidences_subcategories', 'tasks.incidence_subcategory_id', '=', 'incidences_subcategories.id')
            ->join('periods', 'tasks.period_id', '=', 'periods.id')
            ->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')
            ->whereNotNull('tasks.incidence_category_id')
            ->whereNotNull('tasks.incidence_subcategory_id')
            ->where('tasks.asset_id', $idEquipo)
            ->whereIn('tasks.status_id', $estado)
            ->whereIn('task_tags.id', $tarea)
            ->where('tasks.start_date', '>=',  $inicio)
            ->where('tasks.end_date', '<=', $fin)
            ->union($tasks_mc)
            ->get();

        $tasks = $tasks_i;
        return Datatables::of($tasks)->make(true);
    }




    public function eliminarEquipo(Request $request)
    {
        Asset::destroy($request->input('id_asset'));
        return redirect('dnota/home')->with('estacion', $request->input("id_provincia"));
    }





    public function editarEquipo(Request $request)
    {

        $categories = AssetCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = AssetStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $locations = AssetLocation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $marks = Mark::all()->pluck('mark', 'id')->prepend(trans('global.pleaseSelect'), '');
        $samples = Sample::all()->pluck('sample', 'id')->prepend(trans('global.pleaseSelect'), '');
        $records = Record::all()->pluck('record', 'id')->prepend(trans('global.pleaseSelect'), '');
        //$asset->load('category', 'status', 'location', 'assigned_to', 'mark', 'sample', 'record');
        $asset = Asset::find($request->input('id'));
        return view('dnota/EditarEquipo', compact('categories', 'statuses', 'locations', 'marks', 'samples', 'records', 'asset'));
    }


    public function actualizarEquipo(UpdateAssetRequest $request, Asset $asset)
    {
        $data = Asset::find($request->id);
        $data->update($request->all());


        if (count($asset->photos) > 0) {
            foreach ($asset->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }

        $media = $asset->photos->pluck('file_name')->toArray();

        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $asset->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
            }
        }

        return redirect('dnota/home')->with('estacion', $data->location_id);
    }



    //////////////////////////////////////
    //          ACTUACIONES
    /////////////////////////////////////
    //Actuaciones Pendientes

    public function ActuacionesPendientes()
    {
        $taskTag = TaskTag::all();
        $taskStatus = TaskStatus::all();
        $assets = AssetLocation::all();
        return view('dnota/ActuacionesPendientes', ['taskStatus' => $taskStatus, 'taskTag' => $taskTag, 'assets' => $assets]);

    }

    public function ActuacionesPendientesDetalleDatatable(Request $request)
    {

        //if ($request->input('tarea') != 8) {
        if ($request->input('tarea') != 0) {
            $tarea[] = $request->input('tarea');
        } else {
            //$tarea = [1, 2, 3, 4, 5, 6, 7];
            $t_tareas = TaskTag::all()->pluck('id');
            for ($i = 0; $i < count($t_tareas); $i++) {
                $tarea[]=$t_tareas[$i]; 
            }
        }
        $estado=[1,2];

        $ordenacion = $request->input('ordenacion');

        if ($request->input('estacion') == 99) {
            $t_locations = AssetLocation::all()->pluck('id');
            for ($i = 0; $i < count($t_locations); $i++) {
                $location[]=$t_locations[$i]; 
            }
            
        } else {
            $location[] = $request->input('estacion');
        }

        if (is_null($request->input('fechaInicio'))) {
            $inicio = "1969-01-01";
        } else {
            $inicio = date($request->input('fechaInicio'));
        }

        if (is_null($request->input('fechaFin'))) {
            $fin = date('Y-m-d', strtotime('+10 years'));
        } else {
            $fin = date($request->input('fechaFin'));
        }

        $tasks_mc = Task::select(
            'tasks.id as id',
            'task_tags.name as taskname',
            'assets.name as aset',
            'asset_sub_categories.asset_subcategory as asset_subcategory',
            'incidences_categories.incidence_category  as category',
            'incidences_subcategories.incidence_subcategory as subcategory',
            'tasks.lost_data as lost_data',
            'periods.period as period',
            'tasks.start_date as start_date',
            'tasks.end_date as end_date',
            'task_statuses.name as status',
            'tasks.description as description',
            'tasks.link as link',
            'asset_locations.name as estacion',
            'users.name as users'
        )
            ->join('assets', 'tasks.asset_id', '=', 'assets.id')
            ->join('asset_sub_categories', 'assets.subcategory_id', '=', 'asset_sub_categories.id')
            ->join('users', 'tasks.assigned_to_id', '=', 'users.id')
            ->join('task_task_tag', 'task_task_tag.task_id', '=', 'tasks.id')
            ->join('task_tags', 'task_tags.id', '=', 'task_task_tag.task_tag_id')
            ->leftjoin('incidences_categories', 'tasks.incidence_category_id', '=', 'incidences_categories.id')
            ->leftjoin('incidences_subcategories', 'tasks.incidence_subcategory_id', '=', 'incidences_subcategories.id')
            ->join('periods', 'tasks.period_id', '=', 'periods.id')
            ->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')
            ->join('asset_locations', 'tasks.location_id', '=', 'asset_locations.id')
            ->whereNull('tasks.incidence_category_id')
            ->whereNull('tasks.incidence_subcategory_id')
            ->whereIn('tasks.status_id', $estado)
            ->whereBetween('tasks.end_date', [$inicio, $fin])
            ->whereIn('task_tags.id', $tarea)
            ->whereIn('tasks.location_id', $location);


        $tasks_i = Task::select(
            'tasks.id as id',
            'task_tags.name as taskname',
            'assets.name as aset',
            'asset_sub_categories.asset_subcategory as asset_subcategory',
            'incidences_categories.incidence_category as category',
            'incidences_subcategories.incidence_subcategory as subcategory',
            'tasks.lost_data as lost_data',
            'periods.period as period',
            'tasks.start_date as start_date',
            'tasks.end_date as end_date',
            'task_statuses.name as status',
            'tasks.description as description',
            'tasks.link as link',
            'asset_locations.name as estacion',
            'users.name as users'
        )
            ->join('assets', 'tasks.asset_id', '=', 'assets.id')
            ->join('asset_sub_categories', 'assets.subcategory_id', '=', 'asset_sub_categories.id')
            ->join('users', 'tasks.assigned_to_id', '=', 'users.id')
            ->join('task_task_tag', 'task_task_tag.task_id', '=', 'tasks.id')
            ->join('task_tags', 'task_tags.id', '=', 'task_task_tag.task_tag_id')
            ->leftjoin('incidences_categories', 'tasks.incidence_category_id', '=', 'incidences_categories.id')
            ->leftjoin('incidences_subcategories', 'tasks.incidence_subcategory_id', '=', 'incidences_subcategories.id')
            ->join('periods', 'tasks.period_id', '=', 'periods.id')
            ->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')
            ->join('asset_locations', 'tasks.location_id', '=', 'asset_locations.id')
            ->whereNotNull('tasks.incidence_category_id')
            ->whereNotNull('tasks.incidence_subcategory_id')
            ->whereIn('tasks.status_id', $estado)
            ->whereBetween('tasks.end_date', [$inicio, $fin])
            ->whereIn('task_tags.id', $tarea)
            ->whereIn('tasks.location_id', $location)
            ->union($tasks_mc)
            ->get();
        $tasks_h = $tasks_i;


        return Datatables::of($tasks_h)->make(true);
    }



    public function eliminarActuacionPendiente(Request $request)
    {
        Task::destroy($request->input('id_task'));
        return redirect('dnota/ActuacionesPendientes')->with('estacion', $request->input('estacion'));
    }


    public function editarActuacionPendiente(Request $request)
    {
        //  abort_if(Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = TaskTag::whereNotIn('id', [4, 5])->pluck('name', 'id');
        $statuses = TaskStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $locations = AssetLocation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $asset_statuses = AssetStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $periods = Period::all()->pluck('period', 'id'); //->prepend(trans('global.pleaseSelect'), '');
        $incidence_categories = IncidencesCategory::all()->pluck('incidence_category', 'id');//->prepend(trans('global.pleaseSelect'), '');
        $incidence_subcategories = IncidencesSubcategory::where('incidence_subcategory', 'not like', '%Otros%')->pluck('incidence_subcategory', 'id')->prepend(trans('global.pleaseSelect'), '');
        $assigned_tos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $records = Record::all()->pluck('record', 'id')->prepend(trans('global.pleaseSelect'), '');
        $jobs = Job::all()->pluck('idjob', 'id')->prepend(trans('global.pleaseSelect'), '');
        $task = Task::find($request->input('id'));
        //Formateo las fechas
        $start_date =  date("d/m/Y", strtotime($task->start_date));
        $end_date =    date("d/m/Y", strtotime($task->end_date));
        $due_date =    date("d/m/Y", strtotime($task->due_date));
        
        if ( $due_date =='01/01/1970'){
            $due_date=null;
        }
        
        //$task->load('tags', 'status', 'location', 'asset', 'asset_status', 'period', 'incidence_category', 'incidence_subcategory', 'assigned_to', 'record', 'job','start_date','due_date','end_date');
        return view('dnota/EditarActuacionesPendientes', compact('tags', 'statuses', 'locations', 'assets', 'asset_statuses', 'periods', 'incidence_categories', 'incidence_subcategories', 'assigned_tos', 'records', 'jobs', 'task', 'start_date', 'end_date', 'due_date'));
    }






    public function ActualizarActuacionPendiente(UpdateTaskRequest $request)
    {
        $tipo = DB::table('task_task_tag')->where('task_id', $request->id)->pluck('task_tag_id');;
        $diasTipo = 0;
        // Calibracion
        if ($tipo[0] == 2) {
            $diasTipo = 1;
        }

        // Mantenimiento
        if ($tipo[0] == 1) {
            $diasTipo = 2;
        }

        // Verificación
        if ($tipo[0] == 7) {
            $diasTipo = 3;
        }

        if (($request->period_id != 1) && ($request->status_id == 3)) {
            //creo la siguiente
            $task =  new Task();
            $task->asset_status_id = $request->asset_status_id;
            $task->location_id = $request->location_id;
            $task->asset_id = $request->asset_id;
            $task->status_id = 1; // lo dejo abierto
           /* $task->incidence_category_id = $request->incidence_category_id;
            $task->incidence_subcategory_id = $request->incidence_subcategory_id;*/
            //se establece la categoría y subcategoría a 'N/A' por defecto 
            $task->incidence_category_id = 9;
            $task->incidence_subcategory_id = 29;
            //$task->description = $request->description;
            $task->description = null;
            $task->due_date = null;
            $task->start_date = null;

            //Semanal  SOLO TIENE LAS VERIFICACIONES
            if ($request->period_id == 2) {
                $dateI = str_replace("/", "-", $request->start_date);
                $dateI = date("d/m/Y", strtotime($dateI . "+7 days"));
                $task->start_date = $dateI;
                $dateF = str_replace("/", "-", $request->start_date);
                $dateF = date("d/m/Y", strtotime($dateF . "+13 days"));
                $task->end_date = $dateF;
            }

            //Quincenal  (2 semanas) MANTENIMIENTOS Y VERIFICACIONESqq
            if ($request->period_id == 3) {
                //Mantenimiento
                if ($diasTipo == 2) {
                    //inicio
                    $dateI = str_replace("/", "-", $request->start_date);
                    $dateI = date("d/m/Y", strtotime($dateI .  "+4 week"));
                    $task->start_date = $dateI;
                    //fin
                    $dateF = str_replace("/", "-", $request->start_date);
                    $dateF = date("d/m/Y", strtotime($dateF . "+41 days"));
                    $task->end_date = $dateF;
                }
                //verificacion
                if ($diasTipo == 3) {
                    //inicio
                    $dateI = str_replace("/", "-", $request->start_date);
                    $dateI = date("d/m/Y", strtotime($dateI . "+14 days"));
                    $task->start_date = $dateI;
                    //fin
                    $dateF = str_replace("/", "-", $request->start_date);
                    $dateF = date("d/m/Y", strtotime($dateF . "+27 days"));
                    $task->end_date = $dateF;
                }
            }

            //Mensual A SOLO MANTENIMIENTOS
            if ($request->period_id == 4) {
                //inicio
                $start_date = str_replace("/", "-", $request->start_date);
                $dateI = date("d/m/Y", strtotime($start_date . "+4 week"));
                $task->start_date = $dateI;
                //fin
                $due_date = str_replace("/", "-", $request->start_date);
                $dateF = date("d/m/Y", strtotime($due_date . "+41 days"));
                $task->end_date = $dateF;
            }

            //Trimestral MANTENIMIENTOS VERIFICACIONES Y CALIBRACIONES
            if ($request->period_id == 5) {
                //fecha inicio es igual para las 3
                $dateI = str_replace("/", "-", $request->due_date);
                $dateI = date("d/m/Y", strtotime($dateI . "+3 month"));
                $task->start_date =  $dateI;

                //calibracion

                if ($diasTipo == 1) {

                    $dateF = str_replace("/", "-", $request->due_date);
                    $dateF = date("d/m/Y", strtotime($dateF . "+3 month + 3 days"));
                    // Mantenimiento
                }

                if ($diasTipo == 2) {
                    $dateF = str_replace("/", "-", $request->due_date);
                    $dateF = date("d/m/Y", strtotime($dateF . "+3 month + 7 days"));
                    //verificacion
                }

                if ($diasTipo == 3) {
                    $dateF = str_replace("/", "-", $request->due_date);
                    $dateF = date("d/m/Y", strtotime($dateF . "+3 month + 7 days"));
                }
                $task->end_date = $dateF;
            }

            //Semestral MANTENIMIENTOS2 Y VERIFICACIONES3
            if ($request->period_id == 6) {
                $dateI = str_replace("/", "-", $request->due_date);
                $dateI = date("d/m/Y", strtotime($dateI . "+6 month"));
                $task->start_date = $dateI;
                // Mantenimiento

                if ($diasTipo == 2) {
                    $dateF = str_replace("/", "-", $request->due_date);
                    $dateF = date("d/m/Y", strtotime($dateF . "+6 month + 7 days"));
                }
                //verificacion
                if ($diasTipo == 3) {
                    $dateF = str_replace("/", "-", $request->due_date);
                    $dateF = date("d/m/Y", strtotime($dateF . "+6 month + 7 days"));
                }
                $task->end_date = $dateF;
            }

            //Anual  CALIBRACION Y MANTENIMIENTO
            if ($request->period_id == 7) {
                $dateI = str_replace("/", "-", $request->due_date);
                $dateI = date("d/m/Y", strtotime($dateI . "+1 year"));
                $task->start_date = $dateI;
                //Calibraciones
                if ($diasTipo == 1) {
                    $dateF = str_replace("/", "-", $request->due_date);
                    $dateF = date("d/m/Y", strtotime($dateF . "+12 month + 3 days"));
                }
                //Mantenimiento
                if ($diasTipo == 2) {
                    $dateF = str_replace("/", "-", $request->due_date);
                    $dateF = date("d/m/Y", strtotime($dateF . "+12 month + 7 days"));
                }

                $task->end_date = $dateF;
            }


            //Trienal solo CALIBRACIONES
            if ($request->period_id == 8) {
                $dateI = str_replace("/", "-", $request->due_date);
                $dateI = date("d/m/Y", strtotime($dateI . "+3 year"));
                $task->start_date = $dateI;
                $dateF = str_replace("/", "-", $request->due_date);
                $dateF = date("d/m/Y", strtotime($dateF . "+3 year + 3 days"));
                $task->end_date = $dateF;
            }


            //Bienal-ENAC solo CALIBRACIONES
            if ($request->period_id == 9) {
                $dateI = str_replace("/", "-", $request->due_date);-
                $dateI = date("d/m/Y", strtotime($dateI . "+2 year"));
                $task->start_date = $dateI;
                $dateF = str_replace("/", "-", $request->due_date);
                $dateF = date("d/m/Y", strtotime($dateF . "+2 year + 3 days"));
                $task->end_date = $dateF;
            }

            //Mensual B solo MANTENIMIENTOS
            if ($request->period_id == 10) {
                $dateI = str_replace("/", "-", $request->due_date);
                $dateI = date("d/m/Y", strtotime($dateI . "+1 month"));
                $task->start_date = $dateI;
                $dateF = str_replace("/", "-", $request->due_date);
                $dateF = date("d/m/Y", strtotime($dateF . "+1 month +7 days"));
                $task->end_date = $dateF;
            }


            $task->period_id = $request->period_id;
            $task->lost_data = $request->lost_data;
            $task->assigned_to_id = $request->assigned_to_id;
            $task->record_id = $request->record_id;
            $task->job_id = $request->job_id;
            $task->save();

            // Se graba la relacion de la tabla task_tag_tag
            //$task->tags()->sync($request->tags);
            DB::table('task_task_tag')->insert(['task_id' => $task->id, 'task_tag_id' => $request->tags[0]]);
            //la cierro
            $task = Task::find($request->id);
            $tagid = DB::table('task_task_tag')->where('task_id', $request->id)->get();
            $task->update($request->all());


            /* Actualizo la url
            Esto cuando se cierra
            - Verificaciones
            - Mantenimiento
             CM06142021_M_2021 (mantenimientos)
             CM06142021_C_2021 (calibraciones/verificaciones)*/

            if (($tagid[0]->task_tag_id == 1) || ($tagid[0]->task_tag_id == 2) || ($tagid[0]->task_tag_id == 7)) {
                $asset = Asset::find($request->asset_id);
                if ($request->tags[0] == 1) {
                    $task->link = "https://aiccm.sharepoint.com/:x:/r/sites/ACA/SGC%20Red%20Calidad%20del%20Aire/URL%20CORTAS/1.4.1.%20ORIGINALES/MyC%20" . date("Y") . "/Mantenimientos/" . $asset->name . "_M_" . date("Y") . ".xlsx"; // url sharepoint
                } else {
                    $task->link = "https://aiccm.sharepoint.com/:x:/r/sites/ACA/SGC%20Red%20Calidad%20del%20Aire/URL%20CORTAS/1.4.1.%20ORIGINALES/MyC%20" . date("Y") . "/Calibraciones/" . $asset->name . "_C_" . date("Y") . ".xlsx"; // url sharepoint

                }
            } else {
                $task->link = "";
            }

            $task->save();
            $assets = Asset::all();

            if ($request->input('tags')[0] == 2) {

                $events = Asset::select(
                    'assets.id as id',
                    'assets.name as asset',
                    'asset_categories.name as type',
                    'asset_sub_categories.asset_subcategory as subtype'
                )
                    ->join('asset_categories', 'assets.category_id', '=', 'asset_categories.id')
                    ->join('asset_sub_categories', 'assets.subcategory_id', '=', 'asset_sub_categories.id')
                    ->get();
                return view('dnota/Patrones', ['id' => $request->id, 'events' => $events, 'idActuacion' => $task->id]);
            }
        } else {
            // si no,  actualiza [ver que cosas no se van a permitir editar]
            $task = Task::find($request->id);
            $task->update($request->all());
        }

        return redirect('dnota/ActuacionesPendientes')->with('estacion', $task->location_id);
    }








    public function GrabaPatrones(Request $request)
    {
        //patron1

        if (request('patron1') != "-") {
            $task = Task::find($request->input('id'));
            $record1 = new Record;
            $record1->actuacion_id = $request->input('idActuacion');
            $record1->description = Asset::find(request('patron1'))->name;
            $record1->type = "";
            $record1->save();
            // grabar en la tabla auxiliar la relacion id de la tabla record y la tabla task
            DB::insert('insert into record_task (task_id,record_id) values (?, ?)', [$request->input('id'), $record1->id]);
        }

        //patron2
        if (request('patron2') != "-") {

            $record2 = new Record;
            $record2->actuacion_id = $request->input('idActuacion');
            $record2->description = Asset::find(request('patron2'))->name;
            $record2->type = "";
            $record2->save();
            // grabar en la tabla auxiliar la relacion id de la tabla record y la tabla task
            DB::insert('insert into record_task (task_id,record_id) values (?, ?)', [$request->input('id'), $record2->id]);
        }
        //patron3

        if (request('patron3') != "-") {
            $record3 = new Record;
            $record3->actuacion_id = $request->input('idActuacion');
            $record3->description = Asset::find(request('patron3'))->name;
            $record3->type = "";
            $record3->save();
            // grabar en la tabla auxiliar la relacion id de la tabla record y la tabla task
            DB::insert('insert into record_task (task_id,record_id) values (?, ?)', [$request->input('id'), $record3->id]);
        }

        //patron4
        if (request('patron4') != "-") {
            $record4 = new Record;
            $record4->actuacion_id = $request->input('idActuacion');
            $record4->description = Asset::find(request('patron4'))->name;
            $record4->type = "";
            $record4->save();
            // grabar en la tabla auxiliar la relacion id de la tabla record y la tabla task
            DB::insert('insert into record_task (task_id,record_id) values (?, ?)', [$request->input('id'), $record4->id]);
        }

        //patron5
        if (request('patron5') != "-") {
            $record5 = new Record;
            $record5->actuacion_id = $request->input('idActuacion');
            $record5->description = Asset::find(request('patron5'))->name;
            $record5->type = "";
            $record5->save();
            // grabar en la tabla auxiliar la relacion id de la tabla record y la tabla task
            DB::insert('insert into record_task (task_id,record_id) values (?, ?)', [$request->input('id'), $record5->id]);
        }
        $taskTag = TaskTag::all();
        $taskStatus = TaskStatus::all();
        $assets_location = AssetLocation::all();

        return view('dnota/ActuacionesPendientes', ['taskStatus' => $taskStatus, 'taskTag' => $taskTag, 'assets' => $assets_location]);
    }

    // RVR Fase 2 polimorfica
    public function Registros(Request $request)
    {

        $id = $request->input('id');
        $tarea = Task::find($id);
        $equipo = Asset::find($tarea->asset_id);
        return view('dnota/Registros', ['id' => $id, 'nombreEquipo' => $equipo->name]);
    }





    public function RegistroeDatatable(Request $request)
    {

        $record = Record::select(
            'records.id as id',
            'records.description as description'
        )
            ->join('record_task', 'records.id', '=', 'record_task.record_id')
            ->join('tasks', 'tasks.id', '=', 'record_task.task_id')
            ->join('assets', 'assets.id', '=', 'tasks.asset_id')
            ->where('tasks.id', $request->input('id'))
            ->where('records.actuacion_id', $request->input('id'))
            ->get();
        return Datatables::of($record)->make(true);
    }




    public function eliminarActuacionesPorEquipo(Request $request)
    {
        Task::destroy($request->input('id'));
        return redirect('dnota/ActuacionesPendientes')->with('localidad', $request->input('provincia'));
    }




    public function editarActuacionesPorEquipo(Request $request)
    {
        //  abort_if(Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tags = TaskTag::all()->pluck('name', 'id');
        $statuses = TaskStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $locations = AssetLocation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $asset_statuses = AssetStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $periods = Period::all()->pluck('period', 'id')->prepend(trans('global.pleaseSelect'), '');
        $incidence_categories = IncidencesCategory::all()->pluck('incidence_category', 'id')->prepend(trans('global.pleaseSelect'), '');
        $incidence_subcategories = IncidencesSubcategory::all()->pluck('incidence_subcategory', 'id')->prepend(trans('global.pleaseSelect'), '');
        $assigned_tos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $records = Record::all()->pluck('record', 'id')->prepend(trans('global.pleaseSelect'), '');
        $jobs = Job::all()->pluck('idjob', 'id')->prepend(trans('global.pleaseSelect'), '');
        $task = Task::find($request->input('id'));
        return view('dnota/editarActuacion', compact('tags', 'statuses', 'locations', 'assets', 'asset_statuses', 'periods', 'incidence_categories', 'incidence_subcategories', 'assigned_tos', 'records', 'jobs', 'task'));
    }






    public function ActualizarActuacionesPorEquipo(UpdateTaskRequest $request, Task $task)
    {
        $task = Task::find($request->id);
        $task->update($request->all());
        return redirect('dnota/ActuacionesPendientes')->with('localidad', $task->location_id);
    }




    public function CrearAccion()
    {
        $tags = TaskTag::all();
        $statuses = TaskStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $locations = AssetLocation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $asset_statuses = AssetStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $periods = Period::all()->pluck('period', 'id')->prepend(trans('global.pleaseSelect'), '');
        $incidence_categories = IncidencesCategory::all()->pluck('incidence_category', 'id')->prepend(trans('global.pleaseSelect'), '');
        $incidence_subcategories = IncidencesSubcategory::where('incidence_subcategory', 'not like', '%Otros%')->pluck('incidence_subcategory', 'id')->prepend(trans('global.pleaseSelect'), '');
        $assigned_tos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $records = Record::all()->pluck('record', 'id')->prepend(trans('global.pleaseSelect'), '');
        $jobs = Job::all()->pluck('record', 'id'); //->prepend(trans('global.pleaseSelect'), '');
        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('dnota/CrearAccion', compact('tags', 'statuses', 'locations', 'assets', 'asset_statuses', 'periods', 'incidence_categories', 'incidence_subcategories', 'assigned_tos', 'records', 'jobs', 'users'));
    }


    public function BuscaEquipos(Request $request)
    {
        $array[] = array();
        if ($request->input('type') == 5) {
            // taller dnota cuando es instalacion
            $events = Asset::select(
                'assets.id as id',
                'assets.name as asset',
                'asset_categories.name as type',
                'asset_sub_categories.asset_subcategory as subtype'
            )
                ->join('asset_categories', 'assets.category_id', '=', 'asset_categories.id')
                ->join('asset_sub_categories', 'assets.subcategory_id', '=', 'asset_sub_categories.id')
                ->where('location_id', 28)
                ->get();
        } else {
            $events = Asset::select(
                'assets.id as id',
                'assets.name as asset',
                'asset_categories.name as type',
                'asset_sub_categories.asset_subcategory as subtype'
            )
                ->join('asset_categories', 'assets.category_id', '=', 'asset_categories.id')
                ->join('asset_sub_categories', 'assets.subcategory_id', '=', 'asset_sub_categories.id')
                ->where('location_id', $request->input('id'))
                ->get();
        }

        return response()->json($events);
    }

    public function BuscaSubincidencia(Request $request)
    {

        $events = IncidencesSubcategory::select(
            'incidences_subcategories.id as id',
            'incidences_subcategories.incidence_subcategory as subcategory'
        )
            ->where('incidence_category_id', $request->input('id'))
            ->get();


        return response()->json($events);
    }


    public function GrabaAccion(StoreTaskRequest $request)
    {
        
        //Retirada
        if ($request->tags[0] == 4) {
            // busco y actualizo el ultimo sitio donde ha estado y le pongo fecha fin la misma que inicio de taller
            $stardate = date('Y-m-d', strtotime(str_replace('/', '-', $request->start_date)));
            AssetsHistory::where('asset_id', $request->asset_id)
                ->where('end_date', null)
                ->update(['end_date' => $stardate]);

            // Se actualizan todas las incidencias (tasks) que tengan el mismo asset_id a la location 28 menos la de retirada
            // y que esten cerrdas

            Task::where('asset_id', $request->asset_id)
            ->whereIn('status_id', [1, 2])
            ->update(['location_id' => 28]);
        
            // se actualiza el asett en la location 28
            Asset::where('id', $request->asset_id)               
            ->update(['location_id' => 28]);   
      
            // Se crea una nueva tarea que es retirada
            $task = new Task;
            $task->status_id = $request->status_id;
            $task->location_id = $request->location_id;
            $task->asset_id = $request->asset_id;
            $task->asset_status_id = $request->asset_status_id;
            $task->period_id = $request->period_id;
            $task->incidence_category_id = $request->incidence_category_id;
            $task->incidence_subcategory_id = $request->incidence_subcategory_id;
            $task->description = $request->description;
            $task->start_date = $request->start_date;
            $task->due_date = $request->end_date;
            $task->end_date = $request->end_date;
            $task->lost_data = $request->lost_data;
            $task->assigned_to_id = $request->assigned_to_id;
            $task->link = $request->link;
            $task->record_id = $request->record_id;
            $task->job_id = $request->job_id;            
            $task->save();

            // Se graba la relacion de la tabla task_tag_tag
            //$task->tags()->sync($request->tags);
            DB::table('task_task_tag')->insert(['task_id' => $task->id, 'task_tag_id' => $request->tags[0]]);

            //Graba en historicos el movimento del equipo
            $assetHistory =  new AssetsHistory();
            //Inicio fin el mismo dia y al ser obligatorio el fin lo dejamos ahi
            $assetHistory->start_date = $request->start_date;
            $assetHistory->end_date =  null;
            $assetHistory->asset_id = $request->asset_id;
            $assetHistory->status_id = $request->asset_status_id;
            $assetHistory->location_id = 28;
            $assetHistory->assigned_user_id = $request->assigned_to_id;
            $assetHistory->save();

            $taskTag = TaskTag::all();
            $taskStatus = TaskStatus::all();
            $assets_location = AssetLocation::all();
            return view('dnota/ActuacionesPendientes', ['taskStatus' => $taskStatus, 'taskTag' => $taskTag, 'assets' => $assets_location]);
        }
        //Instalación
        if ($request->tags[0] == 5) {

            // buscar en el asset History la fecha de ese id ultima y añadimos le fecha de incio
            $stardate = date('Y-m-d', strtotime(str_replace('/', '-', $request->start_date)));
            AssetsHistory::where('asset_id', $request->asset_id)
                ->where('end_date', null)
                ->update(['end_date' => $stardate]);


            // Aqui se crea la tarea de Instalación ASET LO PILLA MAL
            $task = new Task;
            $task->status_id = $request->status_id;
            $task->location_id = $request->location_id;
            $task->asset_id = $request->asset_id;
            $task->asset_status_id = $request->asset_status_id;
            $task->period_id = $request->period_id;
            $task->incidence_category_id = $request->incidence_category_id;
            $task->incidence_subcategory_id = $request->incidence_subcategory_id;
            $task->description = $request->description;
            $task->start_date = $request->start_date;
            $task->due_date = $request->end_date;
            $task->end_date = $request->end_date;
            $task->lost_data = $request->lost_data;
            $task->assigned_to_id = $request->assigned_to_id;
            $task->link = $request->link;
            $task->record_id = $request->record_id;
            $task->job_id = $request->job_id;
            $task->save();

            // Se graba la relacion de la tabla task_tag_tag
            //$task->tags()->sync($request->tags);
            DB::table('task_task_tag')->insert(['task_id' => $task->id, 'task_tag_id' => $request->tags[0]]);
            // Se actualizan todas las incidencias (tasks) que tengan el mismo asset_id a la location 28
            Task::where('asset_id', $request->asset_id)
                ->whereIn('status_id', [1, 2])
                ->update(['location_id' => $request->location_id]);
            // se actualiza el asett en la location 28
            $asset = Asset::find($request->asset_id);
            $asset->location_id = $request->location_id;
            $asset->save();

            //Creo un nuevo
            $assetHistory = new AssetsHistory;
            $assetHistory->start_date =  $request->start_date;
            $assetHistory->end_date = null;
            $assetHistory->asset_id = $request->asset_id;
            $assetHistory->status_id = $request->asset_status_id;
            $assetHistory->location_id = $request->location_id;
            $assetHistory->assigned_user_id = $request->assigned_to_id;
            $assetHistory->save();
            $taskTag = TaskTag::all();
            $taskStatus = TaskStatus::all();
            $assets_location = AssetLocation::all();
            return view('dnota/ActuacionesPendientes', ['taskStatus' => $taskStatus, 'taskTag' => $taskTag, 'assets' => $assets_location]);
        }

        //Incidencia u Otras

        // se crea la tarea

        $task = Task::create($request->all());
        //print_r($task);

    

        //actualiza tsk_tag_tag
        DB::table('task_task_tag')->insert(['task_id' => $task->id, 'task_tag_id' => $request->tags[0]]);
        $taskTag = TaskTag::all();
        $taskStatus = TaskStatus::all();
        $assets_location = AssetLocation::all();
        return view('dnota/ActuacionesPendientes', ['taskStatus' => $taskStatus, 'taskTag' => $taskTag, 'assets' => $assets_location]);
    }







    public function ActuacionesPorEquipoBack(Request $request)
    {
        $taskTag = TaskTag::all();
        $taskStatus = TaskStatus::all();
        $assetsAll = Asset::all();
        $assets = Asset::where('name', $request->input('id'))->get();
        return view('dnota/ActuacionesPorEquipo', ['taskStatus' => $taskStatus, 'taskTag' => $taskTag, 'assets' => $assetsAll, 'asset_id' => $assets[0]->id, 'asset_name' => $request->input('id')]);
    }



    public function ActualizarRegistro(Request $request)
    {

        $data = Record::find($request->input('id'));
        $data->url = $request->input('url');
        $data->save();
        $idAsset = $request->input('idAsset');
        $nombreAsset = Asset::find($request->input('idAsset'))->name;
        // RVR cambiar a polimorfica
        /*    if (count($asset->photos) > 0) {
        foreach ($asset->photos as $media) {
            if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }

        $media = $asset->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $asset->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
            }
        }*/
        return view('dnota/Registros', ['id' => $idAsset, 'nombreEquipo' => $nombreAsset]);
    }

    //Actuaciones Por Equipo
    public function ActuacionesPorEquipo()
    {
        // $taskTag = TaskTag::where('id', '!=', 3)->get();
        $taskTag = TaskTag::all();
        $taskStatus = TaskStatus::all();
        $assets = Asset::all();       
        return view('dnota/ActuacionesPorEquipo', ['taskStatus' => $taskStatus, 'taskTag' => $taskTag, 'assets' => $assets]);

    }

    public function ActuacionesPorEquipoDetalle(Request $request)
    {

        // Equipo RVR
        //if ($request->input('tarea') != 8) {
        if ($request->input('tarea') != 0) {
            $tarea[] = $request->input('tarea');
        } else {
        
            $t_tareas = TaskTag::all()->pluck('id');
            for ($i = 0; $i < count($t_tareas); $i++) {
                $tarea[]=$t_tareas[$i]; 
            }
            
        }
        $estado = [2, 3];  
        
        if (is_null($request->input('fechaInicio'))) {
            $inicio = date('Y-m-d', strtotime('-1 years'));         
        } else {
            $inicio = $request->input('fechaInicio');
        }

        if (is_null($request->input('fechaFin'))) {
            $fin = date('Y-m-d', strtotime('+1 years'));            
        } else {
            $fin = $request->input('fechaFin');
        }


        if ($request->input('equipo') != '#') {
            $idequipo = $request->input('equipo');
 
            $tasks_mc = Task::select(
                'tasks.id as id',
                'task_tags.name as taskname',
                'tasks.asset_id as aset',
                'incidences_categories.incidence_category as category',
                'incidences_subcategories.incidence_subcategory as subcategory',
                'tasks.lost_data as lost_data',
                'periods.period as period',
                'tasks.start_date as start_date',
                'tasks.end_date as end_date',
                'tasks.due_date as due_date',
                'task_statuses.name as status',
                'tasks.description as description',
                'asset_locations.name as estacion',
                'users.name as users',
                'tasks.link as links',
                'assets.name as nameaset'
            )
                ->join('assets', 'tasks.asset_id', '=', 'assets.id')
                ->join('users', 'tasks.assigned_to_id', '=', 'users.id')
                ->join('task_task_tag', 'task_task_tag.task_id', '=', 'tasks.id')
                ->join('task_tags', 'task_tags.id', '=', 'task_task_tag.task_tag_id')
                ->leftjoin('incidences_categories', 'tasks.incidence_category_id', '=', 'incidences_categories.id')
                ->leftjoin('incidences_subcategories', 'tasks.incidence_subcategory_id', '=', 'incidences_subcategories.id')
                ->join('periods', 'tasks.period_id', '=', 'periods.id')
                ->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')
                ->join('asset_locations', 'tasks.location_id', '=', 'asset_locations.id')
                ->whereIn('task_tags.id', $tarea)
                ->whereIn('tasks.status_id', $estado)
                //->where('tasks.start_date', '>=', $inicio)
                ->where('tasks.due_date', '>=', $inicio)
                ->where('tasks.due_date', '<=', $fin)
                ->where('tasks.asset_id', $idequipo);

            $tasks_i = Task::select(
                'tasks.id as id',
                'task_tags.name as taskname',
                'tasks.asset_id as aset',
                'incidences_categories.incidence_category as category',
                'incidences_subcategories.incidence_subcategory as subcategory',
                'tasks.lost_data as lost_data',
                'periods.period as period',
                'tasks.start_date as start_date',
                'tasks.end_date as end_date',
                'tasks.due_date as due_date',
                'task_statuses.name as status',
                'tasks.description as description',
                'asset_locations.name as estacion',
                'users.name as users',
                'tasks.link as link',
                'assets.name as nameaset'
            )
                ->join('assets', 'tasks.asset_id', '=', 'assets.id')
                ->join('users', 'tasks.assigned_to_id', '=', 'users.id')
                ->join('task_task_tag', 'task_task_tag.task_id', '=', 'tasks.id')
                ->join('task_tags', 'task_tags.id', '=', 'task_task_tag.task_tag_id')
                ->leftjoin('incidences_categories', 'tasks.incidence_category_id', '=', 'incidences_categories.id')
                ->leftjoin('incidences_subcategories', 'tasks.incidence_subcategory_id', '=', 'incidences_subcategories.id')
                ->join('periods', 'tasks.period_id', '=', 'periods.id')
                ->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')
                ->join('asset_locations', 'tasks.location_id', '=', 'asset_locations.id')
                ->whereIn('task_tags.id', $tarea)
                ->whereIn('tasks.status_id', $estado)
               //->where('tasks.start_date', '>=', $inicio)
                ->where('tasks.due_date', '>=', $inicio)
                ->where('tasks.due_date', '<=', $fin)
                ->where('tasks.asset_id', $idequipo)

                ->union($tasks_mc)
                ->get();
            $tasks_h = $tasks_i;
        } else {
            //todos

            $tasks_mc = Task::select(
                'tasks.id as id',
                'task_tags.name as taskname',
                'tasks.asset_id as aset',
                'incidences_categories.incidence_category as category',
                'incidences_subcategories.incidence_subcategory as subcategory',
                'tasks.lost_data as lost_data',
                'periods.period as period',
                'tasks.start_date as start_date',
                'tasks.end_date as end_date',
                'tasks.due_date as due_date',
                'task_statuses.name as status',
                'tasks.description as description',
                'asset_locations.name as estacion',
                'users.name as users',
                'tasks.link as links',
                'assets.name as nameaset'
            )
                ->join('assets', 'tasks.asset_id', '=', 'assets.id')
                ->join('users', 'tasks.assigned_to_id', '=', 'users.id')
                ->join('task_task_tag', 'task_task_tag.task_id', '=', 'tasks.id')
                ->join('task_tags', 'task_tags.id', '=', 'task_task_tag.task_tag_id')
                ->leftjoin('incidences_categories', 'tasks.incidence_category_id', '=', 'incidences_categories.id')
                ->leftjoin('incidences_subcategories', 'tasks.incidence_subcategory_id', '=', 'incidences_subcategories.id')
                ->join('periods', 'tasks.period_id', '=', 'periods.id')
                ->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')
                ->join('asset_locations', 'tasks.location_id', '=', 'asset_locations.id')
                ->whereNull('tasks.incidence_category_id')
                ->whereNull('tasks.incidence_subcategory_id')
                ->whereIn('tasks.status_id', $estado)
                ->whereIn('task_tags.id', $tarea)
                //->where('tasks.start_date', '>=', $inicio)
                ->where('tasks.due_date', '>=', $inicio)
                ->where('tasks.due_date', '<=', $fin);
               

            $tasks_i = Task::select(
                'tasks.id as id',
                'task_tags.name as taskname',
                'tasks.asset_id as aset',
                'incidences_categories.incidence_category as category',
                'incidences_subcategories.incidence_subcategory as subcategory',
                'tasks.lost_data as lost_data',
                'periods.period as period',
                'tasks.start_date as start_date',
                'tasks.end_date as end_date',
                'tasks.due_date as due_date',
                'task_statuses.name as status',
                'tasks.description as description',
                'asset_locations.name as estacion',
                'users.name as users',
                'tasks.link as link',
                'assets.name as nameaset'
            )
                ->join('assets', 'tasks.asset_id', '=', 'assets.id')
                ->join('users', 'tasks.assigned_to_id', '=', 'users.id')
                ->join('task_task_tag', 'task_task_tag.task_id', '=', 'tasks.id')
                ->join('task_tags', 'task_tags.id', '=', 'task_task_tag.task_tag_id')
                ->leftjoin('incidences_categories', 'tasks.incidence_category_id', '=', 'incidences_categories.id')
                ->leftjoin('incidences_subcategories', 'tasks.incidence_subcategory_id', '=', 'incidences_subcategories.id')
                ->join('periods', 'tasks.period_id', '=', 'periods.id')
                ->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')
                ->join('asset_locations', 'tasks.location_id', '=', 'asset_locations.id')
                ->whereNotNull('tasks.incidence_category_id')
                ->whereNotNull('tasks.incidence_subcategory_id')
                ->whereIn('tasks.status_id', $estado)
                ->whereIn('task_tags.id', $tarea)
                //->where('tasks.start_date', '>=', $inicio)
                ->where('tasks.due_date', '>=', $inicio)
                ->where('tasks.due_date', '<=', $fin)
                ->union($tasks_mc)
                ->get();
            $tasks_h = $tasks_i;
        }


        return Datatables::of($tasks_h)->make(true);
    }


    /////////////////////////////////////////////
    ///             EQUIPOS
    //////////////////////////////////////////////
    public function Equipos(Request $request)
    {
        $assetCat = AssetCategory::all();
        $assetSubCat = AssetSubCategory::all();
        return view('dnota/Equipos', ['assetCat' => $assetCat, 'assetSubCat' => $assetSubCat, 'id' => 1]);
    }


    public function EquiposDetalleDatatable(Request $request)
    {
        $activo = $request->input('activo');
        $subactivo = $request->input('subactivo');
        if ($subactivo == 100) {
            $assets = Asset::select(
                'assets.id as id',
                'assets.name as asset',
                'assets.serial_number',
                'asset_categories.name as type',
                'asset_sub_categories.asset_subcategory as subtype',
                'asset_statuses.name as status',
                'asset_locations.name as location',
                'marks.mark',
                'samples.sample',
                'assets.start_date',
                'assets.end_date',
                'assets.notes',
                'assets.regulations'
            )
                ->join('asset_categories', 'assets.category_id', '=', 'asset_categories.id')
                ->join('asset_sub_categories', 'assets.subcategory_id', '=', 'asset_sub_categories.id')
                ->join('asset_statuses', 'assets.status_id', '=', 'asset_statuses.id')
                ->join('asset_locations', 'assets.location_id', '=', 'asset_locations.id')
                ->join('marks', 'assets.mark_id', '=', 'marks.id')
                ->join('samples', 'assets.sample_id', '=', 'samples.id')
                ->distinct()
                ->get();
        } else {
            $activo = [$activo];
            $subactivo = [$subactivo];
            $assets = Asset::select(
                'assets.id as id',
                'assets.name as asset',
                'assets.serial_number',
                'asset_categories.name as type',
                'asset_sub_categories.asset_subcategory as subtype',
                'asset_statuses.name as status',
                'asset_locations.name as location',
                'marks.mark',
                'samples.sample',
                'assets.start_date',
                'assets.end_date',
                'assets.notes',
                'assets.regulations'
            )
                ->join('asset_categories', 'assets.category_id', '=', 'asset_categories.id')
                ->join('asset_sub_categories', 'assets.subcategory_id', '=', 'asset_sub_categories.id')
                ->join('asset_statuses', 'assets.status_id', '=', 'asset_statuses.id')
                ->join('asset_locations', 'assets.location_id', '=', 'asset_locations.id')
                ->join('marks', 'assets.mark_id', '=', 'marks.id')
                ->join('samples', 'assets.sample_id', '=', 'samples.id')
                ->where('assets.category_id', $activo)
                ->where('assets.subcategory_id', $subactivo)
                ->distinct()
                ->get();
        }


        return Datatables::of($assets)->make(true);
    }



    public function SubCategorias(Request $request)
    {
        if ($request->input('id') == 10) {
            $events = AssetSubCategory::all();
        } else {
            $events = AssetSubCategory::where('asset_category_id', $request->input('id'))->get();
        }

        return response()->json(['array' => $events]);
    }

    public function EquiposHistorico(Request $request)
    {
        $name = Asset::select('name')->where('id', $request->input('id'))->get();
        $id = $request->input('id');
        return view('dnota/EquiposHistorico', ['id' => $id, 'name' => $name[0]->name]);
    }



    public function EquipoHistorico(Request $request)
    {
        $assetH = AssetsHistory::select(
            'assets_histories.id as id',
            'assets.name as asset',
            'asset_locations.name as location',
            'assets_histories.start_date as start_date',
            'assets_histories.end_date as end_date',
            'asset_statuses.name as status',
            'users.name as user'
        )
            ->join('assets', 'assets_histories.asset_id', '=', 'assets.id')
            ->join('asset_statuses', 'assets_histories.status_id', '=', 'asset_statuses.id')
            ->join('asset_locations', 'assets_histories.location_id', '=', 'asset_locations.id')
            ->join('users', 'assets_histories.assigned_user_id', '=', 'users.id')
            ->where('assets.id', $request->input('id'))
            ->get();
        return Datatables::of($assetH)->make(true);
    }








    ////////////////////////////////////////////////7
    //          PLANIFICACION
    ///////////////////////////////////////////////
    public function Planificacion()
    {
        $y[] = [];
        $assetLocation = AssetLocation::all();
        $years = Task::select('start_date')
            ->orderBy('start_date', 'ASC')
            ->get();
        foreach ($years as $yearsRaw) {
            if (!empty($yearsRaw["start_date"])) {
                $y[] = date('Y', strtotime($yearsRaw["start_date"]));
            }
        }
        return view('dnota/Planificacion', ['assetLocation' => $assetLocation, 'years' => 2020]);
    }


    public function PlanificacionCalendario(Request $request)
    {
        $array[] = array();
        $year = $request->input('year');
        $month = $request->input('month');
        $location = $request->input('location_id');

        //   $events=Task::all();
        $events = Task::select(
            'tasks.id as id',
            'tasks.status_id as status_id',
            'assets.name as name',
            'task_tags.name as type',
            'periods.period as period',
            'tasks.start_date as start_date',
            'tasks.end_date as end_date',
            'tasks.due_date as due_date'
        )
            ->join('periods', 'tasks.period_id', '=', 'periods.id')
            ->join('assets', 'tasks.asset_id', '=', 'assets.id')
            ->join('task_task_tag', 'task_task_tag.task_id', '=', 'tasks.id')
            ->join('task_tags', 'task_tags.id', '=', 'task_task_tag.task_tag_id')
            ->where('tasks.location_id', $location)
            ->whereYear('tasks.start_date','=', $year)
            ->whereMonth('tasks.start_date','=', $month)
            ->distinct()
            ->get();

        $i = 0;
        foreach ($events as $event) {
            //Abierta
            if ($event->status_id == 1) {
                $array[$i] = array(
                    "name" => $event->name . "||" . $event->type . "||" . $event->period . "||" .$event->id . "||",
                    "start" => date("Y-m-d", strtotime(str_replace('/', '-', $event->start_date))),
                    "id" => "editarTarea/" . $event->id,
                    "color" => "green"
                );
                $i++;
            }
            //En proceso
            if ($event->status_id == 2) {
                $array[$i] = array(
                    "name" => $event->name . "||" . $event->type . "||" . $event->period . "||" .$event->id . "||",
                    "start" => date("Y-m-d", strtotime(str_replace('/', '-', $event->start_date))),
                    "id" => "editarTarea/" . $event->id,
                    "color" => "#FFFF99"
                );
                $i++;
            }
            //Cerrada
            if ($event->status_id == 3) {
                $array[$i] = array(
                    "name" => $event->name . "||" . $event->type . "||" . $event->period . "||" .$event->id . "||",
                    "start" => date("Y-m-d", strtotime(str_replace('/', '-', $event->due_date))),
                    "id" => "editarTarea/" . $event->id,
                    "color" => "grey",
                );
                $i++;
            }
        }
        return response()->json(array('d' => $array, 'location_id' => $location));
    }


    public function editarTarea($id)
    {

            $tasks_mc = Task::select(
                'tasks.id as id',
                'task_tags.name as taskname',
                'assets.name as aset',
                'incidences_categories.incidence_category as category',
                'incidences_subcategories.incidence_subcategory as subcategory',
                'tasks.lost_data as lost_data',
                'periods.period as period',
                'tasks.start_date as start_date',
                'tasks.end_date as end_date',
                'task_statuses.name as status',
                'tasks.description as description',
                'asset_locations.name as estacion'
            )
                ->join('task_task_tag', 'task_task_tag.task_id', '=', 'tasks.id')
                ->join('task_tags', 'task_tags.id', '=', 'task_task_tag.task_tag_id')
                ->join('assets', 'assets.id', '=', 'tasks.asset_id')
                ->leftjoin('incidences_categories', 'tasks.incidence_category_id', '=', 'incidences_categories.id')
                ->leftjoin('incidences_subcategories', 'tasks.incidence_subcategory_id', '=', 'incidences_subcategories.id')
                ->join('periods', 'tasks.period_id', '=', 'periods.id')
                ->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')
                ->join('asset_locations', 'tasks.location_id', '=', 'asset_locations.id')
                ->whereNull('tasks.incidence_category_id')
                ->whereNull('tasks.incidence_subcategory_id')
                ->where('tasks.id', $id);
            
            $tasks_i = Task::select(
                'tasks.id as id',
                'task_tags.name as taskname',
                'assets.name as aset',
                'incidences_categories.incidence_category as category',
                'incidences_subcategories.incidence_subcategory as subcategory',
                'tasks.lost_data as lost_data',
                'periods.period as period',
                'tasks.start_date as start_date',
                'tasks.end_date as end_date',
                'task_statuses.name as status',
                'tasks.description as description',
                'asset_locations.name as estacion'
            )
                ->join('task_task_tag', 'task_task_tag.task_id', '=', 'tasks.id')
                ->join('task_tags', 'task_tags.id', '=', 'task_task_tag.task_tag_id')
                ->join('assets', 'assets.id', '=', 'tasks.asset_id')
                ->leftjoin('incidences_categories', 'tasks.incidence_category_id', '=', 'incidences_categories.id')
                ->leftjoin('incidences_subcategories', 'tasks.incidence_subcategory_id', '=', 'incidences_subcategories.id')
                ->join('periods', 'tasks.period_id', '=', 'periods.id')
                ->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')
                ->join('asset_locations', 'tasks.location_id', '=', 'asset_locations.id')
                ->whereNotNull('tasks.incidence_category_id')
                ->whereNotNull('tasks.incidence_subcategory_id')
                ->where('tasks.id', $id)
                ->union($tasks_mc)
                ->get();
            $tasks = $tasks_i;
           

        return view('dnota/Tarea', ['task' => $tasks]);
    }



    /*ADMINISTRACION*/

    public function AdminIndex()
    {
        return view('dnota/Admin');
    }


    public function Admin()
    {
        $usuarios = User::select('users.name', 'users.email', 'roles.title')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->get();

        return DataTables::of($usuarios)->make(true);
    }
}
