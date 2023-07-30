<?php 
session_start();
if (empty($_SESSION['id'] )) 
{
  header("Location: index.php");
}
include 'connexion.php';


if (isset($_POST['envoyer'])) {
   $produit=htmlspecialchars($_POST['produit']);
   $quantite=htmlspecialchars($_POST['quantite']);
   $description = htmlspecialchars($_POST['description']);
   $date=htmlspecialchars($_POST['date']);
   $mesure=htmlspecialchars($_POST['mesure']);

   if (is_numeric($quantite)   ) 
   {
       if (is_numeric($mesure))
       {
        $id=$_GET['id'];
           $bdd-> query("UPDATE  entrees SET dates='$date', idProduit='$produit', quantite='$quantite', prix='$mesure', description='$description' where id ='$id'");
           header('location:entrees.php');
       }
       else
       {
          $msg= "la mesure doit etre un nombre";
       }
   }
   else
   {
      $msg= "la quantite doit etre un nombre";
   }

}
 ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Entrées</title>
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
                     <h4 class="header-title text-white text-center bg-noir p-2 ">Modifier une Entrée</h4>
                </div>
                                        
                <form class="needs-validation " novalidate="" method="POST">
                    <?php 
                  $id=$_GET['id'];
                  $affichercat= $bdd->query("SELECT * FROM entrees WHERE id='$id'  ");
                  if($tab=$affichercat->fetch())
                   {
                 
                      ?>
                    <div class="form-row">
                         <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Date</label>
                                <input type="date" class="form-control" id="validationCustom02" placeholder=" Qauntité" required="" value="<?=$tab[1]; ?>"  name="date" autocomplete="off">

                                                    
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Qauntité</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder=" Qauntité" required="" name="quantite" value="<?=$tab[3];?>"  autocomplete="off">
                                                    
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Prix unitaire</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Prix unitaire" required="" name="mesure" value="<?=$tab[4]; ?>" autocomplete="off">
                                                    
                            </div>
                           <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Description(mesure)</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Description" required="" name="description" value="<?=$tab[5]; ?>" autocomplete="off">
                                                    
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Produit</label>
                                <select  class="form-control p-1"  required="" id="validationCustom02" name="produit">
                                    <?php 
                                      $affichercat= $bdd->query("SELECT * FROM produit ");
                                      while($tab=$affichercat->fetch())
                                       {
                                           ?>              
                                    <option value="<?=$tab[0];?>"><?=$tab[1];?></option>
                                            <?php 
                                        }
                                    ?>
                                </select>
                    
                            </div>
                                                
                        </div>

                        <div class="text-center">
                            
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