<?php

namespace App\Http\Controllers;
use App\Permission;
use Illuminate\Http\Request;
use Auth;
class PermissionController extends Controller
{
    public function store(request $request)
    {
    
        $permission = new Permission;
        $permission->user_id = Auth::user()->id;
        $permission->therapist_email = $request->email;;
        $permission->save();
        return redirect()->back()->with('message', 'Permisão concedida com sucesso!');
    }
}
