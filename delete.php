<?php

if(isset($_POST["id"]) && !empty($_POST["id"])){
   
    require_once "configuracao_mysql.php";
    
    
    $sql = "DELETE FROM jogos WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        
        $stmt->bindParam(":id", $param_id);
        
       
        $param_id = trim($_POST["id"]);
        
       
        if($stmt->execute()){
            
            header("location: index.php");
            exit();
        } else{
            echo "Algo deu errado";
        }
    }
     

    unset($stmt);
    
   
    unset($pdo);
} else{
  
    if(empty(trim($_GET["id"]))){
       
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Deletar Jogo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Deletar Jogo</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Tem certeza que quer deletar esse jogo ?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>