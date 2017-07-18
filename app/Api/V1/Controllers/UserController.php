<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use Auth;
use Response;
use Hash;
use App\Models\User;
use App\Models\UsersInfo;
use App\Models\UsersWork;
use App\Models\UsersEdu;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    use Helpers;

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index(Request $request)
    {
        if($this->currentUser()){
            if(Auth::user()->hasRole(['super-admin','admin','executive'])){

                $skip = 0;
                $limit = 10;
                $conditions = [];
                $conditions[] =  ['id','<>', 1];
                $keyword =  $request->input('keyword', '');
                if($request->input('skip') && $request->input('limit')){
                    $skip = $request->input('skip');
                    $limit = $request->input('limit');
                }

                $users = User::SearchByKeyword($keyword)
                        ->skip($skip)->take($limit)
                        ->orderBy('id', 'ASC')
                        ->where($conditions)
                        ->with(['roles'])
                        ->get();

                $total = User::SearchByKeyword($keyword)->where($conditions)->count();
                
                return Response::json(['result'=>$users,'total'=>$total]);
            }
        }
    }

    public function show($id)
    {
        $user = User::with(['info','work','edu'])->find($id);
        
        if(!$user)
            throw new NotFoundHttpException; 

        return Response::json(['result'=>$user]);
    }

    public function store(Request $request)
    {
        if($this->currentUser()){
            if(Auth::user()->hasRole(['super-admin','admin'])){

                $roles = $request->input('roles');

                $user = new User;
                $user->name = $request->input('user.name');
                $user->email = $request->input('user.email');
                $user->password = Hash::make($request->input('user.password'));
                $user->active = 1;
                
                if($user->save()){

                    $info = new UsersInfo;
                    $info->user_id = $user->id;
                    $info->save();
                    $edu = new UsersEdu;
                    $edu->user_id = $user->id;
                    $edu->save();
                    $work = new UsersWork;
                    $work->user_id = $user->id;
                    $work->start_date = date('Y-m-d');
                    $work->save();

                    if(is_array($roles)){
                        foreach ($roles as $key => $value) {
                            $user->roles()->attach($value);
                        }
                    }
                    return $this->response->created();
                }
                else{
                    return $this->response->error('could_not_create_book', 500);
                }

            }
        }
    }

    public function update(Request $request, $id)
    {
        if($this->currentUser()){
           if(Auth::user()->hasRole(['super-admin','admin','officer'])){

                $user = User::find($id);
                if(!$user){
                    throw new NotFoundHttpException;
                }
                
                $action = $request->input('action'); 

                switch ($action) {
                    case 'update_info':
                        $user->name = $request->input('user.name');
                        $infoID = $request->input('info.id');
                        $info = UsersInfo::find($infoID);
                        $info->name = $request->input('info.name');
                        $info->gender = $request->input('info.gender');
                        $info->origin = $request->input('info.origin');
                        $info->nationality = $request->input('info.nationality');
                        $info->status = $request->input('info.status');
                        $info->blood_group = $request->input('info.blood_group');
                        $info->religion = $request->input('info.religion');
                        $info->address = $request->input('info.address');
                        $info->id_card = $request->input('info.id_card');
                        $info->phone = $request->input('info.phone');
                        if($user->save() && $info->save()){
                            return $this->response->noContent();
                        }
                        else{
                            return $this->response->error('could_not_update_user', 500);
                        }
                        break;
                    case 'update_edu':
                        $eduID = $request->input('edu.id');
                        $edu = UsersEdu::find($eduID);
                        $edu->degree = $request->input('edu.degree');
                        $edu->type = $request->input('edu.type');
                        $edu->department = $request->input('edu.department');
                        $edu->faculty = $request->input('edu.faculty');
                        $edu->university = $request->input('edu.university');
                        if($edu->save()){
                            return $this->response->noContent();
                        }
                        else{
                            return $this->response->error('could_not_update_user', 500);
                        }
                        break;
                    case 'update_work':
                        $workID = $request->input('work.id');
                        $work = UsersWork::find($workID);
                        $work->position = $request->input('work.position');
                        $work->code = $request->input('work.code');
                        $work->department = $request->input('work.department');
                        $work->start_date = $request->input('work.start_date');
                        if($work->save()){
                            return $this->response->noContent();
                        }
                        else{
                            return $this->response->error('could_not_update_user', 500);
                        }
                        break;
                    case 'update_user':
                        $user->name = $request->input('user.name');
                        $user->email = $request->input('user.email');
                        if($request->input('user.password') && !empty($request->input('user.password'))){
                            $user->password = Hash::make($request->input('user.password'));
                        }
                        if(Auth::user()->hasRole(['super-admin'])){
                            $user->active = $request->input('user.active');
                        }
                        if($user->save()){
                            $roles = $request->input('roles');
                            if(is_array($roles)){
                                $array = array_values($roles);
                                $user->roles()->sync($array);
                            }
                            return $this->response->noContent();
                        }
                        else{
                            return $this->response->error('could_not_update_user', 500);
                        }
                        break;
                }
            }
        }
    }

    public function report(Request $request)
    {
        if($this->currentUser()){
            $skip = 0;
            $limit = 10;

            $option = 'created_at';
            $from =  $request->input('from', '');
            $to =  $request->input('to', '');
            
            if($request->input('skip') && $request->input('limit')){
                $skip = $request->input('skip');
                $limit = $request->input('limit');
            }

            $items = User::SearchByDate($from, $to, $option)
                    ->skip($skip)->take($limit)
                    ->where([
                        ['id','<>', 1],
                        ['active','=', 1]
                    ])
                    ->with(['info', 'work', 'edu', 'roles'])
                    ->orderBy('id', 'ASC')
                    ->get();

            $total = User::SearchByDate($from, $to)
                    ->where([
                        ['id','<>', 1],
                        ['active','=', 1]
                    ])->count();
                    
            return Response::json(['result'=>$items,'total'=>$total]);
        }
    }

    private function currentUser() {
        return JWTAuth::parseToken()->authenticate();
    }
}
