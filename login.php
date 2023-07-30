<?php 
        include 'connexion.php';
        session_start();
        if (isset($_POST['valider']))
         {
               $nom=htmlspecialchars($_POST['nom']);
               $motdepasse=htmlspecialchars($_POST['motdepasse']);
               $recuperUser= $bdd->prepare("SELECT * FROM utilisateur WHERE nom='$nom'  AND pwd='$motdepasse'");
               $recuperUser->execute();
                $recup = $recuperUser->fetch();
                if($recup)
                {
                    if($recup[6]=='Magazinier')
                    {
                         $_SESSION['id']=$recup['id'];
                         header("Location: Admin.php");
                    }

                    if($recup[6]=='Comptable')
                    {
                         $_SESSION['id']=$recup['id'];
                         header("Location: comptable.php");
                    }

                    if($recup[6]=='Gerant')
                    {
                         $_SESSION['id']=$recup['id'];
                         header("Location: comptable.php");
                    }
                     if($recup[6]=='Founisseur')
                    {
                         $_SESSION['id']=$recup['id'];
                         header("Location: fournisseur.php");
                    }

                   
                }
                else
                {
                    $erreur= 'Mot de passe incorrect ';
                  
                }
        }
        

 ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php 
        include "lient.php";
      ?>
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
   
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="Post">
                    <div class="login-form-head bg-noir">
                        <h4>Connectez-vous ici</h4>
                       
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Entrer le nom</label>
                            <input type="text" id="exampleInputEmail1" name="nom" required autocomplete="off">
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Entrer le mot de passe</label>
                            <input type="password" id="exampleInputPassword1" name="motdepasse" required autocomplete="off">
                            <i class="ti-lock"></i>
                        </div>
                       <p class="text-danger mb-2 text-center">
                        <?php if(isset($erreur))echo $erreur; ?>
                             </p>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" name="valider">Se connecter </button>
                            
                        </div>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <?php include 'scriptBoot.php'; ?>  
</body>

</html>