<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use Auth;
use Response;
use Hash;
use Image;
use Input;
use Validator;
use App\Models\User;
use App\Models\Source;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UploadController extends Controller
{
    use Helpers;

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function avatar(Request $request){

        if($this->currentUser()){
            if($request->hasFile('avatar')){
                $avatar = $request->file('avatar');
                $userId = $this->currentUser()->id;
                $filename = $avatar->getClientOriginalName();
                $extension = $avatar->getClientOriginalExtension();
                $filename = sha1('avatar-'.$userId.'-'.$filename.'-'.time()).".".$extension;
                Image::make($avatar)->resize(300, 300)->save( public_path('avatars/' . $filename ) );
                $user = Auth::user();
                $user->avatar = 'avatars/' .$filename;
                $user->save();
                return public_path('avatars/' . $filename );
            }
        }
        
    }

    public function pdf(Request $request) 
    {
        if($this->currentUser()){
            if($request->hasFile('file')){
                $file = $request->file('file');
                $section = $request->input('section');
                $userId = $this->currentUser()->id;
                $original_name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $size = $file->getClientSize();
                $sha1 = sha1($section.'-'.$userId.'-'.$original_name.'-'.time());
                $filename = $sha1.".".$extension;
                $destinationPath = public_path('pdfs/');
                $file->move($destinationPath, $filename);
                $source = new Source;
                $source->user_id = $userId; 
                $source->name = $original_name; 
                $source->path = 'pdfs/'.$filename; 
                $source->sha1 = $sha1; 
                $source->size = $size;
                $source->type = $section;
                $source->save();
                return ['id'=>$source->id,'section'=>$section];
            }
        }

    }
    
    private function currentUser() {
        return JWTAuth::parseToken()->authenticate();
    }
}
