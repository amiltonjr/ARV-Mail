@extends('template')


@section('content')
    <div class="topo">
        <h2>Lista de mensagens enviadas</h2>
        <form METHOD="get" action="pesquisa_mensagens">
            <input type="date" name="data_inicio" placeholder="Data início para pesquisa">
            <input type="date" name="data_fim" placeholder="Data fim para pesquisa">
            <button type="submit" name="pesquisar">Pesquisar</button>
    </div>
    <div>
        <?php
        if(isset($data)) {
            foreach ($data as $item) {
                echo '<label><div class="row">';
                echo '<div class="col-3-12">';
                echo $item->getSubject();
                echo '</div>';
                echo '<div class="col-1-2">';
                echo $item->getMessage();
                echo '</div>';
                echo '<div class="col-1-2">';
                echo $item->getSendTime();
                echo '</div>';
                $email = Email::make()->get(1);
                echo $email->getEmail();
                echo '</div>';
                echo '</div></label>';
            }
        }

        ?>

    </div>

@endsection