<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
</head>


<body>
    <div>
        <h3>Adicionar email</h3>
        <form METHOD="post" action="cadastra">
            <input type="text" name="novo_nome" placeholder="Nome"><br>
            <input type="email" name="novo_email" placeholder="endereço de email ">
            <input type="submit" name="novo" value="Novo"><br>
        </form>

        <form METHOD="post" action="envia">
        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Email</th>
            </tr><br>
            <?php
            foreach ($data as $item){
             echo"<tr>
                    <td>".$item->getNome()."</td>
                    <td>".$item->getEmail()."</td>
                    <td><input type='checkbox' name='email_id[]' value='".$item->getId()."' ></td>
                    <td><a href='exclui/".$item->getId()."'>Excluir</a></td>
                  </tr>";
            }
            ?>
        </table>
    </div>
    <div>
        <h2>Enviar email</h2>
        <input type="text" name="assunto" placeholder="Assunto"><br/>
        <textarea name="corpo_email" rows="10" cols="40"></textarea><br>
        <input type="submit" name="enviar" value="Enviar">
    </div>
    </form>
</body>

</html>
