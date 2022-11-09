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
                <a href="login_index.php"><img class="login_ico" src="img/login.png"></a>
                <div class="acc_drpd">
                    <?php echo "<a class='test' href='profile.php?id=" . $_SESSION['user'] . "'><button><b>Mijn Profiel</b></button></a>";?>
                    <a href="nieuw.php"><button><b>Nieuwe Post +</b></button></a>
                    <a href="scripts/logout.php"><button><b>Log Uit</b></button></a>
                </div>
                <div class="obj1"></div>
            </span>
        </span>
    </nav>
    <div class="newblogs-space">
        <?php
            $userid = $_SESSION["user"];
            $query = $conn->prepare("SELECT * FROM member WHERE mem_id = :userid"); 
            $query->bindvalue(":userid", $userid, PDO::PARAM_STR);
            
            if($query->execute())
            {
                if($query->rowCount()>0)
                {
                    while($row = $query->fetch())
                    {   
                        echo "<div class='username'>" . "<h6> Gebruikersnaam: " . $row["username"] ."<h6> Voornaam: " . $row["firstname"] ."<h6> Achternaam: " . $row["lastname"]. "<h5> uw blogs </div>";          
                    }
                }
                else
                {
                    echo "Geen gegevens gevonden";
                }
            }
         echo "<hr>";

            $userid1 = $_SESSION["user"];
            $query1 = $conn->prepare("SELECT * FROM blogs WHERE member_id = :userid1");
            $query1->bindvalue(":userid1", $userid1, PDO::PARAM_STR); 
            if($query1->execute())
            {
                if($query1->rowCount()>0)
                {
                    while($row1 = $query1->fetch())
                    {
                        ?>
                        <div class="newblogs">
                            <div class="newblogs-img">
                                <img src="img/paper_bg.jpg" width="400" height="225">
                            </div>
                            <div class="newblogs-titel">
                                <b><?php echo "<a href='blog.php?id=" . $row1["id"] . "'>" . $row1["titel"] . "</a>" . "<br>";?></b>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    echo "U hebt geen blogs";
                }
            }
     ?>
    </div>
    <br><br><br><br><br>

</body>
</html>