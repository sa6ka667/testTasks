<?php
include_once 'models/database.php';
$userInput = 'Ivan';

echo "Полное имя: ";
$username = Db::getFullname($userInput);
echo $username['fullname'] . '<br>';

echo "Остаток на счёте: ";
$result = Db::getBallance($username);
echo $result."<br>";

echo Db::getCityAndTransactions();
$message = Db::getDuplicate();
foreach($message as $message){
    echo $message;
}