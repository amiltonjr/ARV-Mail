@extends('template')


@section('content')
    <div class="topo">
        <h2>Lista de emails por domínio</h2>
        <?php
        $list_consulta_dominio = Email::make()->select('Distinct domain')->find();
        foreach ($list_consulta_dominio as $key => $domain) {
            echo '<div class="co  l-3-12">';
            $dominioatual = $domain->getDomain();
            echo $dominioatual.'<br><br>';
            $list_email = Email::make()->all();
            //dump($list_email);
            foreach($list_email as $le => $email) {
                if($email->getDomain() == $dominioatual){
                    echo $email->getEmail()."<br>";
                }
            }
                echo'<br>';
        }

        ?>
    </div>


@endsection