<?php
    class CategoriesClass {
        private $pdo;
         
        public function __construct($pdo) 
        {
            $this->pdo = $pdo;
        }
        public function fetch()
        {
            $result = $this->pdo->query("SELECT * FROM categories");
            if($result->rowCount() > 0) {
                while($rows = $result->fetch(PDO::FETCH_OBJ))
                    $data[] = $rows;
                return $data;
            }

            return false;
        }
        public function detail($id)
        {
            $result = $this->pdo->query("SELECT * FROM categories WHERE id = '$id'");
            if($result->rowCount() > 0) {
                $row = $result->fetch(PDO::FETCH_OBJ);
                return $row;
            }

            return false;
        }
        public function add($data)
        {
            $data = json_decode($data, true);
            $data = array_map('trim', $data);
            $data['created'] = date('Y-m-d H:i:s');
            $name = $data['name'];

            $checkCat = $this->pdo->query("SELECT * FROM categories WHERE name = '$name'");
            if ($checkCat->rowCount() == 0) {
                $result  = $this->pdo->prepare("INSERT INTO categories(
                    name, 
                    created) 
                VALUES (:name, :created)");
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
            }
            
            return false;
        }
    }
?>