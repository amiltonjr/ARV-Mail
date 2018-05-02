@extends('template')

@section('content')
    <div class="topo">
        <div class="col-1-2 centered">
            <a href="relatorioemails">
                Visualizar relatório de e-mails cadastrados
            </a>
        </div>
        <div class="col-1-2 centered">
            <a href="relatoriomensagens">
                Visualizar relatório de mensagens enviadas
            </a>
        </div>
    </div>

    <div class="col-1-2 centered new">
        <h2>Adicionar email</h2>
        <form METHOD="post" action="cadastra">
            <input type="text" name="novo_nome" placeholder="Nome">
            <input type="email" name="novo_email" placeholder="Endereço de email "><br>
            <select name="group_id">
                <option value="0" selected>- Nenhum -</option>
                <?php
                foreach($data[1] as $grupo){
                    echo '<option value="'.$grupo->getId().'">'.$grupo->getName().'</option>';
                }
                ?>
            </select>
            <button type="submit" name="novo">Novo</button><br>
        </form>

        <br>
        <form METHOD="post" action="cadastragrupo">
            <h2>Adicionar Grupo</h2>
            <input type="text" name="nome_grupo" class="full" placeholder="Grupo">
            <textarea name="descricao_grupo" class="mini" rows="3" cols="40" placeholder="Descricao"></textarea><br>
            <button type="submit" name="novo_grupo">Novo</button>
        </form>
    </div>
    <div class="col-1-2">
        <form METHOD="post" action="envia">
            <h2>Enviar email</h2>
            <input type="text" name="assunto" placeholder="Assunto"><br/>
            <textarea name="corpo_email" rows="10" cols="40" placeholder="Conteúdo"></textarea><br>
            <b>Destinatários</b>
            <div class="list-block" style="padding: 15px 10px;">
                <div class="row bold">
                    <div class="col-1-12">

                    </div>
                    <div class="col-3-12">
                        Nome
                    </div>
                    <div class="col-1-2">
                        Email
                    </div>
                    <div class="col-2-12">
                        Ação
                    </div>
                </div>
                <hr>
                <?php
                foreach ($data[0] as $item){
                    echo '<label><div class="row">';
                    echo    '<div class="col-1-12">';
                    echo        '<input type="checkbox" name="email_id[]" value="'.$item->getId().'">';
                    echo    '</div>';
                    echo    '<div class="col-3-12">';
                    echo        $item->getName();
                    echo    '</div>';
                    echo    '<div class="col-1-2">';
                    echo        $item->getEmail();
                    echo    '</div>';
                    echo    '<div class="col-2-12">';
                    echo        '<a href="exclui/'.$item->getId().'">Excluir</a>';
                    echo    '</div>';
                    echo '</div></label>';
                }
                ?>
            </div>
            <div class="centered">
                <button type="submit" name="enviar">Enviar</button>
            </div>
        </form>
    </div>
@endsection
