<?php 
session_start();
if (empty($_SESSION['id'] )) 
{
  header("Location: index.php");
}
 include 'connexion.php';
        if (isset($_POST['envoyer'])) 
        {
             $produit=htmlspecialchars($_POST['produit']);
             $quantite=htmlspecialchars($_POST['quantite']);
             $prix=htmlspecialchars($_POST['prix']);
             $description=htmlspecialchars($_POST['description']);
             $date=htmlspecialchars($_POST['date']);
            if (is_numeric($prix)) 
            {
              $id=$_GET['id'];
                if (is_numeric($quantite)) 
                  {
                    $bdd-> query("UPDATE  sorties SET dates='$date', idProduit='$produit', quantite='$quantite', prix='$prix', description='$description' WHERE id='$id'");
                    header("location:sorties.php");
             
                  }
                  else
                      {
                        $msgsuc= "La quantité doit être un nombre";
                      }
            }
            else
            {
              $msgsuc= "Le prix doit être un nombre";
            }
            
        }

 ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sorties</title>
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
    <!-- Baraka Kinywa code -->
    <?php
    include 'style.php';
    ?>
     <!-- Baraka Kinywa code -->
</head>

<body style="background: #F1F1F1;">

  <!--  barre de navigation -->

<?php 

include "navBar.php";
 ?>

    <!-- KKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK -->

   <div class="container">
       






<div class="row">
    
   

    <div class="col-lg-6">
        <div class="card ">
            <div class="card-body">
                <div class="text-center">
                    <h4 class="header-title text-white text-center bg-noir p-2">Modifier une Sortie</h4>
                </div>
                                        
                <form class="needs-validation " novalidate="" method="POST">
                   <?php 
                                $id=$_GET['id'];
                               $affichercat5= $bdd->query("SELECT * FROM sorties WHERE id='$id' ");
                                while($tab=$affichercat5->fetch())
                                {
                                    ?> 
                               <div class="form-row">
                         
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Quantité</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Quantité" required="" autocomplete="off" name="quantite" value="<?=$tab[3]; ?>">
                                                    
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Prix unitaire</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Prix unitaire" required="" autocomplete="off" name="prix" value="<?=$tab[4]; ?>">
                                                    
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Date</label>
                                <input value="<?=$tab[1]; ?>" type="date" class="form-control" id="validationCustom02" placeholder="Description " required="" autocomplete="off" name="date">
                                                    
                            </div>
                             <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Description</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Description " required="" autocomplete="off" name="description"  value="<?=$tab[5]; ?>">
                                                    
                            </div>
                                           <?php 
                                }
                         ?>
                           
                                <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Produit</label>
                                <select class="form-control p-1"  required="" id="validationCustom02" name="produit">
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
                           
                            <?php 

                                if(isset($msgsuc))
                                {
                                  ?>
                                  <div class="alert alert-danger" role="alert">
                                            <strong>Alerte!</strong> <?=$msgsuc; ?>
                                  <?php 
                                }

                             ?>
                            </div>
                            <button class="btn bg-noir p-2 text-white w-50" type="submit" name="envoyer">Enregistrer</button>
                        </div>
                                            
                </form>
            </div>
         </div>
    </div>

  

</div>







</div>









    <?php include 'scriptBoot.php'; ?>  

     <!-- ============ Java Script Files  ================== -->
    <?php
    include 'scriptPrint.php';
    ?>
    <!-- ============ Java Script Files  ================== -->
</body>

</html>