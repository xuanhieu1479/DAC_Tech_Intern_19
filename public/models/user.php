<?php
require '../data/connection.php';

global $db;

function updateUserRole($user_id, $role_id) {
    $results = $db->prepare("UPDATE users SET role_id = :role_id WHERE user_id = :user_id");
    $results->bindParam(':role_id', $role_id);
    $results->bindParam(':user_id', $user_id);
    return $results->execute();
}

function findUserByUserName($user_name) {
    $results = $db->prepare("SELECT * FROM users WHERE user_name = :user_name");
    $results->bindParam(':user_name', $user_name);
    $results->execute();
    $results->fetchAll(PDO::FETCH_ASSOC);
    if (!isEmpty($results)) {
        return false;
    }
    return $results[0];
}