<?php 
include 'connexion.php';
session_start();
if (empty($_SESSION['id'] )) 
{
  header("Location: index.php");
}
if (isset($_POST['envoyer'])) {
    $nom=htmlspecialchars($_POST['nom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $genre=htmlspecialchars($_POST['genre']);
    $password=htmlspecialchars($_POST['password']);
    $fonction=htmlspecialchars($_POST['fonction']);


    $files= $_FILES['photos'];
    $filename= $_FILES['photos']['name'];
    $fileerror= $files['error'];
    $filetmp=$files['tmp_name'];
    $fileext = explode(('.'), $filename);
    $fileckek = strtolower(end($fileext));
    $fileextsrom = array('jpg', 'png', 'gif', 'jpeg');
    $dosseir= "image/".basename($filename);
    move_uploaded_file($filetmp, $dosseir);


    $bdd-> query("INSERT INTO utilisateur VALUES (null, '$nom', '$prenom', '$genre', '$password', '$filename', '$fonction')");
    $msg= "L'enregistrement réussi !";
}
    

 ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ajouter un utilisateur</title>
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
    <?php
    include 'style.php';
    ?>
</head>

<body style="background: #F1F1F1;">




<?php 

include "navBar.php";
 ?>

  

   <div class="container">

<div class="row ">
    
   

    <div class="col-lg-8">
        <div class="card ">
            <div class="card-body">
                <div class="text-center">
                    <h4 class="header-title text-white text-center bg-noir p-2">Ajouter un utilisateur</h4>
                </div>
                                        
                <form class="needs-validation " method="POST" novalidate="" enctype="multipart/form-data">
                    <div class="form-row">

                         <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Nom</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Nom" required="" name="nom" autocomplete="off">
                                                    
                            </div>
                             <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Prénom</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Prénom" required="" name="prenom" autocomplete="off">
                                                    
                            </div>
                         <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Genre</label>
                                <select  class="form-control p-1"  required="" name="genre" id="validationCustom02">
                                                        
                                    <option>Masculin</option>
                                    <option>Féminin</option>
                                </select>
                    
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationCustom02">fonction</label>
                                <select  class="form-control p-1"  required="" name="fonction" id="validationCustom02">
                                                        
                                    <option>Magazinier</option>
                                    <option>Comptable</option>
                                    <option>Gerant</option>
                                    <option>Founisseur</option>
                                </select>
                    
                            </div>
                             
                                                    
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Photo</label>
                                <input type="file" class="form-control" id="validationCustom01" placeholder="Mot de passe" required="" name="photos" autocomplete="off">
                                                    
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom01">Mot de passe</label>
                                <input type="password" class="form-control" id="validationCustom01" placeholder="Mot de passe" required="" name="password" autocomplete="off">
                                                    
                            </div>
                            


                          
                           
                                                
                        </div>

                        <div class="text-center">
                            <p class="text-success"><?php if(isset($msg) )echo $msg; ?></p>
                             <a class="btn bg-noir text-white p-2 " href="Admin.php">Retour</a>
                            <button class="btn bg-noir p-2 text-white w-50" type="submit" name="envoyer">Enregistrer</button>
                        </div>
                                            
                </form>
            </div>
         </div>
    </div>

</div>


        <div class="row">
        


    <div class="col-lg-12 mt-2 mb-3 mb-1">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-center">Liste des utilisateurs</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-noir">
                                <tr class="text-white">
                                    <th scope="col">N°</th>
                                    <th scope="col">Nom </th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Genre</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Rôle</th>
                                     <th scope="col">Action</th>
                                    
                                </tr>
                            </thead>

          

                     <tbody>
                         <?php 
                  $affichercat= $bdd->query("SELECT * FROM utilisateur ");
                  $num=0;
                  while($tab=$affichercat->fetch())
                   {
                    $num+=1;
                      ?>
                            <tr>
                                <th scope="row"><?=$num;?></th>
                                 <td><?=$tab[1];?></td>
                                <td><?=$tab[2];?></td>
                                <td><?=$tab[3];?></td>
                                <td><?=$tab[6];?></td>
                                <td><img width="50" height="50" src="image/<?=$tab[5];?>"></td>
                               

                                <td>
                                    <a class="btn bg-noir p-2 text-white" href="modifUser.php?id=<?=$tab[0]; ?>">Modifier</a>

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