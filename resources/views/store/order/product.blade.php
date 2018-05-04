@extends('store.templetes.main')

@section('content')

	<h1 class="title">Produtos da ordem {{$order->reference}}</h1>

	<table class="table table-striped">
		<tr>
			<th>Nome</th>
			<th>Descrição</th>
			<th>Quantidade</th>
			<th>Preço</th>
		</tr>

	
		<!-- trás os dados da tabela product, e os dados da tabela  product_order-->
		@forelse($products as $product)
		<tr>
    		<td>{{$product->name}}</td>
    		<td>{{$product->description}}</td>
    		<td>{{$product->pivot->qtd}}</td>
    		<td>{{$product->pivot->price}}</td>
    	<tr>
    		@empty
    			<p>Nenhum pedido!</p>
		@endforelse

	</table>

@endsection	