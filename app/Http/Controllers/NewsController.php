<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function getNews()
    { //returns all news
        $news = News::all();

        return response()->json([
         'news'=>$news
        ],200);
    }
    public function getNew($newid)
    {
        $new = News::find($newid);
        if(!$new){

            return response()->json([
                'error'=>"new not found"
            ],404);
        };
        return response()->json(['new'=>$new],200);
    }
    public function postNew(Request $request)
    {
        $validator = Validator::make($request->all(),[
        'cover'=>'required',
        'title'=>'required',
        'category'=>'required',
        'slag'=>'required',
        'avatar'=>'required',
        'author'=>'required',
        'comments'=>'required',
        'isHot'=>'required',
        'time'=>'required',
        'tag'=>'required',
        'paragraphs'=>'required',
        'media'=>'required',
        'adverts'=>'required',
            ]);

        if($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors(),
                'status' => false
            ],404);
        }
        $new = new News(); //News=class
        $new->cover= request('cover');
        $new->title= request('title');
        $new->category= request('category');
        $new->slag= request('slag');
        $new->avatar= request('avatar');
        $new->author= request('author');
        $new->comments= request('comments');
        $new->isHot= request('isHot');
        $new->time= request('time');
        $new->tag= request('tag');
        $new->paragraphs= request('paragraphs');
        $new->media= request('media');
        $new->adverts= request('adverts');
        $new->save(); //saves new


        return response()->json([
            'new'=>$new
        ],201);
    }

    public function putnew(Request $request, $newid)
    {
        $validator=Validator::make($request->all(),[
            'cover'=>'required',
            'title'=>'required',
            'category'=>'required',
            'slag'=>'required',
            'avatar'=>'required',
            'author'=>'required',
            'comments'=>'required',
            'isHot'=>'required',
            'time'=>'required',
            'tag'=>'required',
            'paragraphs'=>'required',
            'media'=>'required',
            'adverts'=>'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors(),
                'status' => false
            ],404);
        };
        $new = News::find($newid);
        if(!$new){
            return response()->json([
                'error'=>"new not found"
            ],404);
        };
        $new->update([
        'cover'=>$request->input('cover'),
        'title'=>$request->input('title'),
        'category'=>$request->input('category'),
        'slug'=>$request->input('slug'),
        'avatar'=>$request->input('avatar'),
        'author'=>$request->input('author'),
        'comments'=>$request->input('comments'),
        'isHot'=>$request->input('isHot'),
        'time'=>$request->input('time'),
        'tag'=>$request->input('tag'),
        'paragraphs'=>$request->input('paragraphs'),
        'media'=>$request->input('media'),
        'adverts'=>$request->input('adverts'),
        ]);
        return response()->json([
            'new'=>$new
        ]);
     }
    public function deletenew($newid)
    { $new = News::find($newid);
        if(!$new){
            return response()->json([
                'error'=>"new not found"
            ],404);}
            $new->delete();{
                return response()->json([
                    'message'=>"new deleted successfully"],200);
            }

}
}
