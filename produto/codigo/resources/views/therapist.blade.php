@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Usuários</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-condensed table-hover table striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Relatório</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                    @foreach ( Auth::user()->user as $user )
                        <td> {{$user->id}}</td>
                        <td> {{$user->name}}</td>
                        <td> {{$user->email}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Relatório
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{'/conclusion/seven/'.$user->id}}">7 dias</a></li>
                                    <li><a class="dropdown-item" href="{{'/conclusion/fifteen/'.$user->id}}">15 dias</a></li>
                                    <li><a class="dropdown-item" href="{{'/conclusion/thirty/'.$user->id}}">30 dias</a></li>
                                </ul>
                            </div>
                        </td>
                        @endforeach
                   </tr>
                   </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
