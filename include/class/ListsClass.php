<?php
    class ListsClass {
        private $pdo;
         
        public function __construct($pdo) 
        {
            $this->pdo = $pdo;
        }
        public function fetch($category = NULL, $assign = NULL)
        {
            $userId = $_SESSION['id'];

            if ($category == NULL) {
                if ($assign == NULL) {
                    $condition = '';
                    $result = $this->pdo->query("SELECT lists.*, categories.* FROM lists INNER JOIN categories ON lists.category_id = categories.id WHERE lists.user_id = '$userId' ORDER BY lists.category_id ASC, lists.id DESC");
                }
                elseif ($assign == 'today') {
                    $today  = date('Y-m-d'); 
                    $condition = "WHERE lists.user_id = '$userId' AND lists.assign = '$today'";
                }
                elseif ($assign == 'tomorrow') {
                    // Mysql
                    // $condition = "WHERE lists.user_id = '$userId' AND lists.assign = CURDATE() + INTERVAL 1 DAY";
                    // Postgres
                    $condition = "WHERE lists.user_id = '$userId' AND TO_DATE(lists.assign, 'YYY-MM-DD') = DATE 'tomorrow'";
                }
                elseif ($assign == 'upcoming') {
                    // Mysql
                    // $condition = "WHERE lists.user_id = '$userId' AND lists.assign > CURDATE() + INTERVAL 1 DAY";
                    // Postgres
                    $condition = "WHERE lists.user_id = '$userId' AND TO_DATE(lists.assign, 'YYY-MM-DD') > DATE 'tomorrow'";
                }
            }
            else {
                if ($assign == NULL) {
                    $condition = "WHERE lists.user_id = '$userId' AND categories.id = '$category'";
                }
                elseif ($assign == 'today') {
                    $today  = date('Y-m-d'); 
                    $condition = "WHERE lists.user_id = '$userId' AND categories.id = '$category' AND lists.assign = '$today'";
                }
                elseif ($assign == 'tomorrow') {
                    // Mysql
                    // $condition = "WHERE lists.user_id = '$userId' AND categories.id = '$category' AND lists.assign = CURDATE() + INTERVAL 1 DAY";
                    // Postgres
                    $condition = "WHERE lists.user_id = '$userId' AND categories.id = '$category' AND  AND TO_DATE(lists.assign, 'YYY-MM-DD') = DATE 'tomorrow'";
                }
                elseif ($assign == 'upcoming') {
                    // Mysql
                    // $condition = "WHERE lists.user_id = '$userId' AND categories.id = '$category' AND lists.assign > CURDATE() + INTERVAL 1 DAY";
                    // Postgres
                    $condition = "WHERE lists.user_id = '$userId' AND categories.id = '$category' AND TO_DATE(lists.assign, 'YYY-MM-DD') > DATE 'tomorrow'";
                }
            }

            // Mysql way
            // $primaryTableName         = 'lists';
            // $primaryTableColumnQuery  = 'SHOW COLUMNS FROM ' . $primaryTableName;
            // $primaryTableColumnResult = $this->pdo->query($primaryTableColumnQuery);
            // $primaryColumnNames       = [];
            // while($rows = $primaryTableColumnResult->fetch(PDO::FETCH_OBJ)) {
            //     $primaryColumnNames[] = $rows->Field;
            // }

            // Postgres way (manual)
            $primaryTableName   = 'lists';
            $primaryColumnNames = ['id', 'todo', 'category_id', 'user_id', 'assign', 'status'];
            $primaryTable = [
                $primaryTableName => $primaryColumnNames
            ];

            // Mysql way
            // $joinTableName         = 'categories';
            // $joinTableColumnQuery  = 'SHOW COLUMNS FROM ' . $joinTableName;
            // $joinTableColumnResult = $this->pdo->query($joinTableColumnQuery);
            // $joinColumnNames       = [];
            // while($rows = $joinTableColumnResult->fetch(PDO::FETCH_OBJ)) {
            //     $joinColumnNames[] = $rows->Field;
            // }

            // Postgres way
            $joinTableName     = 'categories';
            $joinColumnNames   = ['id', 'name', 'created'];
            $joinTable = [
                $joinTableName => $joinColumnNames
            ];
            

            $generatedQuery = "SELECT ";
            foreach ($primaryColumnNames as $primaryColumn) {
                $generatedQuery .= $primaryTableName.'.'.$primaryColumn.', ';
            }

            $initJoin = 0;
            $totalJoinColumn = count($joinColumnNames);
            foreach ($joinColumnNames as $joinColumn) {
                if (end($joinColumnNames) === $joinColumn) {
                    $generatedQuery .= $joinTableName.'.'.$joinColumn.' as '.strtolower($joinTableName).'_'.strtolower($joinColumn).' ';
                }
                else {
                    $generatedQuery .= $joinTableName.'.'.$joinColumn.' as '.strtolower($joinTableName).'_'.strtolower($joinColumn).', ';
                }
                $initJoin++;
            } 

            $generatedQuery .= " FROM ".$primaryTableName." INNER JOIN ".$joinTableName." ON ".$primaryTableName.".category_id = ".$joinTableName.".id ".$condition." ORDER BY ".$primaryTableName.".category_id ASC, ".$primaryTableName.".id DESC";

            $result = $this->pdo->query($generatedQuery);

            if($result->rowCount() > 0) {
                while($rows = $result->fetch(PDO::FETCH_OBJ))
                    $data[] = $rows;
                return $data;
            }

            return false;
        }
        public function add($data)
        {
            $data = json_decode($data, true);
            $data = array_map('trim', $data);
            $data['user_id'] = $_SESSION['id'];
            $data['assign']  = date('Y-m-d', strtotime($data['assign']));
            $data['status']  = NULL;

            $result  = $this->pdo->prepare("INSERT INTO lists(
                todo, 
                category_id, 
                user_id, 
                assign,
                status) 
            VALUES (:todo, :category_id, :user_id, :assign, :status)");
            foreach ($data as $key => &$value) {
                $field = ':' . $key;
                $result->bindParam($field, $value);
            }

            if($result->execute()) {
                return true;
            }
            else {
                return false;
            }
            
            return false;
        }
        public function check($data) 
        {
            $data   = json_decode($data, true);
            $data   = array_map('trim', $data);
            $result = $this->pdo->prepare("UPDATE lists SET status = '1' WHERE id = :id");
            $result->bindParam(':id', $data['id']);
            if($result->execute()) {
                return true;
            }
            else {
                return false;
            }
        }
        public function delete($data) 
        {
            $data   = json_decode($data, true);
            $data   = array_map('trim', $data);
            $result = $this->pdo->prepare("DELETE FROM lists WHERE id = :id");
            $result->bindParam(':id', $data['id']);
            if($result->execute()) {
                return true;
            }
            else {
                return false;
            }
        }
    }
?>