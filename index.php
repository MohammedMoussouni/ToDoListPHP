<?php
    include_once 'functions.php';
    session_start();

    $connection=mysqli_connect('localhost', 'root', '', '');
    $select= "select * from task";
    $query = mysqli_query($connection, $select);





?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" http-equiv="refresh" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="/ToDoListPHP/Mohammed.ico" type="image/x-icon" />

    <title>Mohammed MOUSSOUNI</title>
  </head>
  <body>
    <h4 style="position: absolute; top: 4px; left: 4px; font-size: 14px; font-weight:400;">Version PHP : PHP 8 <br> Autre techno : javascript </h4>
    <h4 style="position: absolute; top: 4px; right: 4px; font-size: 14px; font-weight:400;">BDD : SQLite 3</h4>
        <div class="container">
            
            <div class="row mt-3"> <!--mt-3 (margin-top:3) est là pour créer de l'espace au dessus de la page-->
                <div class="col-12">
            <?php 
                if(isset($_SESSION['status']))
                {
                    echo "<h4".$_SESSION['status']."<h4>";
                    unset($_SESSION['status']);
                }
            ?>

                    <h1 style="padding-top: 80px; text-align : center;">TO-DO-LIST EN PHP</h1>
               </div>
            </div>
            
            <form class="row mt-3" id="formAddTask">
                <input type="hidden" name="action" value="add_task">
    
                <div class="col-7 offset-1">
                    <label for="inputTaskName" class="visually-hidden">Tâche</label>
                    <input type="text" class="form-control" name="taskName" id="inputTaskName" placeholder="Tâche" required>
                </div>

                <div class="col-2"> <!--avec bootstrap on a un système de 12 colonnes (6+2+4)-->
                    <button type="submit" class="btn btn-info mb-3">Ajouter</button> <!--margin bottom de 3-->
                </div>

            </form>
<br>

            <div class="row">
                <div class="col-10 offset-1">
                
                    <table style="float:center;" class="table table-bordered table-striped table-hover" method="POST">
                    <thead>
                        <tr>
                            <th style="text-align:center;" colspan="3">Liste des tâches enregistrées</th>
                        </tr>
                    
                            <th style="font-weight:400;">Fait</th>
                            <th style="font-weight:400;">Nom</th>
                            <th style="font-weight:400;">Action</th>
                        </thead>
                        <tbody>
                            
                            <?php
                            foreach($tasks as $task)
                            {
                                ?>
                                <tr class="tasks" id= "<?=$task['id']?>">
                                    <td class="text-center" style ="width: 10%;">
                                        <input type="checkbox" class="form-check-input" data-id="<?= $task['id'] ?>" <?= $task['checked'] ?>>
                                    </td>
                                    <td style ="width: 70%;">
                                        <?= $task['name']?>
                                    </td>    
                                    <td style ="width: 20%; text-align:center;">
                                        <!--<a href="delete.php" -->
                                       
                                        <!--<a href="delete.php?id=<?//=$task['id']?>" data-id="<?//= $task['id'] ?>" onclick="javascript: return confirm('Etes-vous sûr de vouloir supprimer la tâche?');" class="btnsupp">Supprimer</a>-->
                                        <button type="button" data-id="<?= $task['id'] ?>" class="btnsupp">Supprimer</button>
                                       
<?php
}?>




                                        
                                    </td>
                                </tr>
                                
                                
                            <?php  
                                
                            


                                ?>

                        </tbody>
                    </table>
                </div>
            </div>
                      
        </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous"></script>
    
    <script src="script.js"></script>
  </body>
  <br><br>


    <div style="background-color: black; width: 100%; flex-wrap: wrap; position: fixed; bottom: 0; left: 0; right: 0;">

            <div class="footerdiv" style=" height:50px; margin-bottom: 0rem; background-color: black;">
                <img src="/ToDoListPHP/Mohammed.ico" style="width:50px; position:absolute; left: 4px; "></img>
                <img src="/ToDoListPHP/Mohammed.ico" style="width:50px; position:absolute; right: 4px; "></img>
                
       
                
                <p class="footer"style="vertical-align: middle; text-align:center;  color: white; font-weight:400; font-size: 15px;">
                
 Realised by Software Developer <b>MOUSSOUNI Mohammed</b>
        
       
                </p>
            </div>
</div>
</html>


