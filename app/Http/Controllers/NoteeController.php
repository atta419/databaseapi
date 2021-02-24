<?php

namespace App\Http\Controllers;

use App\Models\Notee;
use Illuminate\Http\Request;

class NoteeController extends Controller
{
    public function index()
    {
        $notee = Notee::latest()->paginate(5);

        return view('Notees.index',compact('Notees'));

    }

    public function create()
    {
        return view('Notees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Notee::create($request->all());

        return redirect()->route('Notees.index')
                        ->with('success','Post created successfully.');
    }

    public function show(Notee $Notee)
    {
        return view('Notees.show',compact('post'));
    }

    public function edit(Notee $Notee)
    {
        return view('Notees.edit',compact('Notees'));
    }

    public function update(Request $request, Notee $Notee)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $Notee->update($request->all());

        return redirect()->route('posts.index')
                        ->with('success','Post updated successfully');
    }

    public function destroy(Notee $Notee)
    {
        $Notee->delete();

        return redirect()->route('posts.index')
                        ->with('success','Post deleted successfully');
    }
}
