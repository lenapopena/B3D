<?php
  class DB
  {
      private $host = 'localhost';
      private $dbname = "B3D";
      private $user = "root";
      private $pwd = "raspberry";
      public $pdo;
      public function __construct()
      {
          try {
              $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pwd);
          }catch (Exception $e)
          {
              echo $e;
          }
      }

      public function connect()
      {
          $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pwd);
      }

      public static function nextId($table)
      {
          $myDb = new DB();

          $stmt = $myDb->pdo->prepare("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE lower(table_name) = lower(?) AND table_schema = DATABASE()");
          $stmt->execute([$table]);

          return $stmt->fetch()["AUTO_INCREMENT"];
      }
  }
?>