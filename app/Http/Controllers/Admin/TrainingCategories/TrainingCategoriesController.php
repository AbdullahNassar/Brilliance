<?php

namespace App\Http\Controllers\Admin\TrainingCategories;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\TrainingCategory\StoreTrainingCategoryRequest;
use App\Http\Requests\TrainingCategory\UpdateTrainingCategoryRequest;
use App\Helpers\TrainingCategoryHelper;
use App\TrainingCategory;
use App\TrainingCourse;
use Illuminate\Http\Request;

class TrainingCategoriesController extends MainController
{
    public $model = TrainingCategory::class;

    public function insert(StoreTrainingCategoryRequest $request){
        $category = TrainingCategoryHelper::addTrainingCategory($request);
        if($category)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateTrainingCategoryRequest $request){
        $id = $request->id;
        $category = TrainingCategoryHelper::editTrainingCategory($request,$id);
        if($category)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public static function index(){
        $categories = TrainingCategory::all();
        return view('admin.pages.training.categories.index.index', compact('categories'));
    }

    public static function add(){
        $categories = TrainingCategory::where('status',1)->get();
        return view('admin.pages.training.categories.add.index',compact('categories'));
    }

    public static function edit($id){
        $category = TrainingCategory::find($id);
        if($category)
        return view('admin.pages.training.categories.edit.index', compact('category'));
        else
        return redirect('/admin/trainingcategories');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$category = TrainingCategory::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        TrainingCategory::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
                'model' => class_basename(get_class(new $this->model))
            ])));
    }

    public function unpublish($id){
        TrainingCategory::where('id',$id)->update([
            'status' => 0,
        ]);
        TrainingCourse::where('category_id',$id)->update([
            'status' => 0,
        ]);
        return redirect()->back();
    }

    public function publish($id){
        TrainingCategory::where('id',$id)->update([
            'status' => 1,
        ]);
        TrainingCourse::where('category_id',$id)->update([
            'status' => 1,
        ]);
        return redirect()->back();
    }
}