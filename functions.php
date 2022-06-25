<?php
session_start();
include './dbh.php';



// if is logged in
if($_SESSION['loggedIn']){
    // get_loods_users($conn);
}

// always shown on page
function loods_onwer_accessibility($conn){
    if($_SESSION['rank'] == 'owner'){
        
    }
}

function get_loods_users($conn){
    $my_loods = $_SESSION['in_loods'];

    $sql = "SELECT username, aantal_zakjes FROM users WHERE in_loods=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $my_loods);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while($output = $result->fetch_assoc()){
        $data[] = $output;
    }

    foreach ($data as $user) {
        $zakjes = $user['aantal_zakjes']; 
        echo '<input type="submit" value="' . $user['username'] . ' - ' . floor($zakjes) . '" name="' . $user['username'] . '">';
    }
}



























my_info($conn);

function my_info($conn){
    // variables
    $my_id = $_SESSION['id'];

    $sql = "SELECT * FROM users WHERE id=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $my_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while($output = $result->fetch_assoc()){
        $data[] = $output;
    }

    if($_SESSION['loggedIn']){
        $_SESSION['aantal_zakjes'] = $data['0']['aantal_zakjes'];
        $_SESSION['aantal_drugs'] = $data['0']['aantal_bladeren'];
        $_SESSION['rank'] = $data['0']['rank'];
        $_SESSION['in_loods'] = $data['0']['in_loods'];
    }
}

handler($conn);

function handler($conn){
    if(isset($_POST['add-drugs'])){
        add_drugs($conn);
    }

    if(isset($_POST['remove-drugs'])){
        remove_drugs($conn);
    }
}

function add_drugs($conn){
    sleep(5);
    // variables 
    $amount = $_POST['custom_amount'];
    $my_id = $_SESSION['id'];
    $multiplier = 0.344444444444;

    if($amount <= 0){
        $amount = $_POST['amount'];
    }


    // check if inputs are only numbers else exit the function
    if(!ctype_digit($amount)){
        echo '<meta http-equiv="refresh" content="0;url=">';
        exit;
    }

    // update 'drugs/zakjes'
    $sql = mysqli_query($conn, "UPDATE users SET aantal_bladeren = aantal_bladeren + $amount, aantal_zakjes = aantal_bladeren * $multiplier WHERE id=$my_id");

    if ($sql) {
        echo "Record updated successfully";
        echo '<meta http-equiv="refresh" content="0;url=">';
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

}

function remove_drugs($conn){
    sleep(5);
    // variables 
    $amount = $_POST['custom_amount'];
    $my_id = $_SESSION['id'];
    $multiplier = 0.344444444444;

    if($amount <= 0){
        $amount = $_POST['amount'];
    }

    $newAmount = $amount * 2.90322;
    // var_dump($newAmount);

    // check if inputs are only numbers else exit the function
    if(!ctype_digit($amount)){
        echo '<meta http-equiv="refresh" content="0;url=">';
        exit;
    }

    $sql = mysqli_query($conn, "UPDATE users SET aantal_bladeren = aantal_bladeren - $newAmount, aantal_zakjes = aantal_bladeren * $multiplier WHERE id=$my_id");

    if ($sql) {
        echo "Record updated successfully";
        echo '<meta http-equiv="refresh" content="0;url=">';
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}








// gebruikers page

function delete_users($conn){
    $my_loods = $_SESSION['in_loods'];

    $sql = "SELECT id, rank, username, aantal_zakjes FROM users WHERE in_loods=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $my_loods);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while($output = $result->fetch_assoc()){
        $data[] = $output;
    }

    foreach ($data as $user) {
        $zakjes = $user['aantal_zakjes']; 
        $rank = $user['rank'];

        echo '
            <form action="" method="POST">
                <ul>
                    <li>' . $user['username'] . '</li>
                    <li>: ' . floor($user['aantal_zakjes']) . '</li>
        ';

        if($_SESSION['rank'] == 'owner'){
            echo '
                        <input type="hidden" name="user-id" value="' . $user['id'] . '">
                        <input type="hidden" name="username" value="' . $user['username'] . '">
            ';
        }

        if($rank !== 'owner'){
            echo'<li><input type="submit" value="verwijder" name="verwijder" title="Gebruiker: ' . $user['username'] . ' - ID: ' . $user['id'] . ' verwijderen"></li>';
        } else {
            echo'<li><input type="submit" value="Owner" name="" title="Gebruiker: ' . $user['username'] . ' - ID: ' . $user['id'] . ' is eigenaar"></li>';
        }

        echo '
                </ul>
            </form>
        ';
    }

    
    if(isset($_POST['verwijder'])){
        if($_SESSION['rank'] == 'owner'){
            // set variables
            $id = $_POST['user-id'];
            $to_zero = '0';

            $sql = mysqli_query($conn, "UPDATE users SET aantal_bladeren=$to_zero, aantal_zakjes=$to_zero, in_loods=$to_zero WHERE id=$id;");

            // var_dump($sql);
            
            if ($sql) {
                echo "Record updated successfully";
                echo '<meta http-equiv="refresh" content="0;url=">';
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    }
}