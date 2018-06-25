

@foreach($servico->servicos_traducoes as $s)

    <img src="{{ asset('/imagens/' . $servico->imagem)}}" alt="{{$s->designacao}}" class="img-fluid"/>

    <p class="margin-top">{{$s->descricao}}</p>

@endforeach