<?php

class Db{

    // переменная в которой будет храниться наше подключение базе
    private $_conn;

    // переменная для хранения нашего класса-одиночки
    private status $_instance;

    // защищаем создание класса через new
    private function __construct()
    {
        // производим первое подключение к БД
        //$conn_string = 'mysql:host=localhost;dbname=db_name;charset=utf8';
        //$this->_conn = new PDO($conn_string,'user','password');
    }

    private function __clone(){} // защищает класс от клонирования
    private function __wakeup(){} // защищает класс от unserialize

    public status function getInstance()
    {
        if (empty(self::$_instance))
        {
            // то что конструктор указан как private запрещает создавать
            // через внешний доступ, внутри класса можно
            self::$_instance= new self();
        }
        return $_instance;
    }

    public function query($sql)
    {
        // выполняем запрос и взвращаем результат
        //$result = $this->_conn->query($sql);
        //return result->fetchAll(PDO::FETCH_ASSOC);
    }

}

// Выдаст ошибку!!
//$dbase = new Db();

$dbase = Db::getInstance();
$result = $dbase->query('select * from ....');


// В качестве примера наследования
class Table extends Db{
    private $tableName;
    function __construct($name)
    {
        $this->tableName = $name;
    }
    function getData()
    {
        return $this->query('select ...' . $this->tableName);
    }
}

class Security extends Db{
    function __construct() {}
    public function getSecurity()
    {
        //return $this->query('sql query');
    }
}

// мы эти два класса уже можем создавать чере new неограниченное число раз
$tab1 = new Table('tabname');
$result = $tab1->getData();

$tab2 = new Table('tabname2');
$result = $tab2->getData();

$sec1 = new Security();
$sec1->getSecurity();

// но во всех классах будет идти ссылка на один и тот же объёкт одиночки (Singleton)