<?php
    require_once "scripts/connection.php";

    if(!ISSET($_SESSION['user'])){
		header('location:index.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>"/>
    <title>Twiddit</title>
</head>
<body>
    <nav>
        <span class="links">
            <a href="index.php"><img class="logo" src="img/twiddit_logo.PNG"></a>
            <a href="index.php"><h1 class="logo-titel">Twiddit</h1></a>
        </span>
        <span class="rechts">
            <a><img class="search_ico" src="img/search_white.png"></a>
            <div class="inlinefix">
                <input id="zoeken" placeholder="zoeken.....">
            </div>
            <span class="dropdown">
                <a href=""><img class="login_ico" src="img/login.png"></a>
                <div class="acc_drpd">
                    <a href=""><button><b>Mijn Profiel</b></button></a>
                    <a href="nieuw.php"><button><b>Nieuwe Post +</b></button></a>
                    <a href="scripts/logout.php"><button><b>Log Uit</b></button></a>
                </div>
                <div class="obj1">
                </div>
            </span>
        </span>
    </nav>
    <?php
       if(isset($_POST["blogtitel"], $_POST["bloginhoud"]))
        {
            $titel = $_POST["blogtitel"];
            $inhoud = $_POST["bloginhoud"];
            $user = $_SESSION['user'];
            $categorie = $_POST["categorie"];
            
            if(!empty($titel) && !empty($inhoud) && !empty($user) && !empty($categorie))
            {
                $query = $conn->prepare("INSERT INTO `blogs`(titel, inhoud, datum, member_id, categorie) VALUES (:titel, :inhoud, CURRENT_TIMESTAMP(), :user, :categorie)");

                $query->bindvalue(":titel", $titel, PDO::PARAM_STR);
                $query->bindvalue(":inhoud", $inhoud, PDO::PARAM_STR);
                $query->bindvalue(":user", $user, PDO::PARAM_STR);
                $query->bindvalue(":categorie", $categorie, PDO::PARAM_STR);

                if($query->execute())
                {
                    header('location: index.php');
                }
                else
                {
                    echo "Kan Waardoe Niet Toevoegen";
                }
            }
            else
            {
                echo "<script>alert('Niet alle velden zijn ingevuld!');</script>";
            }
        }   
    ?>
    <form class="nieuweblog" method="post">
        <br>
        <br>
        <input id="titel" name="blogtitel" type="text" placeholder="Titel..." maxlength="64">
        <br>
        <textarea id="bloginhoud" name="bloginhoud" type="text" placeholder="Voeg tekst hier..."></textarea>
        <br>
        <select id="categorie" name="categorie">
            <option value="" disabled selected hidden>Kies Categorie</option>
            <option value="Natuur">Natuur</option>
            <option value="Sport">Sport</option>
            <option value="Voeding">Voeding</option>
            <option value="Gaming">Gaming</option>
            <option value="Familie">Familie</option>
            <option value="Media">Media</option>
            <option value="Life">Life</option>
            <option value="Anders">Anders</option>
        </select>
        <br><br>
        <input id="blogklaar" type="submit" value="Klaar +">
    </form>

</body>
</html>



