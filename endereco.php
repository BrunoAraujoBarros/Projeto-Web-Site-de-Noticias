<?php
$nomeErr = $emailErr = $mensagemErr = "";
$nome = $email = $mensagem = "";
$mensagem_enviada = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nome"])) {
        $nomeErr = "O campo Nome é obrigatório";
    } else {
        $nome = test_input($_POST["nome"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $nome)) {
            $nomeErr = "Apenas letras e espaços são permitidos no campo Nome";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "O campo E-mail é obrigatório";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Formato de e-mail inválido";
        }
    }

    if (empty($_POST["mensagem"])) {
        $mensagemErr = "O campo Mensagem é obrigatório";
    } else {
        $mensagem = test_input($_POST["mensagem"]);
    }

    
    if (empty($nomeErr) && empty($emailErr) && empty($mensagemErr)) {
        
      $destinatario = "seu-email@dominio.com"; // Substitua pelo seu endereço de e-mail
      $assunto = "Nova mensagem do formulário de contato";
      $corpo_mensagem = "Nome: $nome\n";
      $corpo_mensagem .= "E-mail: $email\n";
      $corpo_mensagem .= "Mensagem:\n$mensagem";
  
      
      mail($destinatario, $assunto, $corpo_mensagem);
        
        $mensagem_enviada = true;
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/globe-solid.svg">
    <title>Noticias Cidade</title>

    <!--CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="Css/estilo.css" type="text/css" rel="stylesheet">

</head>
  <body class="bg-info-subtle" >
    <!--Inicio cabecalho-->
    <header class="navbar navbar-expand-lg bg-dark-subtle shadow-lg p-3 mb-5 bg-body-tertiary rounded " >
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html"><i class="fa-solid fa-globe"> Noticias Cidade</i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="endereco.html">Endereço/Contato</a>
            </li>
          </ul>
        </div>
      </div>
  </header>
    <!--final cabecalho-->
    <section class="container">
        <div class="h4 pb-2 mb-4 text-dark border-bottom border-dark text-center container">
            Endereço
        </div>
        <div>
            
        </div>
        <div class="row">
            <div class="col-6 ">
                <h3>Mapa: Encontre nossa sede</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.0780709989626!2d-35.954661288570264!3d-8.295029583401085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!
            1s0x7a98a56da17a4b1%3A0x88b2099670852257!2sCaruaru%20Shopping!5e0!3m2!1spt-BR!2sbr!4v1698761984530!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen=""
             loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="shadow-lg p-3 mb-5 rounded">
            </iframe>
            </div>
            <div class="col-6 container-fluid text-center">
            <i class="fa-brands fa-wpforms"> Formulario de contato</i>
                <p><span class="error text-danger">* Campos obrigatórios</span></p>
                
                
              <?php if ($mensagem_enviada): ?>
                  <p>Obrigado por enviar seu formulário! Avalie nosso site <a href="link-para-formulario-de-avaliacao">aqui</a>.</p>
              <?php else: ?>
                  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="input-group mb-3">
                      <label for="name" class="form-label"><i class="fa-solid fa-user"> Nome: </i></label><br>
                      <br>
                      <input class="form-control rounded" type="text" name="nome" value="<?php echo $nome; ?>">
                      <span class="error"><br> <?php echo $nomeErr; ?></span>
                      <br><br>
                 </div>
                 <div class="input-group mb-3">
                      <label for="email" class="form-label"><i class="fa-solid fa-envelope"> E-mail: </i></label><br>
                      <br>
                      <input class="form-control rounded" type="text" name="email" value="<?php echo $email; ?>">
                      <span class="error"><br>  <?php echo $emailErr; ?></span>
                      <br><br>
                  </div>
                 <div class="input-group mb-3">
                      <label for="text" class="form-label rounded"><i class="fa-solid fa-comment"> Mensagem: </i></label><br>
                      <br>
                      <textarea class="form-control" name="mensagem" rows="5" cols="40"><?php echo $mensagem; ?></textarea>
                      <span class="error"><br>  <?php echo $mensagemErr; ?></span>
                      <br><br>
                  </div>
                      <input type="submit" name="submit" value="Enviar" class="submit">
                  </form>
              <?php endif; ?>


            </div>
          </div>
        </div>
        
    
    
    
    
    </section>
      
    <footer class="bg-secondary-subtle text-light text-center py-3">
      <div class="container px-4 text-center">
        <div class="row gx-5">
          <div class="col">
           <div class="p-3">
            <img src="img/globe-solid.svg" alt="" class="img-rodape">
           </div>
          </div>

          <div class="col">
            <div class="p-3">
              <p class="letra-rodape text-black">
                Av. Adjar da Silva Casé, 800 <br>
                Indianópolis Caruaru – Pernambuco – PE<br>
                CEP 55024-740 | Telefone 0800 771-5001<br>
                CNPJ 02.738.361/0001-65<br>
              </p>
              <div class="h4 pb-2 mb-4 text-dark container">
                <a href="" class="icon-rodape"><i class="fa-brands fa-facebook fa-2xs "></i></a>
                <a href="" class="icon-rodape"><i class="fa-brands fa-whatsapp fa-2xs "></i></a>
              </div>

            </div>
          </div>
        </div>
      </div>
  </footer>



     <!--Font Awesome-->   
    <script src="https://kit.fontawesome.com/d5b2f9fec7.js" crossorigin="anonymous"></script>   
    <!--Java-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>