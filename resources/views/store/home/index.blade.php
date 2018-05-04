@extends('store.templetes.main')

@section('content')

<section class="products">

	<h1 class="title">Lançamento</h1>	

	@forelse($products as $product)
	<article class="product col-md-3 col-sm-4 col-xs-6">
		<img src='{{url("img/$product->image")}}'>
		<h4>{{$product->name}}</h4>

		<a href="{{route('add.cart', $product->id)}}" class="btn">Adicionar no carrinho</a>
	</article>
	@empty
	@endforelse

</section>

@endsection