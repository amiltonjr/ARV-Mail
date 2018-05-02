@extends('template')


@section('content')
    <div class="topo">
        <div class="col-1-2 centered">
            <a href="<?=SYSROOT?>">
                Voltar
            </a>
        </div>
        <div class="col-1-2 centered">
            <a href="relatorioemails/exportar">
                Exportar para TXT
            </a>
        </div>
    </div>

    <h2>Lista de emails por domínio</h2>
    <br>
    <?php
    foreach ($data as $key => $domain) {
        echo '<div class="col-3-12">';
        echo '<b>Domínio:</b> <i>'.$domain['dominio']->getDomain().'</i><br><br>';
        foreach($domain['emails'] as $le => $email) {
            echo '- '.$email->getEmail()."<br>";
        }
        echo'</div>';
    }
    ?>


@endsection