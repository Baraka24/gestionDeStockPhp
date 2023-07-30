<?php 
session_start();
if (empty($_SESSION['id'] )) 
{
  header("Location: index.php");
}
    include 'connexion.php';
if (!empty($_GET['id'])) {
    

    if (isset($_POST['envoyer'])) 
    {
       $produit=htmlspecialchars($_POST['produit']);
        $alerte=htmlspecialchars($_POST['alerte']);
        $categorie=htmlspecialchars($_POST['categorie']);

        $files= $_FILES['photos'];
        $filename= $_FILES['photos']['name'];
        if (empty($filename)) {
            $filename= htmlspecialchars($_POST['photosDefon']);
        }
        else
        {
            $fileerror= $files['error'];
            $filetmp=$files['tmp_name'];
            $fileext = explode(('.'), $filename);
            $fileckek = strtolower(end($fileext));
            $fileextsrom = array('jpg', 'png', 'gif', 'jpeg');
            $dosseir= "photos/".basename($filename);
            move_uploaded_file($filetmp, $dosseir);
        }
        $id=$_GET['id'];
        $bdd-> query("UPDATE  produit SET designation='$produit', stockSecurite='$alerte', image='$filename', idcategorie='$categorie' WHERE id='$id'");
        $msg= "L'enregistrement réussi !";

         header("location:produit.php");
    }
}
 ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Produits</title>
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

    <div class="col-lg-8">
        <div class="card mt-5">
            <div class="card-body">
                <div class="text-center">
                    <h4 class="header-title ">Modifier un Produit</h4>
                </div>
                                        
                <form class="needs-validation " novalidate="" method="POST" enctype="multipart/form-data">
                     <?php 
                  $id=$_GET['id'];
                  $affichercat= $bdd->query("SELECT * FROM produit WHERE id='$id' ");
                  if($tab=$affichercat->fetch())
                   {
                 
                      ?>
                    <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Designation</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Designation" required="" autocomplete="off" name="produit" value="<?=$tab[1]; ?>">
                                                    
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Stock sécurité</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Stock sécurité" required="" autocomplete="off" name="alerte" value="<?=$tab[2]; ?>">
                                                    
                            </div>

                                <input type="text" hidden name="photosDefon" value="<?=$tab[3]; ?>" >
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Photo</label>
                                <input type="file" class="form-control" id="validationCustom01"   name="photos" >
                                                    
                            </div>
                            <div class="col-md-6 mb-3">
                                
                                <label for="validationCustom02">Catégorie</label>
                                <select  class="form-control p-1"  required="" id="validationCustom02" name="categorie">
                                    <?php 
                                      $affichercat= $bdd->query("SELECT * FROM categorie ");
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
                           
                            <button class="btn bg-noir text-white w-50" type="submit" name="envoyer">Enregistrer</button>
                      <?php 
                        }
                   ?>     </div>
                                            
                </form>
            </div>
         </div>
    </div>

</div>


</div>


<?php include 'scriptBoot.php'; ?>  
</body>

</html>