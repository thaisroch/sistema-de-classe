<?php

class Connection
{

    private $_dbHostName = 'localhost;';
    private $_dbName = 'db_sistemadeclasse';
    private $_dbUsername = 'root';
    private $_dbPassword  = 'DB_sistema*classe1';
    private $_con;

    public function __construct(){

        try{
            $this->_con = new PDO("mysql:host=$this->_dbHostName;
                                        dbname=$this->_dbName",
                                               $this->_dbUsername,
                                               $this->_dbPassword);
            $this->_con->setAttribute(PDO::ATTR_ERRMODE,
                                      PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo "Erro com banco de dados:".$e->getMessage();
            exit();
        }
        catch(Exception $e){
            echo "Erro generico:".$e->getMessage();
        }
    }

    //return connection
    public function returnConnection()
    {
        return $this->_con ? $this->_con : null;
    }
}

?>
