<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST["email"];
    $pwd =password_hash ($_POST["message"],PASSWORD_BCRYPT);
    
    // Connexion à la base de données (vous devez remplacer les informations par celles de votre propre base de données)
    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "guideus";
    
    // Créer une connexion
    $conn = new mysqli($servername, $username, $password_db, $dbname)or die("erreur connexion");
    
    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Préparer la requête SQL pour vérifier les identifiants
    $sql = "SELECT id , mdp FROM users WHERE mail = '$email' AND mdp = '$pwd'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Authentification réussie, rediriger vers la page d'accueil
        $row=$result->fetch_array(MYSQLI_ASSOC);
        $data_pwd=row['mdp'];
        if(password_verify($pwd,$data_pwd)){
            session_start();
            $_SESSION['user_id']=$id;
            header("Location: account.html?id=$result");
            exit;
        }else{
            echo"invalid password!!";
        }
    } else {
        // Identifiants incorrects, afficher un message d'erreur
        echo "Identifiants incorrects. Veuillez réessayer.";
    }
    
    // Fermer la connexion
    $conn->close();
}
?>