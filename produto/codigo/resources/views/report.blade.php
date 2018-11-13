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
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
.radio-humor {
        visibility: hidden!important;
       
}
    
.label-humor {
    display: block;
    width:6em;
    margin-right:1%;
    float: left;
    text-align:center;
}

.radio-humor:checked+label {
    opacity: 0.5;
}

.check-activity {
        visibility: hidden!important;
       
}
    
.label-activity {
    display: inline-block;
    width:5em;
    margin-left:1%;
    float: left;
    text-align:center;
}

.check-activity:checked+label {
    opacity: 0.5;
}
img {
  height: 2em!important;
  cursor:pointer;
  
}

.block{
    display:block
}

.pull-left{
    float:left;
}
</style>

<script>
function intensidade(ref){
    var fraco = $(ref).next();
   
    if($(ref).is(':checked')){
        
        $(fraco).attr('checked',false);
    }
    else{
        $(fraco).attr('checked',true);
    }
}

</script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
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
                                <a class="dropdown-item" href="/feeling">Sentimentos</a>
                                <a class="dropdown-item" href="/activity">Atividades</a>
                                
                            </div>
                        </li>
                      

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Relatórios<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{'/report/seven/'.Auth::User()->id}}">7 dias</a>
                                <a class="dropdown-item" href="{{'/report/fifteen/'.Auth::User()->id}}">15 dias</a>
                                <a class="dropdown-item" href="{{'/report/thirty/'.Auth::User()->id}}">30 dias</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link " href="#" data-toggle="modal" data-target="#permission" v-pre>
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
                        <div class="card-header">Registros</div>
                        <div class="card-body">
                            <table class="table table-hover table-responsive-sm table-sm ">
                                <thead>
                                    <tr  class="text-center">
                                        <th>ID</th>
                                        <th>Humor</th>
                                        <th>Sentimentos</th>
                                        <th>Intensidade Sentimento</th>
                                        <th>Pensamento</th>
                                        <th>Qualificação Pensamento</th>
                                        <th>Situação</th>
                                        <th>Comportamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ( $registers as $register )
                                    <tr  class="text-center">
                                        <td class="text-center">{{ $register->id }}</td>
                                        <td>{{ $register->humor->name }}</td>
                                        <td> 
                                            @for ($i = 0; $i < count($register->registerFeeling); $i++)
                                             {{ $register->registerFeeling[$i]->feeling['name'] }}<br>
                                            @endfor
                                        </td>
                                        <td> 
                                            @for ($i = 0; $i < count($register->registerFeeling); $i++)
                                                {{ $register->registerFeeling[$i]['intensity_feeling'] }}<br>
                                            @endfor
                                        </td>
                                       
                                        <td>
                                            @for ($i = 0; $i < count($register->RegisterThought); $i++)
                                                {{ $register->RegisterThought[$i]['thought'] }}<br>
                                            @endfor
                                        </td>
                                        <td>
                                            @for ($i = 0; $i < count($register->RegisterThought); $i++)
                                                {{ $register->RegisterThought[$i]['qualification_thought'] }}<br>
                                            @endfor
                                        </td>
                                        <td>{{ $register->situation }}</td>
                                        <td>{{ $register->comportament }}</td>
                                    </tr>
                                @endforeach 
                                </tbody>
                            </table>
                       </div><!--card-body-->
                    </div><!--card-->
                    <br>
                    @if(session()->has('message'))
                        <div style="margin-top:2%" class="alert alert-success">
                            {{ session()->get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div style="margin-top:2%" class="alert alert-danger">
                            {{ session()->get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
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