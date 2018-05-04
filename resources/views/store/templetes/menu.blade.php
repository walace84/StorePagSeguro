<nav class="navbar navbar-default menu-header">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{route('home')}}">
        <img src="{{url('img/log.png')}}" class="logo">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
 

      <ul class="nav navbar-nav navbar-right">

        <!-- SE EXISTE ESSA SESSÃO ENTÃO MOSTRE O TOTAL DE ITENS -->
        <li>
          <a href="{{url('carrinho')}}">Carrinho <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> <span class="badge">
            @if( Session::has('carrinho') )
                {{ Session::get('carrinho')->totalItens() }}
            @else
                0
            @endif
          </span> </a>
        </li>

        <!-- FAZENDO O LOGIN -->
        @if( auth()->check() )
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{route('profile')}}">Meu perfil</a></li>
            <li><a href="{{route('password')}}">Minha senha</a></li>
            <li><a href="{{route('my.orders')}}">Meus pedidos</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{route('logout')}}">Sair</a></li>
          </ul>
        </li>
        @else
        <li>
          <a href="{{route('login')}}">Login/Cadastrar</a>
        </li>
        @endif

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>