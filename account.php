<?php
// Supposons que vous avez les informations de connexion à la base de données ici
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guideus";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les informations de l'utilisateur

$user_id = $_GET['id'];
$sql = "SELECT nom, domain, niveau, mail, tel, cv, pic FROM users WHERE id = $user_id";
$result = $conn->query($sql);
if($result->num_rows>0)
{
    $row=$result->fetch_array(MYSQLI_ASSOC);
    $nom=$row['nom'];
    $domain=$row['domain'];
    $niveau=$row['niveau'];
    $mail=$row['mail'];
    $tel=$row['tel'];
    $cv=$row['cv'];
    $pic=$row['pic'];
}

$user = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Account - Guide Us</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Custom Google font-->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column h-100 bg-light">
        <?php if(isset($nom) && isset($domain)&&isset($mail)&&isset($niveau)&&isset($tel)&&isset($cv)&&isset($pic))?>
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
                <div class="container px-5">
                    <a class="navbar-brand" href="index.html"><span class="fw-bolder text-primary">Guide Us</span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                            <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="account.php">Compte</a></li>
                            <li class="nav-item"><a class="nav-link" href="rate.html">Avis</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                            <li class="nav-item"><a class="nav-link" href="index.html">Se Déconnecter</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Projects Section-->
            <section class="py-5">
                <div class="container px-5 mb-5">
                    <div class="text-center mb-5">
                        <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Portfolio</span></h1>
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-11 col-xl-9 col-xxl-8">
                            <!-- Project Card 1-->
                            <div class="card overflow-hidden shadow rounded-4 border-0 mb-5">
                                <div class="card-body p-0">
                                    <div class="d-flex align-items-center">
                                        <div class="p-5">
                                            <h2 class="fw-bolder" style="margin-bottom: 80px;"><?php echo htmlspecialchars($nom); ?></h2>
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                      <th>Domine</th>
                                                    </tr>
                                                    <tr>
                                                      <td id="user_dom"><?php echo htmlspecialchars($domain); ?></td>
                                                    </tr>
                                                    <tr>
                                                      <th>Niveau d'etude</th>
                                                    </tr>
                                                    <tr>
                                                      <td id="user_niv"><?php echo htmlspecialchars($niveau); ?></td>
                                                    </tr>
                                                    <tr>
                                                      <th>Email address</th>
                                                    </tr>
                                                    <tr>
                                                      <td id="user_mail"><?php echo htmlspecialchars($mail); ?></td>
                                                    </tr>
                                                    <tr>
                                                      <th>Phone Number</th>
                                                    </tr>
                                                    <tr>
                                                      <td id="user_tel"><?php echo htmlspecialchars($tel); ?></td>
                                                    </tr>
                                                  </tbody>
                                              </table>
                                              <button class="btn btn-primary btn-lg text-gradient d-inline" id="submitButton" type="submit" style="float: inline-start; margin-left: 30px; margin-top: 30px;"><a href="<?php echo htmlspecialchars($cv); ?>" target="_blank"> Retrieve CV</a></button>
                                        </div>
                                        <img class="img-fluid" src="<?php echo htmlspecialchars($pic); ?>" alt="..." style="flex: auto; float: right;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
        </main>
        <!-- Footer-->
        <footer class="bg-white py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0">Copyright &copy; Guide Us 2024</div></div>
                    <div class="col-auto">
                        <a class="small" href="#!">Privacy</a>
                        <span class="mx-1">&middot;</span>
                        <a class="small" href="#!">Terms</a>
                        <span class="mx-1">&middot;</span>
                        <a class="small" href="#!">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
