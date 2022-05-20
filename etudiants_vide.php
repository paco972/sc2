<?php
    // Connexion à la BDD
    include("db_connect.php");
    $method = $_SERVER["REQUEST_METHOD"];

    function getEtudiants() {
        global $conn;
        // Accès aux données
         $requete = "SELECT * FROM etudiant ORDER BY `nom` ASC";
        $result = mysqli_query($conn, $requete);
        $etudiants = array();
        if (mysqli_num_rows($result) >0) {
            while($row = mysqli_fetch_assoc($result)) {
                $etudiant = array();
                $etudiant['id'] = $row['idEtudiant'];
                $etudiant['nom'] = $row['nom'];
                $etudiant['prenom'] = $row['prenom'];
                $etudiant['codeBadge'] = $row['codeBadge'];
                array_push($etudiants, $etudiant);
            }
            echo json_encode($etudiants);
        }
    }

    function getEtudiant($id=0) {
        global $conn;
        
        $requete = "SELECT * FROM etudiant WHERE idEtudiant = ".$id;
        // echo $requete;
        $result = mysqli_query($conn, $requete);
        $etudiant = array();
        if (mysqli_num_rows($result) >0) {
            while($row = mysqli_fetch_assoc($result)) {
                $etudiant = array();
                $etudiant['id'] = $row['idEtudiant'];
                $etudiant['nom'] = $row['nom'];
                $etudiant['prenom'] = $row['prenom'];
                $etudiant['codeBadge'] = $row['codeBadge'];
            }
            echo json_encode($etudiant);
        }
    }

    function addEtudiant() {
        global $conn;
         $etudiant = json_decode(file_get_contents("php://input"));
        foreach($etudiant as $key => $value) {
            // echo $key." ".$value."\n";
            switch($key) {
                case "nom" : $nom = $value;         break;
                case "prenom" : $prenom = $value;   break;
                case "code" : $code = $value;  break;
            }
        }
        $requete = "INSERT INTO `etudiant` (`idEtudiant`, `nom`, `prenom`, `codeBadge`) 
            VALUES (NULL, '".$nom."', '".$prenom."', '".$code."');";
        // echo $requete;
        $result = mysqli_query($conn, $requete);
    }

    function updateEtudiant($id) {
        global $conn;
         $etudiant = json_decode(file_get_contents("php://input"));
        foreach($etudiant as $key => $value) {
            // echo $key." ".$value."\n";
            switch($key) {
                case "nom" : $nom = $value;         break;
                case "prenom" : $prenom = $value;   break;
                case "codeBadge" : $code = $value;  break;
            }
        }        
        $requete = "UPDATE `etudiant` 
            SET `nom` = '".$nom."', `prenom` = '".$prenom."', `codeBadge` = '".$code."' 
            WHERE `etudiant`.`idEtudiant` = ".$id;
        echo $requete;
        $result = mysqli_query($conn, $requete);
    }

    function deleteEtudiant($id) {
        global $conn;
    }

    switch($method) {
        case 'GET' :
            if (empty($_GET["id"])) {
                getEtudiants();
            }
            else {
                $id = intval($_GET["id"]);
                getEtudiant($id);
            }
        break;
        case 'POST' :
            addEtudiant();
            break;
        case 'DELETE' :
            $id = intval($_GET["id"]);
            deleteEtudiant($id);
            break;
        case 'PUT' :
            $id = intval($_GET["id"]);
            updateEtudiant($id);
            break;
        }
?>
