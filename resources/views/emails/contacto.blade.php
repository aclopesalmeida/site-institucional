@if(!is_null($request['nome']))
<h4>Nome: {{ $request->get('nome') }}</h4>
@endif
<h4>Email: {{ $request->get('email') }}</h4>

<p>{{ $request->get('mensagem') }}</p>