@extends('template')


@section('content')
    <div class="topo">
        <h2>Lista de emails por domínio</h2>
        <?php
        foreach($data[1] as $grupo){
            dump($grupo->getId());
        }
        ?>
    </div>


@endsection