@extends('store.templetes.main')

@section('content')

<h1 class="title"> Atualizar senha</h1>

    <!-- RETURNO DAS MESSAGENS -->
    @if( session('message') )
    <div class="alert alert-success">
        <p>{{session('message')}}</p>
    </div>
    @endif

    @if( session('error') )
    <div class="alert alert-danger">
        <p>{{session('error')}}</p>
    </div>
    @endif

    <!-- validação dos dados do formulario -->
    @if(isset($errors) && $errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <p>{{$error}}</p>
        </div>
        @endforeach
    @endif

<form method="POST" class="form-custon" action="{{route('password.update')}}">

	{{ csrf_field() }}


    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password">Senha</label>

        <input id="password" type="password" class="form-control" name="password" required>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="password-confirm">Confirma senha</label>

        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
    </div>

  


  <button type="submit" class="btn btn-botao">Atualiza senha</button>
</form>

@endsection