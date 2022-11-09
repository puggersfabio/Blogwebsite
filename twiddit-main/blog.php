<?php
    require_once "scripts/connection.php";
	
	if(!ISSET($_SESSION['user'])){
		header('location:vieuw.php');
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
                <a href="myprofile.php"><img class="login_ico" src="img/login.png"></a>
                <div class="acc_drpd">
                    <a href="myprofile.php"><button><b>Mijn Profiel</b></button></a>
                    <a href="nieuw.php"><button><b>Nieuwe Post +</b></button></a>
                    <a href="scripts/logout.php"><button><b>Log Uit</b></button></a>
                </div>
                <div class="obj1">
                </div>
            </span>
        </span>
    </nav>
    <br>
    <div class="vieuw">
        <?php
            $blogid = $_GET["id"];

            $query = $conn->prepare("SELECT * FROM blogs WHERE id=:blogid");
            $query->bindvalue(":blogid", $blogid, PDO::PARAM_STR);
                        if($query->execute())
                        {
                            if($query->rowCount()>0)
                            {
                                while($row = $query->fetch())
                                {
                                    echo "<h1 class='vieuw-titel'>" . $row["titel"] . "</h1>";
                                    echo "<p class='vieuw-inhoud'>" . $row["inhoud"] . "</p>";
                                    echo "<p class='vieuw-categorie'><i>" . "Categorie: " . $row["categorie"] . "," . "</i></p>";
                                    echo "<p class='vieuw-datum'><i>" . "Gepubliceerd op: " . $row["datum"] . "," . "</i></p>"; 
                                    $member = $row["member_id"];
                                    $query1 = $conn->prepare("SELECT * FROM member WHERE mem_id=:member");
                                    $query1->bindvalue(":member", $member, PDO::PARAM_STR);
                                                if($query1->execute())
                                                {
                                                    if($query1->rowCount()>0)
                                                    {
                                                        while($row1 = $query1->fetch())
                                                        {
                                                            echo "<p class='vieuw-member_id'><i>" . "Gemaakt door: " . $row1["username"] . "</i></p>";                                                                           
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo "Geen gegevens gevonden";
                                                    }
                                                }                                    
                                }
                            }
                            else
                            {
                                echo "Geen gegevens gevonden";
                            }
                        }
        ?>
    </div>