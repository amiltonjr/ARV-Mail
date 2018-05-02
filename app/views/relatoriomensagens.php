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

    <h2>Lista de mensagens enviadas</h2>
    <form METHOD="post" action="">
        <b>Filtrar por datas:</b><br>
        <input type="date" name="data_inicio" placeholder="Data início(dd/mm/yyyy)"
               value="<?= isset($_POST['data_inicio']) ? $_POST['data_inicio'] : '' ?>">
        <input type="date" name="data_fim" placeholder="Data fim (dd/mm/yyyy)"
               value="<?= isset($_POST['data_fim']) ? $_POST['data_fim'] : '' ?>">
        <button type="submit" name="pesquisar">Pesquisar</button>
    </form>

    <div class="clearfix"></div>
    <br><br>

    <div class="list-block full" style="padding: 15px 10px;">
        <div class="row bold">
            <div class="col-2-12">
                Assunto
            </div>
            <div class="col-1-2">
                Mensagem
            </div>
            <div class="col-2-12">
                Data/hora
            </div>
            <div class="col-2-12">
                Email
            </div>
        </div>
        <hr>
        <?php
        foreach ($data as $k => $item){
            echo '<label><div class="row">';
            echo    '<div class="col-2-12">';
            echo        $item[0]->getSubject();
            echo    '</div>';
            echo    '<div class="col-1-2">';
            echo        $item[0]->getMessage();
            echo    '</div>';
            echo    '<div class="col-2-12">';
            echo        date('d/m/Y, H:i:s', strtotime($item[0]->getSendTime()));
            echo    '</div>';
            echo    '<div class="col-2-12">';
            echo        $item[1]->getEmail();
            echo    '</div>';
            echo '</div></label>';
        }
        ?>
    </div>

@endsection