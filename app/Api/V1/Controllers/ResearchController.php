<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use Auth;
use Response;
use App\Models\Research;
use App\Models\Source;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResearchController extends Controller
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
                $keyword =  $request->input('keyword', '');

                //if(!Auth::user()->hasRole(['super-admin'])){

                    $userId = $this->currentUser()->id;
                    $conditions[] = ['user_id','=', $userId];
                    $conditions[] =  ['active','=', 1];

                //}

                if($request->input('get') == 'all'){

                    $items = Research::SearchByKeyword($keyword)
                        ->where($conditions)
                        ->orderBy('id', 'DESC')
                        ->get();
                    $total = Research::SearchByKeyword($keyword)->where($conditions)->count();

                    return Response::json(['result'=>$items,'total'=>$total]);

                }
                else{

                    if ($request->input('skip') && $request->input('limit')){

                        $skip = $request->input('skip');
                        $limit = $request->input('limit');

                    }
                    $items = Research::SearchByKeyword($keyword)
                        ->where($conditions)
                        ->skip($skip)->take($limit)
                        ->orderBy('id', 'DESC')
                        ->get();

                    $total = Research::SearchByKeyword($keyword)->where($conditions)->count();

                    return Response::json(['result'=>$items,'total'=>$total]);

                }

            }

        }
    }

    public function show($id)
    {
        $item = Research::with(['research'])->find($id);
        
        if(!$item)
            throw new NotFoundHttpException; 

        return Response::json(['result'=>$item]);
    }

    public function store(Request $request)
    {

        if($this->currentUser()){

            if(Auth::user()->hasRole(['super-admin','admin','officer'])){

                $item = new Research;
                $item->user_id = $this->currentUser()->id;
                $item->title = $request->input('research.title'); 
                $item->fiscal_year = $request->input('research.fiscal_year'); 
                $item->type_id = $request->input('research.type_id'); 
                $item->level_id = $request->input('research.level_id'); 
                $item->researcher = $request->input('research.researcher'); 
                $item->secondry_researcher = $request->input('research.secondry_researcher'); 
                $item->publisher = $request->input('research.publisher'); 
                $item->research_pdf_id = $request->input('research.research_pdf_id');
                $item->active = 1;

                if($item->save()){
                    
                    Source::where([ ['id', '=', $item->research_pdf_id]])->update(['active' => 1]);

                    return Response::json(['result'=>["research_id"=>$item->id]]);

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

                $item = Research::find($id);

                if(!$item){

                    throw new NotFoundHttpException;

                }

                $item->title = $request->input('research.title'); 
                $item->fiscal_year = $request->input('research.fiscal_year'); 
                $item->type_id = $request->input('research.type_id'); 
                $item->level_id = $request->input('research.level_id'); 
                $item->researcher = $request->input('research.researcher'); 
                $item->secondry_researcher = $request->input('research.secondry_researcher'); 
                $item->publisher = $request->input('research.publisher'); 
                $item->research_pdf_id = $request->input('research.research_pdf_id');
                $item->active = $request->input('research.active');

                if($item->save()){

                    if($item->active == 0){

                        Source::where([['id', '=', $item->research_pdf_id]])->update(['active' => 0]);

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

            $items = Research::SearchByDate($from, $to, $option)
                    ->skip($skip)->take($limit)
                    ->where([
                        ['active','=', 1]
                    ])
                    ->with(['research'])
                    ->orderBy('id', 'ASC')
                    ->get();

            $total = Research::SearchByDate($from, $to)
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
