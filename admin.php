<?php
require_once 'lib/database.php';
createUser();
// createUser();
// $username = filter_input(INPUT_POST, 'username');
// $password = filter_input(INPUT_POST, 'password');
// $db = Database::getInstance();

// $sql = "SELECT * FROM users WHERE username = :username";

// $stmt = $db->prepare($sql);

// $stmt->execute(array(':username' => $username));

// //if username exists check for password
// if ($stmt->rowCount() > 0) {
//     $obj = $stmt->fetchObject();
//     //verify the password using password_verify api
//     if (password_verify($password, $obj->password)) {
//         session_start();
//         $_SESSION['authenticated'] = true;
//         $_SESSION['username'] = $username;

//         http_response_code(200);
//         echo json_encode(["message" => 'ok', 'code' => http_response_code()]);
//     } else {
//         http_response_code(403);
//         echo json_encode(['message' => "Invalid password", 'code' => http_response_code()]);
//     }
// } else {
//     http_response_code(403);
//     echo json_encode(['message' => "Invalid Username", 'code' => http_response_code()]);
// }




function createUser(){
    $sql = "INSERT INTO users (username, fullname, email, password) VALUES(:username, :fullname, :email, :password)";
    $db = Database::getInstance();
    $stmt = $db->prepare($sql);

    $password = password_hash("xanthosis", PASSWORD_DEFAULT);

    $stmt->bindValue(':username', 'amshel');
    $stmt->bindValue(':fullname', 'amshel kanyi');
    $stmt->bindValue(':email', 'amshelhack3r@gmail.com');
    $stmt->bindValue(':password', $password);

    try{
        $stmt->execute();
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
