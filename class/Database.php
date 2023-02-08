<?php

class Database //on appelle notre objet Database pour créer notre class
{
    private SQLite3 $db; // on lui attribue un objet de type SQLite3 qu'on appelle $db

    public function __construct(string $filename) // le constructeur va servir à décrire les actions à effectuer dès l'initialisation avec en paramètre le nom du fichier de la BDD
    {
        $this->db = new SQLite3($filename); // on lui affecte notre construction SQLite3 en passant en paramètre le $filename
    }


    
   public function initialize(): void
   {
        $query = "CREATE TABLE IF NOT EXISTS task
                     (
                        id INTEGER NOT NULL, 
                        done BOOLEAN NOT NULL, 
                        name VARCHAR(255) NOT NULL,
                        deletebtn BOOLEAN NOT NULL, 
                        PRIMARY KEY('id' AUTOINCREMENT)
                        );";

        $this->exec($query);
        
   }

   public function getTasks(): array
   {
        $tasks= [];

        $query = "SELECT * FROM task";

        $data= $this->db->query($query);

        while($row = $data->fetchArray())
        { // tant qu'on a une ligne de données
            # code ... on va ajouter des tâches
            $tasks[] = $row;
        }
        return $tasks;
   }

   public function addTask(string $name): void
   {
        $query = "INSERT INTO task (`done`, `name`, `deletebtn`) VALUES (false, '$name', false)";//littéraux de gabarit (`` ALT Gr + 7)pour les noms de colonnes
        $this->exec($query);
    }

    public function updateTask(int $id, int $done)
    {
        $query = "UPDATE task SET `done`= $done WHERE `id` = $id";
        $this-> exec($query);
    }

    public function deleteTask($item)
   {
   
       $sql = "DELETE FROM task WHERE id=$item";
       $this-> exec($sql);
       if($sql){
           echo 'élément n°'.$item.' supprimé';
       }
       else{
           echo 'élément non supprimé';
       }
       
   }

    public function getDatabase(): SQLite3
    {
        return $this->db;
    }

   
   public function exec(string $query): void
   {
    $this->db->prepare($query);
    $this->db->exec($query);
   }


   
    

   
}

