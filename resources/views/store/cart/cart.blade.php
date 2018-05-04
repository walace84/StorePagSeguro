@extends('store.templetes.main')

@section('content')

	<h1 class="title">Meu Carrinhho</h1>	

	<!-- MESSAGE CASO O USUARIO TENTE FINALIZAR A COMPRA SEM ITENS -->
	@if( session('error') )
    <div class="alert alert-danger">
        <p>{{session('error')}}</p>
    </div>
    @endif

	<table class="table table-striped">
		
		<tr>
			<th>Item</th>
			<th>Preço</th>
			<th>Quantidade</th>
			<th>Sub. Total</th>
		</tr>

		@foreach($products as $product)
		<tr>
			<td>
				<img src='{{ url("img/{$product["item"]->image}") }}' class="img-cart">
				{{$product['item']->name}}
			</td>
			<td>R$ {{$product['item']->price}}</td>
			<td>
				<a href="{{ route('add.cart', $product['item']->id) }}" class="cart-action-item">+</a>
				{{$product['qtd']}}
				<a href="{{ route('remove.cart', $product['item']->id) }}" class="cart-action-item">-</a>
			</td>
			<td>R$ {{$product['item']->price * $product['qtd']}}</td>
		</tr>
		@endforeach



	</table>

	<div class="col-md-12">
		<div class="total-cart"><span>R$ {{$cart->total()}}</span></div>	
	</div>

	<div class="col-md-12">
		<div class="finish-cart">
			<a href="{{route('method.payment')}}">Finalizar compra</a>
		</div>
	</div>

@endsection