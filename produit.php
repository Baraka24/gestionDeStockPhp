<?php 
session_start();
if (empty($_SESSION['id'] )) 
{
  header("Location: index.php");
}
    include 'connexion.php';
    if (isset($_POST['valider'])) 
    {
        $categorie=htmlspecialchars($_POST['categorie']);
        $bdd-> query("INSERT INTO categorie VALUES (null, '$categorie')");
        $cat= "L'enregistrement réussi !";
    }

    if (isset($_POST['envoyer'])) 
    {
        $produit=htmlspecialchars($_POST['produit']);
        $alerte=htmlspecialchars($_POST['alerte']);
        $categorie=htmlspecialchars($_POST['categorie']);

        $files= $_FILES['photos'];
        $filename= $_FILES['photos']['name'];
        $fileerror= $files['error'];
        $filetmp=$files['tmp_name'];
        $fileext = explode(('.'), $filename);
        $fileckek = strtolower(end($fileext));
        $fileextsrom = array('jpg', 'png', 'gif', 'jpeg');
        $dosseir= "photos/".basename($filename);
        move_uploaded_file($filetmp, $dosseir);
        $bdd-> query("INSERT INTO produit VALUES (null, '$produit', '$alerte', '$filename', '$categorie')");
        $msg= "L'enregistrement réussi !";

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
       
<div class="row mt-5">

<div class="col-lg-12 mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-white text-center bg-noir p-2 ">Enregistrement des produits & catégories</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-left">
                        

          

                     <tbody>
                            <tr>
                                
                                 <td> <a class="btn bg-noir text-white " href="Admin.php">Retour</a></td>
                                 

                            </tr>
                        </tbody>

            
                           
                               


                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>





<div class="row">
    
    <div class="col-lg-4">
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="header-title text-center">Ajouter une Catégorie</h4>
                <form class="needs-validation " method="POST" novalidate="">
                     <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Catégorie</label>
                            <input type="text" class="form-control" id="validationCustom01" placeholder="Entrer la Catégorie"  required="" name="categorie" autocomplete="off">
                                                   
                        </div>
                                               
                    </div>
                    <p class="text-center"><?php if(isset($cat))echo $cat; ?></p>
                    <button class="btn bg-noir text-white w-100 mb-5 mt-5" type="submit" name="valider">Enregistrer</button>

               
                </form>

            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card mt-3">
            <div class="card-body">
                <div class="text-center">
                    <h4 class="header-title ">Ajouter un Produit</h4>
                </div>
                                        
                <form class="needs-validation " novalidate="" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Designation</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Designation" required="" autocomplete="off" name="produit">
                                                    
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Stock sécurité</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Stock sécurité" required="" autocomplete="off" name="alerte">
                                                    
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Photo</label>
                                <input type="file" class="form-control" id="validationCustom01"  required="" name="photos" >
                                                    
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
                            <p class="text-center"><?php if(isset($msg))echo $msg; ?></p>
                            <button class="btn bg-noir text-white w-50" type="submit" name="envoyer">Enregistrer</button>
                        </div>
                                            
                </form>
            </div>
         </div>
    </div>

</div>


        <div class="row">
        
 <div class="col-lg-3 mt-2 mb-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-center">Les catéories</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-noir">
                                <tr class="text-white">
                                    <th scope="col">N°</th>
                                    <th scope="col">Catégorie</th>
                                    
                                </tr>
                            </thead>

          

                     <tbody>
                        <?php 
                               $affichercat= $bdd->query("SELECT * FROM categorie ");
                                $num=0;
                                while($tab=$affichercat->fetch())
                                {
                                    $num+=1;
                                    ?> 
                                        <tr>
                                            <th scope="row"><?=$num;?></th>
                                             <td><?=$tab[1];?></td>
                                            
                                          
                                               
                                        </tr>
                                   <?php 
                                }
                         ?>
                      </tbody>

            
                           
                               


                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9 mt-2 mb-3">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-center">Les produits</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-noir">
                                <tr class="text-white">
                                    <th scope="col">N°</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Stock sécurité</th>
                                    <th scope="col">Catégorie</th>
                                     <th scope="col">Photo</th>
                                     <th scope="col">Action</th>
                                    
                                </tr>
                            </thead>

          

                     <tbody>
                        <?php 
                               $affichercat= $bdd->query("SELECT produit.id, produit.designation, produit.stockSecurite, produit.image,categorie.categorie  FROM produit , categorie WHERE produit.idcategorie=categorie.id ");
                                $num=0;
                                while($tab=$affichercat->fetch())
                                {
                                    $num+=1;
                                    ?> 
                                        <tr>
                                            <th scope="row"><?=$num;?></th>
                                            <td><?=$tab[1];?></td>
                                            <td><?=$tab[2];?></td>
                                            <td><?=$tab[4];?></td>
                                            <td><a href="detailProduit.php?id=<?=$tab[0];?>"><img style="width: 80px; height: 50px;" src="photos/<?=$tab[3];?>"></a></td>

                                            <td>
                                                <a class="btn bg-noir text-white" href="modifProduit.php?id=<?=$tab[0]; ?>">Modifier</a>
                                                <a class="btn bg-noir text-white" href="fiche.php?id=<?=$tab[0]; ?>&&produit=<?=$tab[1]; ?>">Fiche</a>
                                            </td>
                                               
                                        </tr>
                                         <?php 
                                }
                         ?>
                    </tbody>

            
                           
                               


                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    
</div>

</div>

<?php include 'scriptBoot.php'; ?>  
</body>

</html>