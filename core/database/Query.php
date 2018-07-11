<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 4:24 PM
 */

namespace core\outer;

use core\Configs;

class Query
{
    private $connection = null;
    private $query = "";
    /**
     * @var $statement \PDOStatement
     */
    protected $statement = null;
    protected $params = [];
    public function __construct()
    {
        $dbParams = Configs::getInstance()->db;
        $this->connection = new \PDO($dbParams['dsn'], $dbParams['user'], $dbParams['password']);
    }



    public function select($columns) {
        if(is_array($columns)) {
            $columns = implode(",", $columns);
        }
        $this->query .= " SELECT {$columns} FROM ";
        return $this;
    }

    public function from($table) {
        $this->query .= "{$table}";
        return $this;
    }


    public function where($conditions = []) {
        $whereContion = " ";
        foreach($conditions as $condition) {
            list($column, $operator, $input) = $condition;
            $whereContion .= "{$column} $operator :{$column}";
            $this->params[":{$column}"] = $input;
        }
        $this->query .= ltrim($whereContion, " AND ");
    }


    public function bindParams() {
        if($this->statement) {
            foreach($this->params as $column => $input) {
                $this->statement->bindParam($column, $input);
            }
        }
    }

    public function prepareQuery() {
        $this->statement = $this->connection->prepare($this->query);
    }

    public function getStatement() {
        return $this->statement;
    }

    public function one($fetchType = \PDO::FETCH_OBJ) {
        $this->bindParams();
        return $this->getStatement()->fetch($fetchType);
    }

    public function all($fetchType = \PDO::FETCH_OBJ) {
        $this->bindParams();
        return $this->getStatement()->fetchAll($fetchType);
    }


    public function insert($table = "", $data = []) {

    }


    public function update($table, $data = []) {

    }


    public function execute() {

    }
}
