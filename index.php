<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Jogos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Jogos</h2>
                        <a href="create.php" class="btn btn-success pull-right">Adicionar Novo Jogo</a>
                    </div>
                    <?php
                    //Fazendo a conexão com o bc
                    require_once "configuracao_mysql.php";
                    //Realizando o select dos dados 
                    $sql = "SELECT * FROM jogos";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nome</th>";
                                        echo "<th>Plataforma</th>";
                                        echo "<th>Preço</th>";
                                        echo "<th>Ação</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
								//Mostrando o select
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nome'] . "</td>";
                                        echo "<td>" . $row['plataforma'] . "</td>";
                                        echo "<td>" . $row['preco'] . "</td>";
                                        echo "<td>";
                   
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Realizar Update' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Deletar Jogo' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                           
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>Não foram encontrados registros</em></p>";
                        }
                    } else{
                        echo "ERROR $sql." . $mysqli->error;
                    }
                    
                    unset($pdo);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>