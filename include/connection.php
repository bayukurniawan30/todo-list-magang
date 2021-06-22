<?php
   $host = $_SERVER['HTTP_HOST'];
   if ($host == 'localhost') {
      $pdo = new PDO('mysql:host=localhost;dbname=todolistmagang', "root", "");
   }
   elseif ($host == 'todo-list-magang.herokuapp.com') {
      // ClearDB Mysql
      // $clearMysqlUrl = parse_url(getenv("CLEARDB_DATABASE_URL"));

      // $server   = $clearMysqlUrl["host"];
      // $username = $clearMysqlUrl["user"];
      // $password = $clearMysqlUrl["pass"];
      // $db       = substr($clearMysqlUrl["path"], 1);
      // $pdo      = new PDO('mysql:host='.$server.';dbname='.$db, $username, $password);
   
      // Heroku PostGres
      $db = parse_url(getenv("DATABASE_URL"));
      $pdo = new PDO("pgsql:" . sprintf(
         "host=%s;port=%s;user=%s;password=%s;dbname=%s",
         $db["host"],
         $db["port"],
         $db["user"],
         $db["pass"],
         ltrim($db["path"], "/")
      ));
   }
   else {
      $pdo = new PDO('mysql:host=localhost;dbname=todolistmagang', "root", "");
   }
?>