<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feeling;
use App\FeelingException;
use Auth;
class FeelingController extends Controller
{
    public function index(){
        
    
        
        $feelings = Feeling::whereNotIn('id', function($query) {
            $query->select('feeling_id')
            ->from('feeling_exceptions')
            ->where('user_id','=',Auth::user()->id);
    })->where(function ($query) {
        $query->where('owner','=',Auth::user()->id)
              ->orWhere('owner', '=', 0);
    })->get();

        return view('feeling.index', compact('feelings'));
    }

    public function create()
    {
        return view('feelings.create');
    }
  
    public function store(request $request)
    {
        
       $extension = $request->file->extension();
       $upload = $request->file->storeAs('feeling', $request->name.".".$extension);
       

        $feeling = new Feeling;
        $feeling->name = $request->name;
        $feeling->path = $request->name.".".$extension;
        $feeling->owner = Auth::user()->id;
        $feeling->save();
        return redirect()->route('feeling.index')->with('message', 'Sentimento criado com sucesso!');
    }
    
    public function show($id)
    {
        //
    }
  
    public function edit($id)
    {
        $Feeling = Feeling::findOrFail($id);
        return view('feeling.edit',compact('feeling'));
    }
  
    public function update(request $request)
    {
        $name = $request->file->getClientOriginalName();
        $upload = $request->file->storeAs('feeling', $name);

        $feeling = Feeling::findOrFail($request->id);
        $feeling->name        = $request->name;
        $feeling->path = $name;
        $feeling->owner       = Auth::user()->id;;;
        $feeling->save();
        return redirect()->route('feeling.index')->with('message', 'Sentimento atualizado com sucesso!');
    }
    public function updateSystem(request $request)
    {
        
        $name = $request->file->getClientOriginalName();
        $upload = $request->file->storeAs('feeling', $name);
        
        $aux = Feeling::findOrFail($request->id);
        $feeling = new Feeling;
        $feeling->name  = $aux->name;
        $feeling->path = $name;
        $feeling->owner       = Auth::user()->id;;
        $feeling->save();

        $exception = new FeelingException;
        $exception->name = $aux->name;
        $exception->Feeling_id = $request->id;
        $exception->user_id = Auth::user()->id;
        $exception->save();
        return redirect()->route('feeling.index')->with('message', 'Sentimento atualizado com sucesso!');
    }
  
    public function destroy($id)
    {
        $feeling = Feeling::findOrFail($id);
        $feeling->delete();

        $exception = FeelingException::where('name',$feeling->name)->where('user_id','=',Auth::user()->id);;
        $exception->delete();
        return redirect()->route('feeling.index')->with('message','Feeling deletado com sucesso!');
    }


   
}
