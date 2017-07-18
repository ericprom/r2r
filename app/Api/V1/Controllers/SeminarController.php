<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use Auth;
use Response;
use App\Models\Seminar;
use App\Models\Source;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SeminarController extends Controller
{
    use Helpers;

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index(Request $request)
    {
        if($this->currentUser()){
            
            if(Auth::user()->hasRole(['super-admin'])){

                $skip = 0;
                $limit = 10;
                $conditions = [];
                $keyword =  $request->input('keyword', '');

                //if(!Auth::user()->hasRole(['super-admin'])){

                    $userId = $this->currentUser()->id;
                    $conditions[] = ['user_id','=', $userId];
                    $conditions[] =  ['active','=', 1];

                //}

                if($request->input('get') == 'all'){

                    $items = Seminar::SearchByKeyword($keyword)
                        ->where($conditions)
                        ->orderBy('id', 'DESC')
                        ->get();

                    $total = Seminar::SearchByKeyword($keyword)->where($conditions)->count();

                    return Response::json(['result'=>$items,'total'=>$total]);

                }
                else{

                    if ($request->input('skip') && $request->input('limit')){

                        $skip = $request->input('skip');
                        $limit = $request->input('limit');

                    }

                    $items = Seminar::SearchByKeyword($keyword)
                        ->where($conditions)
                        ->skip($skip)->take($limit)
                        ->orderBy('id', 'DESC')
                        ->get();

                    $total = Seminar::SearchByKeyword($keyword)->where($conditions)->count();

                    return Response::json(['result'=>$items,'total'=>$total]);

                }
            }
        }
    }

    public function show($id)
    {
        $item = Seminar::with(['seminar','knowledge'])->find($id);
        
        if(!$item)
            throw new NotFoundHttpException; 

        return Response::json(['result'=>$item]);
    }

    public function store(Request $request)
    {

        if($this->currentUser()){
            if(Auth::user()->hasRole(['super-admin','admin','officer'])){

                $item = new Seminar;
                $item->user_id = $this->currentUser()->id;
                $item->title = $request->input('seminar.title');
                $item->start_date = $request->input('seminar.start_date'); 
                $item->end_date = $request->input('seminar.end_date'); 
                $item->fiscal_year = $request->input('seminar.fiscal_year'); 
                $item->seminar_pdf_id = $request->input('seminar.seminar_pdf_id'); 
                $item->knowledge_pdf_id = $request->input('seminar.knowledge_pdf_id');
                $item->active = 1;

                if($item->save()){

                    Source::where([['id', '=', $item->seminar_pdf_id]])->update(['active' => 1]);
                    Source::where([['id', '=', $item->knowledge_pdf_id]])->update(['active' => 1]);

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

            if(Auth::user()->hasRole(['super-admin','admin','officer'])){

                $item = Seminar::find($id);

                if(!$item){

                    throw new NotFoundHttpException;

                }

                $item->title = $request->input('seminar.title');
                $item->start_date = $request->input('seminar.start_date'); 
                $item->end_date = $request->input('seminar.end_date'); 
                $item->fiscal_year = $request->input('seminar.fiscal_year'); 
                $item->seminar_pdf_id = $request->input('seminar.seminar_pdf_id'); 
                $item->knowledge_pdf_id = $request->input('seminar.knowledge_pdf_id');
                $item->active = $request->input('seminar.active');

                if($item->save()){

                    if($item->active == 0){

                        Source::where([['id', '=', $item->seminar_pdf_id]])->update(['active' => 0]);
                        Source::where([['id', '=', $item->knowledge_pdf_id]])->update(['active' => 0]);

                    }

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
