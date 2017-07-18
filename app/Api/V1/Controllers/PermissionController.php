<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use Auth;
use Response;
use App\Models\Permission;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PermissionController extends Controller
{
    use Helpers;

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index()
    {
        if($this->currentUser()){
            $items = Permission::orderBy('id', 'ASC')->get();
            return Response::json(['result'=>$items]);
        }
    }

    public function store(Request $request)
    {

        if($this->currentUser()){
            if(Auth::user()->hasRole(['super-admin','admin'])){
                $item = new Permission;
                $item->name = $request->get('name');
                $item->display_name = $request->get('display_name');
                if($item->save()){
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
            if(Auth::user()->hasRole(['super-admin','admin'])){
                $item = Permission::find($id);
                if(!$item){
                    throw new NotFoundHttpException;
                }

                $item->fill($request->all());

                if($item->save()){
                    return $this->response->noContent();
                }
                else{
                    return $this->response->error('could_not_update_user', 500);
                }
            }
        }
    }

    private function currentUser() {
        return JWTAuth::parseToken()->authenticate();
    }
}
