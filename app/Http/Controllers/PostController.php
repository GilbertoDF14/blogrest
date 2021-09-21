<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    public function index(Request $req){
        return Post::all();
    }

    public function get($post){
        $result=Post::find($user);
        //$result = DB::table('users')-> where('user','=',$user)->get();
        if($result)
            return $result;
        else
            return response()->json(['status'=>'failed'],404);
    }

    public function create(Request $req){
        $this->validate($req,[
            'user'=>'required', 
            'topics_id'=>'required',
            'mensaje'=>'required']);
        $datos = new Post;
        $result = $datos->fill($req->all())->save();
        if($result){
            return response()->json(['status'=>'success'],200);
        }else{
            return response()->json(['status'=>'failed'],404);
        }
    }

    public function update(Request $req, $topic){
        $this->validate($req,[
            'user'=>'filled', 
            'topics_id'=>'filled',
            'mensaje'=>'filled']);
        $datos = Topic::find($topic);
        //$datos->pass=$req->pass;
        $result = $datos->fill($req->all())->save();
        if($result){
            return response()->json(['status'=>'success'],200);
        }else{
            return response()->json(['status'=>'failed'],404);
        }
    }

    public function destroy($post){
       
        $datos = Post::find($post);
        if(!$datos) return response()->json(['status'=>'failed'],404);
        $result = $datos->delete();
        if($result){
            return response()->json(['status'=>'success'],200);
        }else{
            return response()->json(['status'=>'failed'],404);
        }
    }
}