<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use Auth;
use Response;
use App\Models\Annoucement;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AnnoucementController extends Controller
{
    use Helpers;

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index(Request $request)
    {
        if($this->currentUser()){
            
            $skip = 0;
            $limit = 10;
            $conditions = [];
            $keyword =  $request->input('keyword', '');

            if(!Auth::user()->hasRole(['super-admin','admin'])){
                
                $conditions[] =  ['active','=', 1];

            }

            if ($request->input('skip') && $request->input('limit')){

                $skip = $request->input('skip');
                $limit = $request->input('limit');

            }

            $items = Annoucement::SearchByKeyword($keyword)
                ->where($conditions)
                ->with('reporter')
                ->skip($skip)->take($limit)
                ->orderBy('id', 'DESC')
                ->get();

            $total = Annoucement::SearchByKeyword($keyword)->where($conditions)->count();

            return Response::json(['result'=>$items,'total'=>$total]);
        }
    }

    public function show($id)
    {
        $item = Annoucement::with('reporter')->find($id);
        
        if(!$item)
            throw new NotFoundHttpException; 

        return Response::json(['result'=>$item]);
    }

    public function store(Request $request)
    {

        if($this->currentUser()){
            if(Auth::user()->hasRole(['super-admin','admin'])){

                $item = new Annoucement;
                $item->user_id = $this->currentUser()->id;
                $item->title = $request->input('annoucement.title');
                $item->detail = $request->input('annoucement.detail');
                $item->active = 1;

                if($item->save()){
                    return Response::json(['result'=>["seminar_id"=>$item->id]]);
                }
                else{

                    return $this->response->error('could_not_create_store', 500);

                }

            }

        }
    }

    public function update(Request $request, $id)
    {
        if($this->currentUser()){

            if(Auth::user()->hasRole(['super-admin','admin'])){

                $item = Annoucement::find($id);

                if(!$item){

                    throw new NotFoundHttpException;

                }

                $item->title = $request->input('annoucement.title');
                $item->detail = $request->input('annoucement.detail'); 
                $item->active = $request->input('annoucement.active');

                if($item->save()){
                    return $this->response->noContent();
                }
                else{

                    return $this->response->error('could_not_update_user', 500);

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

            $items = Seminar::SearchByDate($from, $to, $option)
                    ->skip($skip)->take($limit)
                    ->where([
                        ['active','=', 1]
                    ])
                    ->with(['seminar','knowledge'])
                    ->orderBy('id', 'ASC')
                    ->get();

            $total = Seminar::SearchByDate($from, $to)
                    ->where([
                        ['active','=', 1]
                    ])->count();
                    
            return Response::json(['result'=>$items,'total'=>$total]);
        }
    }

    private function currentUser() {
        return JWTAuth::parseToken()->authenticate();
    }
}
