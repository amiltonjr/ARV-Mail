@extends('template')


@section('content')
    <div class="topo">
        <h2>Lista de mensagens enviadas</h2>
        <form METHOD="post" action="pesquisa_mensagens">
            <input type="date" name="data_inicio" placeholder="Data início para pesquisa">
            <input type="date" name="data_fim" placeholder="Data fim para pesquisa">
            <button type="submit" name="pesquisar">Pesquisar</button>
    </div>

@endsection