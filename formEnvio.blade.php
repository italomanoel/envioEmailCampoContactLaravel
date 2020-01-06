@extends('layouts.HomePadrao')
@section('conteudo')
    <div class="row">
        <form action="{{action('EnvioEmailController@envioE')}}" method="POST">
            {{ csrf_field() }}
          <!-- Para enviar dados que estão no db, necessário em certos formulários a serem usados -->
            <label for="">
                <input type="hidden" name="c" value="{{ $tabela->coluna }}">
                <input type="hidden" name="g" value="{{ $tabela->coluna }}">
            </label>
            <label for="email">Email: <br>
                <input type="email" name="email">
            </label><br>
            <label for="telefone">Telefone Fixo: <br>
                <input type="text" name="telefone" placeholder="(61)9999-9999">
            </label><br>
            <label for="celular">Celular: <br>
                <input type="text" name="celular" placeholder="(61)99999-9999">
            </label><br>
            <label for="mensagem">Mensagem: <br>
                <textarea type="text" name="mensagem"></textarea>
            </label><br>
            <label for="">
                <button class="btn btn-success" type="submit" >Enviar</button>
            </label>
        </form>
    </div>
</div>
@endsection
