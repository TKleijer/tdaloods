<?php 

include 'dbh.php';

function pages($conn){
    if(!$_GET || isset($_GET['main-menu'])){
        echo '
            <div class="main main-main">
                <div class="box box1">
                    <h1>Drugs toevoegen</h1>

                    <form method="POST">

                        <select name="amount">
                            <option value="190">190 Goederen</option>
                            <option value="170">170 Goederen</option>
                            <option value="130">130 Goederen</option>
                        </select>

                        <li>Of zelf invullen</li>
                        
                        <input type="text" name="custom_amount" placeholder="Zelf invullen">

                        <input type="submit" name="add-drugs" onclick="soundEffect()" value="Toevoegen">
                        <audio id="sound-effect" src="kreunen.mp3"></audio>
                    </form>
                </div>

                <div class="box box2">
                    <h1>Zakjes verwijderen</h1>

                    <form method="POST">

                        <select name="amount">
                            <option value="190">190 Goederen</option>
                            <option value="170">170 Goederen</option>
                            <option value="130">130 Goederen</option>
                        </select>

                        <li>Of zelf invullen</li>
                        
                        <input type="text" name="custom_amount" placeholder="Zelf invullen">

                        <input type="submit" name="remove-drugs" onclick="soundEffectt()" value="Verwijderen">
                        <audio id="sound-affect" src="boyd_scheld.mp3"></audio>
                    </form>
                </div>
                <div class="box box2">
                    <h1>Mede gebruikers</h1>
                    <form action="" method="GET">
                        <h4>Gebruikers - Zakjes</h4>
                        ';

                        if($_SESSION["loggedIn"]){get_loods_users($conn);};

                        echo '
                    </form>
                </div>
            </div>
        ';
    } 

    if(isset($_GET['gebruikers'])){
        echo '
            <div class="main main-gebruikers">
                <div class="box">
                    <h3> Gebruikers in loods: ' . $_SESSION["in_loods"] . '</h3>
                    ';
                        delete_users($conn); 
                    echo '
                </div>
            </div>
        ';
    }
}