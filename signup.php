<?php

include 'functions.php';

if(isset($_POST['signup_submit'])){
    // set variables 
    $uid = $_POST['signup_uid'];
    $pwd = $_POST['signup_pwd'];
    $pwd_repeat = $_POST['signup_pwd_repeat']; 

    if(!empty($uid) || !empty($pwd) || !empty($pwd_repeat)){
        if($pwd != $pwd_repeat){
            $error = '';
        } else {
            $sql = "SELECT username FROM users WHERE username=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $uid);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $data = $result->fetch_all(MYSQLI_ASSOC);

            if(empty($data)){
                // var_dump($_POST);
                // hash pwds
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                $rank = 0;
                $aantal_bladeren = '0';
                $aantal_zakjes = '0';
                $in_loods = '0';

                $sql = "INSERT INTO users (rank, username, password, aantal_bladeren, aantal_zakjes, in_loods) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isssss", $rank, $uid, $hashedPwd, $aantal_bladeren, $aantal_zakjes, $in_loods);
                $stmt->execute();
                $stmt->close();
                $conn->close();
            }
        }
    }
}