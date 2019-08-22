<?php

namespace App\Http\Controllers;

use App\Album;
use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AlbumController extends Controller
{
    public function getAlbums() //function of get=return all albums
    {
        $albums = Album::all();
        return response()->json([
         'albums'=>$albums
        ],200);
    }
    public function getAlbum($albumid) //function of get=return one album with id
    {
        $album = Album::find($albumid);
        if(!$album){
            return response()->json([
                'error'=>"Album not found"
            ],404);
        };
        return response()->json(['album'=>$album],200);
    } //parameter=$authorId bcz album depend on author(linkage of album & author)
    public function postAlbum(Request $request, $authorId) //function of post=create one album
    {
        $validator = Validator::make($request->all(),[ //must be filled
        'title'=>'required',
        'subtitle'=>'required',
        'isHot'=>'required',
        'details'=>'required',
       ]);

        if($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors(),
                'status' => false
            ],404);
        };
        //image
        if($request->hasFile('file')){
            $this->path=$request->file('file')->store('albums'); //image file stored in albums
        }

        $author=Author::find($authorId);
        if(!$author){
            return response()->json([
                'message'=>'author not found'
            ]);
        }
        //all from migration except id(given by db) & author_id(it is argument/parameter of post, will be given)
        $album = new Album(); //creating new album
        $album->title=$request->input('title');
        $album->subtitle=$request->input('subtitle');
        $album->isHot=$request->input('isHot');
        $album->details=$request->input('details');
        $album->cover=$this->path; //image path of file
        // $album->save(); //saves album
        $author->albums()->save($album); //saving album linked with author

        return response()->json([
            'album'=>$album
        ],201);

    }

    public function putAlbum(Request $request, $albumid) //function of put=update one album with id
    {
        $validator=Validator::make($request->all(),[
        'title'=>'required',
        'subtitle'=>'required',
        'isHot'=>'required',
        'details'=>'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors(),
                'status' => false
            ],404);
        };
        $album = Album::find($albumid);
        if(!$album){
            return response()->json([
                'error'=>"Album not found"
            ],404);
        };
        $album->update([ //updating album
        'title'=>$request->input('title'),
        'subtitle'=>$request->input('subtitle'),
        'isHot'=>$request->input('isHot'),
        'details'=>$request->input('details'),
        'cover'=>$request->input('cover'),
        ]);
        return response()->json([
            'album'=>$album
        ],206);
     }
    public function deleteAlbum($albumid) //function of delete=remove one album with id
    { $album = Album::find($albumid);
        if(!$album){
            return response()->json([
                'error'=>"Album not found"
            ],404);}
            $album->delete();{
                return response()->json([
                    'message'=>"Album deleted successfully"],200);
            }

}
public function viewFile($albumid){ //function of view=views one album image with id
    $album=Album::find($albumid);
    if(!$album){
        return response()->json([
            'error'=>"Album not found"
        ],404);
    };
    $pathToFile= storage_path('/app/'.$album->cover); //storage_path is builtin,, '/app/' is storage of image
    return response()->download($pathToFile);
}
}
