<?php

require_once "configuracao_mysql.php";
 
$nome = $plataforma = $preco = "";
$nome_err = $plataforma_err = $preco_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
	//Validação do nome
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_err = "Nome é um campo obrigatório";
    }
    else{
        $nome = $input_nome;
    }
    
    //Validação da plataforma
    $input_plataforma = trim($_POST["plataforma"]);
    if(empty($input_plataforma)){
        $plataforma_err = "Plataforma é um campo obrigatório";     
    } else{
        $plataforma = $input_plataforma;
    }
    
    //Validação do preço
    $input_preco = trim($_POST["preco"]);
    if(empty($input_preco)){
        $preco_err = "Salario é um campo obrigatório";     
    } elseif(!ctype_digit($input_preco)){
        $preco_err = "O salario deve ser positivo";
    } else{
        $preco = $input_preco;
    }
    
    
    if(empty($$nome_err) && empty($plataforma_err) && empty($preco_err)){
        
        $sql = "INSERT INTO jogos (nome, plataforma, preco) VALUES (:nome, :plataforma, :preco)";
 
        if($stmt = $pdo->prepare($sql)){
          
            $stmt->bindParam(":nome", $param_nome);
            $stmt->bindParam(":plataforma", $param_plataforma);
            $stmt->bindParam(":preco", $param_preco);
            
            
            $param_nome = $nome;
            $param_plataforma = $plataforma;
            $param_preco = $preco;
            
            
            if($stmt->execute()){
				
                header("location: index.php");
                exit();
            } else{
                echo "Algo deu errado";
            }
        }
         
        unset($stmt);
    }
	
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Jogo</title>
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
                        <h2>Cadastrar Jogo</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nome_err)) ? 'has-error' : ''; ?>">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
                            <span class="help-block"><?php echo $nome_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($plataforma_err)) ? 'has-error' : ''; ?>">
                            <label>Plataforma</label>
                            <input name="plataforma" class="form-control" value="<?php echo $plataforma; ?>">
                            <span class="help-block"><?php echo $plataforma_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($preco_err)) ? 'has-error' : ''; ?>">
                            <label>Preço</label>
                            <input type="text" name="preco" class="form-control" value="<?php echo $preco; ?>">
                            <span class="help-block"><?php echo $preco_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>