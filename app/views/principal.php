<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <title>Email[er]</title>
    <link rel="stylesheet" href="<?=asset('styles/style_principal.css')?>">
</head>


<body>
    <div class="container">
        <div class="col-1-2 centered new">
            <h2>Adicionar email</h2>
            <form METHOD="post" action="cadastra">
                <input type="text" name="novo_nome" placeholder="Nome">
                <input type="email" name="novo_email" placeholder="Endereço de email ">
                <button type="submit" name="novo">Novo</button><br>
            </form>

            <br>

            <form METHOD="post" action="envia">
                    <h3>Destinatários</h3>
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
                    foreach ($data as $item){
                        echo '<label><div class="row">';
                        echo    '<div class="col-1-12">';
                        echo        '<input type="checkbox" name="email_id[]" value="'.$item->getId().'">';
                        echo    '</div>';
                        echo    '<div class="col-3-12">';
                        echo        $item->getNome();
                        echo    '</div>';
                        echo    '<div class="col-1-2">';
                        echo        $item->getEmail();
                        echo    '</div>';
                        echo    '<div class="col-2-12">';
                        echo        '<a href="exclui'.$item->getId().'">Excluir</a>';
                        echo    '</div>';
                        echo '</div></label>';
                    }
                    ?>
                </div>
        </div>
        <div class="col-1-2">
            <h2>Enviar email</h2>
            <input type="text" name="assunto" placeholder="Assunto"><br/>
            <textarea name="corpo_email" rows="10" cols="40" placeholder="Conteúdo"></textarea><br>
            <button type="submit" name="enviar">Enviar</button>
        </div>
        </form>
    </div>
</body>

</html>