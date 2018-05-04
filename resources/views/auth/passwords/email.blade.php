@extends('store.templetes.main')

@section('content')
<div class="container">
<h1 class="title">Recuperar senha</h1>

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
  
<form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email">E-Mail</label>

        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            Recuperar Senha
        </button>
    </div>
</form>

</div>
@endsection
