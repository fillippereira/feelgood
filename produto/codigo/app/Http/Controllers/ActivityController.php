<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\ActivityException;
use Auth;
class ActivityController extends Controller
{
    public function index(){
        
    
        
        $activities = Activity::whereNotIn('id', function($query) {
            $query->select('Activity_id')
            ->from('Activity_exceptions')
            ->where('user_id','=',Auth::user()->id);
    })->where(function ($query) {
        $query->where('owner','=',Auth::user()->id)
              ->orWhere('owner', '=', 0);
    })->get();

        return view('activity.index', compact('activities'));
    }

    public function create()
    {
        return view('activities.create');
    }
  
    public function store(request $request)
    {
        
       $extension = $request->file->extension();
       $upload = $request->file->storeAs('Activity', $request->name.".".$extension);
       

        $activity = new Activity;
        $activity->name = $request->name;
        $activity->path = $request->name.".".$extension;
        $activity->owner = Auth::user()->id;
        $activity->save();
        return redirect()->route('activity.index')->with('message', 'Atividade criada com sucesso!');
    }
    
    public function show($id)
    {
        //
    }
  
    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        return view('activity.edit',compact('activity'));
    }
  
    public function update(request $request)
    {
        $name = $request->file->getClientOriginalName();
        $upload = $request->file->storeAs('activity', $name);

        $activity = Activity::findOrFail($request->id);
        $activity->name        = $request->name;
        $activity->path = $name;
        $activity->owner       = Auth::user()->id;;;
        $activity->save();
        return redirect()->route('activity.index')->with('message', 'Atividade atualizada com sucesso!');
    }
    public function updateSystem(request $request)
    {
        
        $name = $request->file->getClientOriginalName();
        $upload = $request->file->storeAs('activity', $name);
        
        $aux = Activity::findOrFail($request->id);
        $activity = new Activity;
        $activity->name  = $aux->name;
        $activity->path = $name;
        $activity->owner       = Auth::user()->id;;
        $activity->save();

        $exception = new ActivityException;
        $exception->name = $aux->name;
        $exception->activity_id = $request->id;
        $exception->user_id = Auth::user()->id;
        $exception->save();
        return redirect()->route('activity.index')->with('message', 'Atividade atualizada com sucesso!');
    }
  
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        $exception = ActivityException::where('name',$activity->name)->where('user_id','=',Auth::user()->id);;
        $exception->delete();
        return redirect()->route('activity.index')->with('message','Atividade deletada com sucesso!');
    }


   
}
