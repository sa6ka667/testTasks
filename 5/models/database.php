<?php
class Db
{
    public static function getConnection(){
        $dbConfig = './config/DBConfig.php';
        $params = include($dbConfig);
        $db = new PDO("mysql:host = {$params['host']};dbname={$params['dbname']}",$params['username'],$params['password']);
        return $db;
    }

    public static function getFullName($userInput){
        $db = Db::getConnection();
        $sql = "SELECT `fullname`,`id` FROM `persons` WHERE `fullname` LIKE '%$userInput%'";
        $result = $db->query($sql);
        $user = $result->fetch();
        return $user;
    }

    public static function getFullNameById($id){
        $db = Db::getConnection();
        $sql = "SELECT `fullname` FROM `persons` WHERE `id` LIKE '%$id%'";
        $result = $db->query($sql);
        $user = $result->fetch();
        return $user['fullname'];
    }

    public static function getBallance($username){
        $db = Db::getConnection();
        $startBallance = 100;
        $id = $username['id'];

        $sql = "SELECT `amount` FROM `transactions` WHERE `from_person_id` = $id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->execute();
        while($row = $result->fetch()){
            $startBallance = $startBallance - $row['amount'];
        }

        $sql = "SELECT `amount` FROM `transactions` WHERE `to_person_id` = $id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->execute();
        while($row = $result->fetch()){
            $startBallance = $startBallance + $row['amount'];
        }
        return $startBallance;
        
    }

    public static function getCityAndTransactions(){
        $db = Db::getConnection();
        $sql = 'SELECT * FROM `cities`';
        $countCities = array();
        
        $result = $db->query($sql);
        while($row = $result->fetch()){
            $countCities[$row['name']]=0;
        }


        $sql = 'SELECT cities.name, COUNT(*) as count,transactions.from_person_id, transactions.transaction_id FROM transactions JOIN persons ON transactions.from_person_id = persons.id JOIN cities on cities.id = persons.city_id GROUP BY cities.id ';
        $result = $db->query($sql);

        while($row = $result->fetch()){
            $countCities[$row['name']] += $row['count'];

        }



        $sql = 'SELECT cities.name, COUNT(*) as count,transactions.to_person_id, transactions.transaction_id FROM transactions JOIN persons ON transactions.to_person_id = persons.id JOIN cities on cities.id = persons.city_id GROUP BY cities.id ';
        $result = $db->query($sql);

        while($row = $result->fetch()){
            $countCities[$row['name']] += $row['count'];
        }
        arsort($countCities);

        $townName = array_key_first($countCities);
        $appearTimes = $countCities[$townName];
        return "Город $townName появился $appearTimes раз<br>";
        }

    public static function getDuplicate(){
        $db = Db::getConnection();
        $countTransactions = array();
        $sql = 'SELECT cities.name, transactions.transaction_id FROM transactions JOIN persons ON transactions.from_person_id = persons.id JOIN cities on cities.id = persons.city_id ORDER BY transactions.transaction_id ASC' ;
        $result = $db->query($sql);
        while($row = $result->fetch()){
            $countTransactions[$row['transaction_id']] = $row['name'];
        }


        $sql = 'SELECT cities.name, transactions.transaction_id, transactions.from_person_id, transactions.to_person_id, transactions.amount FROM transactions JOIN persons ON transactions.to_person_id = persons.id  JOIN cities on cities.id = persons.city_id ORDER BY transactions.transaction_id ASC';
        $result = $db->query($sql);

        while($row = $result->fetch()){

            if($countTransactions[$row['transaction_id']]==$row['name']){
                $from = Db::getFullNameById($row['from_person_id']);
                $to = Db::getFullNameById($row['to_person_id']);
                $amount = $row['amount'];
                $town = $row['name'];
                $message[] = "Транзакция проведена между  $from и $to  в городе $town на сумму $amount ";
            }
        }
        return $message;
    }
}


