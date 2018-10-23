<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FeelGood') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    

    

</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'FeelGood') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                      
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Gerenciar<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/humor">Humor</a>
                                <a class="dropdown-item" href="/feeling">Sentimento</a>
                                <a class="dropdown-item" href="/activity">Atividade</a>
                                
                            </div>
                        </li>
                      

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Relatórios<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="">7 dias</a>
                                <a class="dropdown-item" href="">15 dias</a>
                                <a class="dropdown-item" href="">30 dias</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="modal" data-target="#permission"v-pre>
                                    Conceder Permissão<span class="caret"></span>
                            </a>
                           
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    

        <div class="container" style="margin-top:2%">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Atividade
                            <button style="float:right;font-weight:bold"type="button" class="btn btn-primary btn-sm" 
                                data-toggle="modal" data-target="#myModal">+
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Imagem</th>
                                        <th>Proprietário</th>
                                        <th>Criado em</th>
                                        <th>Modificado em</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ( $activities as $activity )
                                    <tr>
                                        <td>{{ $activity->id }}</td>
                                        <td>{{ $activity->name }}</td>
                                        <td> <img style="width:2em;height:2em" src="storage/activity/{{ $activity->path }}" ></td>
                                    @if($activity->owner == 0)
                                        <td> Sistema</td>
                                    @else
                                        <td>{{ Auth::user()->name }}</td>
                                    @endif
                                        <td> {{ $activity->created_at }}</td>
                                        <td> {{ $activity->updated_at }}</td>
                                        <td> 
                                        @if($activity->owner == 0)
                                        <td>
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-update-system"
                                            onclick="javascript:$('#id-update-system').val($($(this).parent().parent().children()[0]).html())"><span class="glyphicon glyphicon-trash">Editar</span></button>
                                        </td>           
                                    @else
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-update"
                                            onclick="javascript:$('#id-update').val($($(this).parent().parent().children()[0]).html());
                                            $('#name-update').val($($(this).parent().parent().children()[1]).html())"><span class="glyphicon glyphicon-trash">Editar</span></button>
                                            <button class="btn btn-danger btn-sm"onclick="javascript:window.location.href='Atividade/remove/'+($($(this).parent().parent().children()[0]).html())"><span class="glyphicon glyphicon-trash">Excluir</span></button>
                                        </td>           
                                    @endif
                                    </tr>
                                @endforeach 
                                </tbody>
                            </table>
                            @if(session()->has('message'))
                                <div style="margin-top:2%" class="alert alert-success">
                                    {{ session()->get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

    <!----------------------- The Modal -------------------------------------------------------------------------------->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Adicionar Atividade</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="/activity/add" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name">Nome: <label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label>Selecione o arquivo:</label>
                <input type="file"  name="file">
            </div>
            

       
        <input type="submit" class="btn btn-success" value="Confirmar">
      </div>
      </form>
    </div>
  </div>
</div>

<!------------------------------------------------------------------------------------>
<div class="modal" id="modal-update-system">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Atualizar Atividade</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="/activity/update/system" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name">ID: <label>
                <input type="text" readonly class="form-control" id="id-update-system" name="id">
            </div>
          
            <div class="form-group">
                <label>Selecione o arquivo:</label>
                <input type="file"  name="file">
            </div>
            

       
        <input type="submit" class="btn btn-success" value="Confirmar">
      </div>
      </form>
    </div>
  </div>
</div>

<!---------------------------------------------------------------------------------------------->

<div class="modal" id="modal-update">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Atualizar Atividade</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="/activity/update" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name">ID: <label>
                <input type="text" readonly class="form-control" id="id-update" name="id">
            </div>
            <div class="form-group">
                <label for="name">Nome: <label>
                <input type="text" class="form-control" id="name-update" name="name">
            </div>
            <div class="form-group">
                <label>Selecione o arquivo:</label>
                <input type="file"  name="file">
            </div>
            

       
        <input type="submit" class="btn btn-success" value="Confirmar">
      </div>
      </form>
    </div>
  </div>
</div>

<!---------------------------------------------------------------------------------------------->

<div class="modal" id="permission">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Conceder Permissão</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="/permission" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
           
            <div class="form-group">
                <label for="name">Email do Terapeuta: <label>
                <input type="text" class="form-control"  name="email">
            </div>
           
            

       
        <input type="submit" class="btn btn-success" value="Confirmar">
      </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>