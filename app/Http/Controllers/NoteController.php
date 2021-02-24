<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Note as NoteResource;



class NoteController extends BaseController
{
    public function index()
    {
    $Note = Note::all();
    return $this->sendResponse(NoteResource::collection($Note), 'Posts retrieved Successfully!' );
    }


    public function userNotes($id)
    {
    $notes = Note::where('user_id' , $id)->get();
    return $this->sendResponse(NoteResource::collection($notes), 'Posts retrieved Successfully!' );
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'title'=>'required',
            'description'=>'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validate Error',$validator->errors() );
        }

        $user = Auth::user();
        $input['user_id'] = $user->id;
        $Note = Note::create($input);
        return $this->sendResponse($Note, 'Post added Successfully!' );

    }


    public function show($id)
    {
        $Note = Note::find($id);
        if (is_null($Note)) {
            return $this->sendError('Post not found!' );
        }
        return $this->sendResponse(new NoteResource($Note), 'Post retireved Successfully!' );

    }

    public function update(Request $request, Note $Note)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'title'=>'required',
            'description'=>'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }


        if ( $Note->user_id != Auth::id()) {
            return $this->sendError('you dont have rights' , $validator->errors());
        }
        $Note->title = $input['title'];
        $Note->content = $input['content'];
        $Note->save();

        return $this->sendResponse(new NoteResource($Note), 'Post updated Successfully!' );

    }

    public function destroy(Note $Note)
    {
        $errorMessage = [] ;

        if ( $Note->user_id != Auth::id()) {
            return $this->sendError('you dont have rights' , $errorMessage);
        }
        $Note->delete();
        return $this->sendResponse(new NoteResource($Note), 'Post deleted Successfully!' );

    }

}
