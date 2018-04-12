<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
</head>


<body>
    <div>
        <form METHOD="post">
            <input type="text" name="novo_nome" placeholder="Nome"><br>
            <input type="text" name="novo_email" placeholder="endereço de email ">
            <input type="submit" value="Novo"><br>
        </form>
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
                  </tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>
