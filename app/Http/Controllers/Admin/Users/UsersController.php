<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Helpers\UserHelper;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Auth;

class UsersController extends MainController
{
    public $model = User::class;

    public function insert(StoreUserRequest $request){
        $user = UserHelper::addUser($request);
        if($user)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateUserRequest $request){
        $id = $request->id;
        $user = UserHelper::editUser($request,$id);
        if($user)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public static function index(){
        $users = User::all();
        return view('admin.pages.users.index.index', compact('users'));
    }

    public static function add(){
        $roles = Role::where('name','!=','editor')->where('name','!=','guest')->get();
        return view('admin.pages.users.add.index', compact('roles'));
    }

    public static function edit($id){
        $user = User::find($id);
        $roles = Role::where('name','!=','editor')->where('name','!=','guest')->get();
        if($user)
        return view('admin.pages.users.edit.index', compact('user','roles'));
        else
        return redirect('/admin/users');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$user = ($this->model)::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        User::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
                'model' => class_basename(get_class(new $this->model))
            ])));
    }

    public static function students(){
        $users = User::where('role','=','student')->get();
        return view('admin.pages.users.index.index', compact('users'));
    }

    public static function doctors(){
        $users = User::where('role','=','doctor')->get();
        return view('admin.pages.users.index.index', compact('users'));
    }

    public static function operation(){
        $users = User::where('role','=','operation')->get();
        return view('admin.pages.users.index.index', compact('users'));
    }

    public static function finance(){
        $users = User::where('role','=','finance')->get();
        return view('admin.pages.users.index.index', compact('users'));
    }

    public static function sales(){
        $users = User::where('role','=','sales')->get();
        return view('admin.pages.users.index.index', compact('users'));
    }

    public static function marketing(){
        $users = User::where('role','=','marketing')->get();
        return view('admin.pages.users.index.index', compact('users'));
    }

    public static function corporate(){
        $users = User::where('role','=','corporate')->get();
        return view('admin.pages.users.index.index', compact('users'));
    }
}