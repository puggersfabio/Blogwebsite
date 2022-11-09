<?php
    require_once "scripts/connection.php";
	
	if(ISSET($_SESSION['user'])){
		header('location:home.php');
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
                <a href="login_index.php"><img class="login_ico" src="img/login.png"></a>
                <div class="login_drpd">
                    <a href="login_index.php"><button class="login_btn"><b>Inloggen</b></button></a>
                    <a href="registration.php"><button class="register_btn"><b>Registreren</b></button></a>
                </div>
                <div class="obj1"></div>
            </span>
        </span>
    </nav>
    <div class="newblogs-space">
        <?php
                $query = $conn->prepare("SELECT * FROM blogs ORDER BY datum DESC");

                if($query->execute())
                {
                    if($query->rowCount()>0)
                    {
                        while($row = $query->fetch())
                        {
                            ?>
                            <div class="newblogs">
                                <div class="newblogs-img">
                                    <img src="img/paper_bg.jpg" width="400" height="225">
                                </div>
                                <div class="newblogs-titel">
                                    <b><?php echo "<a href='blog.php?id=" . $row["id"] . "'>" . $row["titel"] . "</a>" . "<br>";?></b>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        echo "Geen gegevens gevonden";
                    }
                }
        ?>
    </div>
    <br><br><br><br><br>

</body>
</html>
