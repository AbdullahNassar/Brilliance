<?php

namespace App\Http\Controllers\Admin\Halls;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Hall\StoreHallRequest;
use App\Http\Requests\Hall\UpdateHallRequest;
use App\Helpers\HallHelper;
use App\HallSchedule;
use App\Hall;
use Illuminate\Http\Request;

class HallsController extends MainController
{
    public $model = Hall::class;

    public function insert(StoreHallRequest $request){
        $hall = HallHelper::addHall($request);
        if($hall)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateHallRequest $request){
        $id = $request->id;
        $hall = HallHelper::editHall($request,$id);
        if($hall)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public static function index(){
        $halls = Hall::all();
        return view('admin.pages.halls.index.index', compact('halls'));
    }

    public static function schedule($id){
        $hall = Hall::find($id);
        if($hall)
        return view('admin.pages.halls.index.calendar', compact('hall'));
        else
        return redirect('/admin/halls');
    }

    public static function schedules(){
        $halls = HallSchedule::all();
        return view('admin.pages.halls.index.schedule', compact('halls'));
        //return view('admin.pages.schedule.index', compact('halls'));
    }

    public static function add(){
        return view('admin.pages.halls.add.index');
    }

    public static function edit($id){
        $hall = Hall::find($id);
        return view('admin.pages.halls.edit.index', compact('hall'));
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$hall = Hall::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        Hall::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
                'model' => class_basename(get_class(new $this->model))
            ])));
    }

    public function unpublish($id){
        Hall::where('id',$id)->update([
            'active' => 0,
        ]);
        return redirect()->back();
    }

    public function publish($id){
        Hall::where('id',$id)->update([
            'active' => 1,
        ]);
        return redirect()->back();
    }
}