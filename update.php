<?php

require_once "configuracao_mysql.php";
 
$nome = $plataforma = $preco = "";
$nome_err = $plataforma_err = $preco_err = "";
 
if(isset($_POST["id"]) && !empty($_POST["id"])){
   
    $id = $_POST["id"];
  
    //Validação do nome
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_err = "Nome é um campo obrigatório"; 
    } else{
        $nome = $input_nome;
    }
     //Validação da plataforma
    $input_plataforma = trim($_POST["plataforma"]);
    if(empty($input_plataforma)){
        $plataforma_err = "Plataforma é um campo obrigatório.";     
    } else{
        $plataforma = $input_plataforma;
    }
    //Validação do preço
    $input_preco = trim($_POST["preco"]);
    if(empty($input_preco)){
        $preco_err = "Salario é um campo obrigatório";     
    } elseif(!ctype_digit($input_preco)){
        $preco_err = "O salario deve ser positivo.";
    } else{
        $preco = $input_preco;
    }
    
    if(empty($nome_err) && empty($address_err) && empty($salary_err)){
        
        $sql = "UPDATE jogos SET nome=:nome, plataforma=:plataforma, preco=:preco WHERE id=:id";
 
        if($stmt = $pdo->prepare($sql)){
           
            $stmt->bindParam(":nome", $param_nome);
            $stmt->bindParam(":plataforma", $param_plataforma);
            $stmt->bindParam(":preco", $param_preco);
            $stmt->bindParam(":id", $param_id);
            
          
            $param_nome = $nome;
            $param_plataforma = $plataforma;
            $param_preco = $preco;
            $param_id = $id;
            
            
            if($stmt->execute()){
                
                header("location: index.php");
                exit();
            } else{
                echo "Algo deu Errado";
            }
        }
         
        unset($stmt);
    }
    

    unset($pdo);
} else{
   
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        
        
        $sql = "SELECT * FROM jogos WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            
            $stmt->bindParam(":id", $param_id);
            
          
            $param_id = $id;
            
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    $nome = $row["nome"];
                    $plataforma = $row["plataforma"];
                    $preco = $row["preco"];
                } else{
                   
                    echo "Erro";
                    exit();
                }
                
            } else{
                echo "Algo deu Errado";
            }
        }
        
        unset($stmt);
        
        unset($pdo);
    }  else{
         echo "Erro";
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Jogo</title>
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
                        <h2>Update Jogo</h2>
                    </div>
                
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nome_err)) ? 'has-error' : ''; ?>">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
                            <span class="help-block"><?php echo $nome_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($plataforma_err)) ? 'has-error' : ''; ?>">
                            <label>Plataforma</label>
                            <textarea name="plataforma" class="form-control"><?php echo $plataforma; ?></textarea>
                            <span class="help-block"><?php echo $plataforma_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($preco_err)) ? 'has-error' : ''; ?>">
                            <label>Preco</label>
                            <input type="text" name="preco" class="form-control" value="<?php echo $preco; ?>">
                            <span class="help-block"><?php echo $preco_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

