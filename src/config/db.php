<?php
    class db{
        // Properties
        private $dbhost = 'fdb3.biz.nf';
        private $dbuser = '2091203_twist';
        private $dbpass = 'monday85';
        private $dbname = '2091203_twist';
        // Connect
        // create MYSQL connect string 
        public function connect(){
            $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
        }
    }


