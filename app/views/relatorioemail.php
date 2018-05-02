@extends('template')


@section('content')
    <div class="topo">
        <div class="col-1-2 centered">
            <a href="<?=SYSROOT?>">
                Voltar
            </a>
        </div>
        <div class="col-1-2 centered">
            <a href="#">
                Exportar para TXT
            </a>
        </div>
    </div>

    <h2>Lista de emails por domínio</h2>
    <br>
    <?php
    foreach ($data as $key => $domain) {
        echo '<div class="col-3-12">';
        $dominioatual = $domain->getDomain();
        echo '<b>Domínio:</b> <i>'.$dominioatual.'</i><br><br>';
        $list_email = Email::make()->all();
        foreach($list_email as $le => $email) {
            if($email->getDomain() == $dominioatual){
                echo '- '.$email->getEmail()."<br>";
            }
        }
        echo'</div>';
    }

    ?>


@endsection