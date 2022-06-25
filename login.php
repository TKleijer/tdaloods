<?php

if(isset($_POST['login_submit'])){
    // variables 
    $uid = $_POST['login_uid'];
    $pwd = $_POST['login_pwd'];

    if(!empty($uid) || !empty($pwd)){

        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        $hashedPwd = $user['password'];
        // var_dump($user);

        if(password_verify($pwd, $hashedPwd)){
            session_start();

            $_SESSION['loggedIn'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['uid'] = $user['username'];

            echo '<meta http-equiv="refresh" content="0;url=">';
            exit;
        }
    }
}