<?php

namespace App\Http\Controllers;

use App\Author;
use App\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{

    public function getAuthors()
    { //returns all authors
        $authors = Author::all();

        return response()->json([
         'authors'=>$authors
        ],200);
    }
    public function getAuthor($authorid)
    {
        $author = Author::find($authorid);
        if(!$author){

            return response()->json([
                'error'=>"Author not found"
            ],404);
        };
        $author->albums;
        return response()->json(['author'=>$author],200);
    }
    public function postAuthor(Request $request)
    {
        $validator = Validator::make($request->all(),[
        'name'=>'required',
        'avatar'=>'required',

        ]);

        if($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors(),
                'status' => false
            ],404);
        }

        $author = new Author(); //creates new author
        $author->name= request('name');
        $author->avatar= request('avatar');
        $author->save(); //saves author

        return response()->json([
            'author'=>$author
        ],201);
    }

    public function putAuthor(Request $request, $authorid)
    {
        $validator=Validator::make($request->all(),[
        'name'=>'required',
        'avatar'=>'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors(),
                'status' => false
            ],404);
        };
        $author = Author::find($authorid);
        if(!$author){
            return response()->json([
                'error'=>"Author not found"
            ],404);
        };
        $author->update([
        'name'=>$request->input('name'),
        'avatar'=>$request->input('avatar'),
        ]);
        return response()->json([
            'author'=>$author
        ]);
     }
    public function deleteAuthor($authorid)
    { $author = Author::find($authorid);
        if(!$author){
            return response()->json([
                'error'=>"Author not found"
            ],404);}
            $author->delete();{
                return response()->json([
                    'message'=>"Author deleted successfully"],200);
            }

}


}
