@extends('store.templetes.main')

@section('content')
<h1 class="title">Escolha o meio de pagamento</h1>

<a href="#" id="payment-billet">
    <img  class="img-fluid" src="{{url('img/boleto.png')}}" width="" height="">
</a>

<!-- PRELOADER -->
<div class="preloader" style="display: none;">
    <img src="{{url('img/gif.gif')}}"  width='100px' height="100px">
</div>

<!-- para mandar o hash de seguranã -->
<form id='form' action=''>
    {!! csrf_field() !!}
</form>

@endsection

@push('scripts')

    <!-- == URL DO PAGAMENTO COM CHECKOUT TRANSPARENTE == -->
    <script src="{{config('pagseguro.url_transparente_js')}}"></script>

<script>
	$(function(){
		$('#payment-billet').click(function(){
			setSessionId();

            $(".preloader").show();

			return false;
		});
	});	

	// método que seta a sessão
    function setSessionId()
    {
        // para pegar os dados do formulário no caso o csrf
        var data = $('#form').serialize();

        $.ajax({
            // faz a requisição para está rota. e da um returno do ID.do usuario. 
           
            url: "{{route('pagseguro.code.tranparente')}}",
            method: 'POST',
            // esse data é o valor do csrf do form.
            data: data
            // pega o retorno dos dados da requisição acima. ID do usuário.
        }).done(function(data){
        	console.log(data);
        	// no link do pagseguro acima tem embutido essa classe.
            PagSeguroDirectPayment.setSessionId(data);

            paymentBillet();
            //executo os meios de pagamentos disponiveis.opcional
            //getPaymentMethods();
        }).fail(function(){
            $(".preloader").hide();
            alert('FAil request...');
        }).always(function(){

        });
    }

    // == METODO DE PAGAMENTO COM BOLETO == //
    function paymentBillet()
    {
        // retorna o hash do comprador.
        var sendHash = PagSeguroDirectPayment.getSenderHash();
        // concatenando os dados e enviando pelo formulário.
        var data = $('#form').serialize()+"&sendHash="+sendHash;

        $.ajax({
            // faz a requisição para está rota.
            url: "{{route('pagseguro.billet')}}",
            method: 'POST',
            data: data
            // é os dados que vem da model pagseguro
        }).done(function(data){
            console.log(data);
 
            if(data.success)
            {
               location.href=data.link;
            }
            else
            {
                alert('Falha!');
            }   

        }).fail(function(){
            alert('Fail request...');
        }).always(function(){
            $(".preloader").hide();
        });
    }
    // == FIM DO METODO DE PAGAMENTO COM BOLETO == //

</script>
@endpush