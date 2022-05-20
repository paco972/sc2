<?php
    // Connexion à la BDD
    include("db_connect.php");
    $method = $_SERVER["REQUEST_METHOD"];

    function getEtudiants() {
        global $conn;
        // Accès aux données
    }

    function getEtudiant($id=0) {
        global $conn;
    }

    function addEtudiant() {
        global $conn;
    }

    function updateEtudiant($id) {
        global $conn;
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