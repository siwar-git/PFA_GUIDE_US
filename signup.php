<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $pwd = password_hash ($_POST["message"],PASSWORD_BCRYPT);
    $domain = htmlspecialchars($_POST['domain']);
    $gender = htmlspecialchars($_POST['sex']);
    $city = htmlspecialchars($_POST['ville']);
    $level = htmlspecialchars($_POST['niveau']);

    // File upload handling for CV and Image
    $cv_file = $_FILES['file'];
    $image_file = $_FILES['pic'];

    // Define the upload directory
    $upload_dir = "uploads/";

    // Check if the upload directory exists, if not create it
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

     // Initialize variables to store file paths
     $cv_target_file = "";
     $image_target_file = "";
 
     // Check if the directory is writable
     if (is_writable($upload_dir)) {
         // Upload CV file
         $cv_target_file = $upload_dir . basename($cv_file["name"]);
         if (!move_uploaded_file($cv_file["tmp_name"], $cv_target_file)) {
             echo "Failed to upload CV.";
             exit;
         }
 
         // Upload Image file
         $image_target_file = $upload_dir . basename($image_file["name"]);
         if (!move_uploaded_file($image_file["tmp_name"], $image_target_file)) {
             echo "Failed to upload Image.";
             exit;
         }
     } else {
         echo "Upload directory is not writable.";
         exit;
     }
 
    // Validate inputs
    $errors = [];

    if (empty($name)) {
        $errors[] = "Full name is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    }
    if (empty($pwd)) {
        $errors[] = "Password is required.";
    }
    if (empty($domain)) {
        $errors[] = "Domain is required.";
    }

    // If no errors, proceed to save data (for example, into a database)
    if (empty($errors)) {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "guideus";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //id user
        $id_sql="select * from users";
        $result = $conn->query($id_sql);
        $id= $result->num_rows;

        // SQL query to insert data
        $sql = "INSERT INTO users (id, nom, mail, tel, mdp, domain, sex, ville, niveau, cv, pic) 
                VALUES ('$id','$name', '$email', '$phone', '$pwd', '$domain', '$gender', '$city', '$level', '$cv_target_file', '$image_target_file')";

        if ($conn->query($sql) === TRUE) {
            header("Location: account.php?id=$id" );
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<div class='error'>$error</div>";
        }
    }
}
