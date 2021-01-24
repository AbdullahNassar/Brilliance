<?php

namespace App\Http\Controllers\Admin\Diploms;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Diplom\StoreDiplomRequest;
use App\Http\Requests\Diplom\UpdateDiplomRequest;
use App\Helpers\DiplomHelper;
use App\Diplom;
use App\University;
use App\DiplomCourse;
use App\DiplomIntake;
use Illuminate\Http\Request;

class DiplomsController extends MainController
{
    public $model = Diplom::class;

    public function insert(StoreDiplomRequest $request){
        $diplom = DiplomHelper::addDiplom($request);
        if($diplom)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateDiplomRequest $request){
        $id = $request->id;
        $diplom = DiplomHelper::editDiplom($request,$id);
        if($diplom)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public static function index(){
        $diploms = Diplom::all();
        return view('admin.pages.diploms.index.index', compact('diploms'));
    }

    public static function add(){
        $universities = University::where('active',1)->get();
        return view('admin.pages.diploms.add.index', compact('universities'));
    }

    public static function edit($id){
        $diplom = Diplom::find($id);
        $universities = University::where('active',1)->get();
        if($diplom)
        return view('admin.pages.diploms.edit.index', compact('diplom','universities'));
        else
        return redirect('/admin/diploms');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$Diplom = ($this->model)::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        Diplom::where('id',$id)->delete();
        DiplomCourse::where('diplom_id',$id)->delete();
        DiplomIntake::where('diplom_id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
                'model' => class_basename(get_class(new $this->model))
            ])));
    }
    
    public function unpublish($id){
        Diplom::where('id',$id)->update([
            'active' => 0,
        ]);
        DiplomCourse::where('diplom_id',$id)->update([
            'active' => 0,
        ]);
        DiplomIntake::where('diplom_id',$id)->update([
            'active' => 0,
        ]);
        return redirect()->back();
    }

    public function publish($id){
        Diplom::where('id',$id)->update([
            'active' => 1,
        ]);
        DiplomCourse::where('diplom_id',$id)->update([
            'active' => 1,
        ]);
        DiplomIntake::where('diplom_id',$id)->update([
            'active' => 1,
        ]);
        return redirect()->back();
    }


}