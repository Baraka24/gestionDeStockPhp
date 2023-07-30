<?php 
include 'connexion.php';
session_start();
if (empty($_SESSION['id'] )) 
{
  header("Location: index.php");
}
if (!empty($_GET['id'])) {
    $id=$_GET['id'];

    if (isset($_POST['envoyer'])) 
    {
        $nom=htmlspecialchars($_POST['nom']);
        $prenom=htmlspecialchars($_POST['prenom']);
        $genre=htmlspecialchars($_POST['genre']);
        $fonction=htmlspecialchars($_POST['fonction']);
        $bdd-> query("UPDATE  utilisateur SET nom='$nom', prenom='$prenom', genre='$genre', role='$fonction' WHERE id='$id' ");
         header("location:AdAdmin.php");
    }
}

    

 ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Utilisateur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php 
        include "lient.php";
      ?>

    <style >
        .bg-noir
        {
            background-color: #333;
        }
    </style>


    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body style="background: #F1F1F1;">

  <!--  barre de navigation -->

<?php 

include "navBar.php";
 ?>

    <!-- KKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK -->

   <div class="container">
       






<div class="row mt-3">
    
   

    <div class="col-lg-6">
        <div class="card mt-5">
            <div class="card-body">
                <div class="text-center">
                    <h4 class="header-title text-white text-center bg-noir p-2">Modifier un utilisateur</h4>
                </div>
                                        
                <form class="needs-validation " method="POST" novalidate="" enctype="multipart/form-data">
                       <?php 
                       $id=$_GET['id'];
                  $affichercat= $bdd->query("SELECT * FROM utilisateur WHERE id='$id' ");
                  if($tab=$affichercat->fetch())
                   {
                 
                      ?>

                    <div class="form-row">

                         <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Nom</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Nom" required="" name="nom" autocomplete="off" value="<?=$tab[1]; ?>">
                                                    
                            </div>
                             <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Prénom</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Prénom" required="" name="prenom" autocomplete="off" value="<?=$tab[2]; ?>">
                                                    
                            </div>
                         <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Genre</label>
                                <select  class="form-control p-1"  required="" name="genre" id="validationCustom02">
                                                        
                                    <option>Masculin</option>
                                    <option>Féminin</option>
                                </select>
                    
                            </div>

                             <div class="col-md-6 mb-3">
                                <label for="validationCustom02">fonction</label>
                                <select  class="form-control p-1"  required="" name="fonction" id="validationCustom02">
                                                        
                                    <option>Magazinier</option>
                                    <option>Comptable</option>
                                    <option>Gégant</option>
                                    <option>Founisseur</option>
                                </select>
                    
                            </div>
                    
                        </div>

                        <div class="text-center">
                            <p class="text-success"><?php if(isset($msg) )echo $msg; ?></p>
                            <button class="btn bg-noir text-white w-100" type="submit" name="envoyer">Enregistrer</button>
                        </div>
                           <?php 
                        }
                            ?>                   
                </form>
            </div>
         </div>
    </div>

</div>


</div>


<?php include 'scriptBoot.php'; ?>  
</body>

</html>