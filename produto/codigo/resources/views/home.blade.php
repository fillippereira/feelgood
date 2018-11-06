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
                                <a class="dropdown-item" href="">7 dias</a>
                                <a class="dropdown-item" href="">15 dias</a>
                                <a class="dropdown-item" href="">30 dias</a>
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
                                        <th>Quantidade Sentimento</th>
                                        <th>Pensamento</th>
                                        <th>Qualificação Pensamento</th>
                                        <th>SItuação</th>
                                        <th>Comportamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ( $registers as $register )
                                    <tr  class="text-center">
                                        <td class="text-center">{{ $register->id }}</td>
                                        <td>{{ $register->humor }}</td>
                                        <td>{{ $register->feelings }}</td>
                                        <td>{{ $register->quantification_feelings }}</td>
                                        <td>{{ $register->thoughts }}</td>
                                        <td>{{ $register->qualification_thoughts }}</td>
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
                    <div class="card">
                        <div class="card-header">Adicionar Registro</div>
                        
                        <div class="card-body">

                        <div id="adicionar-registro">
                            <label>{{ Auth::user()->name }}, como você se sente?</label>
                            <form method="post" action="/create/register">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="col-md-12 pull-left">
                                <hr >
                                    <h6 style="color:gray;">Selecione seu humor abaixo.</h6>
                                
                                    @foreach ( $humors as $humor )
                                        <input class="radio-humor" type="radio" name="humor" value="{{ $humor->name }}"  id="{{ $humor->name }}" />
                                        <label class="label-humor" for="{{ $humor->name }}">
                                            <img src="storage/humor/{{ $humor->path }}" title="{{ $humor->name }}">
                                            <label class="block">{{ $humor->name }}</label>
                                        </label>
                                     @endforeach
                                </div>

                                 <div class="col-md-12 pull-left">
                                 <hr >
                                    <h6 style="color:gray;">Selecione os sentimentos abaixo e quantifique-os.</h6>
                                    @foreach ( $feelings as $feeling )
                                        <div class="row" style="display:block;margin-left:0.3%">
                                            <label style="width:11%">
                                                <input type="checkbox"  onclick="ShowInput(this)" name="sentimentos[]" value="{{ $feeling->id }}">
                                            {{ $feeling->name }}</label>

                                            <input style="width:5%;display:none" class="form-control" disabled type="number" name="qtd_sentimento[]" max="10">
                                        </div>
                                    @endforeach
                                </div>

                                <div class="col-md-12 pull-left">
                                <hr >
                                    <h6 style="color:gray;">Selecione as atividades abaixo.</h6>
                                    @foreach ( $activities as $activity )
                                    <input class="check-activity" type="checkbox" name="activity" id="{{ $activity->name }}" />
                                        <label class="label-activity" for="{{ $activity->name }}">
                                        <img src="storage/activity/{{ $activity->path }}" title="{{ $activity->name }}">
                                        <label class="block">{{ $activity->name }}</label>
                                    </label>
                                            
                                    @endforeach
                                </div>
                                <div class="col-md-12 pull-left">  
                                <hr >
                                    <label style="display:block;color:gray;">Informe os pensamentos e selecione os mais fortes.</label>
                                    <a href="javascript:void(0)" style="display:block" onclick="adicionarPensamento(this)">Adicionar pensamento</a>
                                    <input type="text"style="display:inline-block" class="form-control col-md-4" name="pensamento">
                                    <input type="checkbox" value="1" style="margin-left:3%"name="pensamento_forte">
                                </div>
                                <div class="col-md-12 pull-left">
                                    <label style="display:block;color:gray;">Informe a situação.</label>
                                    <input type="text"style="display:inline-block" class="form-control col-md-4" name="situacao">
                                </div>
                                <div class="col-md-12 pull-left">
                                    <label style="display:block;color:gray;">Informe o comportamento.</label>
                                    <input type="text"style="display:inline-block" class="form-control col-md-4" name="comportamento">
                                
                                </div>
                                    
                                    <input type="submit" class="btn btn-success" value="Confirmar">
                                </form>
                            </div><!--adicionar registro-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        </div>    
        
     

    <script>

      
    function ShowInput(ref)
    {
        var quantidade = $(ref).parent().next();
        
        if($(quantidade).css('display') == 'none'){
            $(quantidade).show();
            $(quantidade).prop('disabled',false);
            $(quantidade).css('display','inline-block');
        }
        else{
            $(quantidade).hide();
            $(quantidade).prop('disabled',true);
            
        }
        
    }   

    function adicionarPensamento(ref){
        
     $(' <input type="text" class="form-control col-md-4" style="display:inline-block;margin-bottom:1%"name="pensamento[]"> <input type="checkbox" value="1" style="margin-left:3%"name="pensamento_forte[]"><br>').insertAfter($(ref));
    }


 </script>



 
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