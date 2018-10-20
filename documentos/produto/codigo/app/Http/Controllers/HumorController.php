<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Humor;
use App\HumorException;
use Auth;
class HumorController extends Controller
{
    public function index(){
        
        $humors = Humor::whereNotIn('id', function($query) {
            $query->select('humor_id')
            ->from('humor_exceptions')
            ->where('user_id','=',Auth::user()->id);
        })->where(function ($query) {
            $query->where('owner','=',Auth::user()->id)
                ->orWhere('owner', '=', 0);
        })->get();

        return view('humor.index', compact('humors'));
    }

    public function create()
    {
        return view('humors.create');
    }
  
    public function store(request $request)
    {
        
       $extension = $request->file->extension();
       $upload = $request->file->storeAs('humor', $request->name.".".$extension);
       

        $humor = new Humor;
        $humor->name = $request->name;
        $humor->path = $request->name.".".$extension;
        $humor->owner = Auth::user()->id;
        $humor->save();
        return redirect()->route('humor.index')->with('message', 'Humor criado com sucesso!');
    }
    
    public function show($id)
    {
        //
    }
  
    public function edit($id)
    {
        $humor = humor::findOrFail($id);
        return view('humors.edit',compact('humor'));
    }
  
    public function update(request $request)
    {
        $name = $request->file->getClientOriginalName();
        $upload = $request->file->storeAs('humor', $name);

        $humor = Humor::findOrFail($request->id);
        $humor->name        = $request->name;
        $humor->path = $name;
         $humor->owner       = Auth::user()->id;;;
        $humor->save();
        return redirect()->route('humor.index')->with('message', 'Humor atualizado com sucesso!');
    }
    public function updateSystem(request $request)
    {
        
        $name = $request->file->getClientOriginalName();
        $upload = $request->file->storeAs('humor', $name);
        
        $aux = Humor::findOrFail($request->id);
        $humor = new Humor;
        $humor->name  = $aux->name;
        $humor->path = $name;
        $humor->owner       = Auth::user()->id;;
        $humor->save();

        $exception = new HumorException;
        $exception->name = $aux->name;
        $exception->humor_id = $request->id;
        $exception->user_id = Auth::user()->id;
        $exception->save();
        return redirect()->route('humor.index')->with('message', 'Humor atualizado com sucesso!');
    }
  
    public function destroy($id)
    {
        $humor = Humor::findOrFail($id);
        $humor->delete();

        $exception = HumorException::where('name',$humor->name)->where('user_id','=',Auth::user()->id);;
        $exception->delete();
        return redirect()->route('humor.index')->with('message','Humor deletado com sucesso!');
    }


   
}
