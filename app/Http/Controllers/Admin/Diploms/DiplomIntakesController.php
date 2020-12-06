<?php

namespace App\Http\Controllers\Admin\Diploms;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Diplom\StoreDiplomIntakeRequest;
use App\Http\Requests\Diplom\UpdateDiplomIntakeRequest;
use App\Helpers\DiplomHelper;
use App\DiplomIntake;
use App\Diplom;
use Illuminate\Http\Request;
use Carbon;

class DiplomIntakesController extends MainController
{
    public $model = DiplomIntake::class;

    public function insert(StoreDiplomIntakeRequest $request){
        $diplom = DiplomHelper::addDiplomIntake($request);
        if($diplom)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateDiplomIntakeRequest $request){
        $id = $request->id;
        $diplom = DiplomHelper::editDiplomIntake($request,$id);
        if($diplom)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public static function index(){
        $intakes = DiplomIntake::all();
        return view('admin.pages.diploms.intakes.index.index', compact('intakes'));
    }

    public static function add(){
        $diploms = Diplom::where('active',1)->get();
        $now = Carbon::now();
        return view('admin.pages.diploms.intakes.add.index',compact('diploms','now'));
    }

    public static function edit($id){
        $now = Carbon::now();
        $intake = DiplomIntake::find($id);
        $diploms = Diplom::where('active',1)->get();
        if($intake)
        return view('admin.pages.diploms.intakes.edit.index', compact('intake','diploms','now'));
        else
        return redirect('/admin/diplomintakes');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$diplom = ($this->model)::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        DiplomIntake::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
                'model' => class_basename(get_class(new $this->model))
            ])));
    }

    public function unpublish($id){
        DiplomIntake::where('id',$id)->update([
            'active' => 0,
        ]);
        return redirect()->back();
    }

    public function publish($id){
        DiplomIntake::where('id',$id)->update([
            'active' => 1,
        ]);
        return redirect()->back();
    }
}