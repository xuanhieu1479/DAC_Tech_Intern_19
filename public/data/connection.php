<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=homestead;port=3306","homestead","secret");
} catch (\Exception $e) {
    echo 'Could not connect to database';
    Exit();
}