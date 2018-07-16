<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 4:24 PM
 */

namespace core\database;

use core\Configs;

class Query
{
    private $connection = null;
    private $queryString = "";

    protected $joinTypes = [
        "join" => "INNER JOIN",
        "leftJoin" => "LEFT JOIN",
        "rightJoin" => "RIGHT JOIN",
    ];

    /**
     * @var $statement \PDOStatement
     */
    protected $statement = null;
    protected $params = [];

    public function __construct()
    {
        $dbParams = Configs::getInstance()->db;
        try {
            $this->connection = new \PDO($dbParams['dsn'], $dbParams['user'], $dbParams['password']);
        } catch (\PDOException $e) {
            echo $e->getMessage() . " on line:" . __LINE__;
            die();
        }
    }


    public function getConnection()
    {
        return $this->connection;
    }


    public function select($columns)
    {
        if (is_array($columns)) {
            $columns = implode(",", $columns);
        }
        $this->queryString .= " SELECT {$columns} FROM ";
        return $this;
    }

    public function from($table)
    {
        $this->queryString .= "{$table}";
        return $this;
    }

    public function join($type = "join", $table, $condition)
    {
        if (!empty($this->joinTypes[$type])) {
            $this->queryString .= "{$this->joinTypes[$type]} {:$table} {:$condition}";
            $this->params[":{$table}"] = $table;
            $this->params[":{$condition}"] = $condition;
        } else {
            throw new \PDOException(sprintf("unrecognized join type: %s", $type));
        }
        return $this;
    }

    public function andWhere($column, $operation, $input)
    {
        $this->params[":{$column}"] = $input;
        return "AND {$column} $operation :{$column} ";
    }

    public function where($conditions = [])
    {
        if(count($conditions)) {
            $whereCondition = " ";
            foreach ($conditions as $condition) {
                list($column, $operator, $input) = $condition;
                $whereCondition .= $this->andWhere($column, $operator, $input);
            }
            $this->queryString .= " WHERE " . ltrim($whereCondition, " AND ");
        }
        return $this;
    }

    public function buildStatement()
    {
        if (!$this->statement) {
            $this->statement = $this->connection->prepare($this->queryString);
        }
    }


    public function bindParams()
    {
        if ($this->statement) {
            foreach ($this->params as $column => $input) {
                $this->statement->bindParam($column, $input, \PDO::PARAM_STR);
            }
        }
    }

    public function prepareQuery()
    {
        $this->statement = $this->connection->prepare($this->queryString);
    }

    public function getStatement()
    {
        return $this->statement;
    }


    public function one($fetchType = \PDO::FETCH_OBJ)
    {
        $this->buildStatement();
        $this->bindParams();
        $this->getStatement()->execute();
        if ($this->getStatement()->errorCode() == 0) {
            return $this->getStatement()->fetch($fetchType);
        }

        throw new \PDOException($this->getStatement()->errorInfo()[2]);
    }

    public function all($fetchType = \PDO::FETCH_OBJ)
    {
        $this->buildStatement();
        $this->bindParams();
        $this->getStatement()->execute();

        if ($this->getStatement()->errorCode() == 0) {
            return $this->getStatement()->fetchAll($fetchType);
        }
        throw new \PDOException($this->getStatement()->errorInfo()[2]);
    }


    public function toSql()
    {
        return $this->queryString;
    }

    public function getTables()
    {
        $query = "show tables";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }


    public function getColumnsOfTable($table = "")
    {
        $this->query = "DESCRIBE {$table}";
        try {
            $this->buildStatement();

            $this->getStatement()->execute();
            return $this->getStatement()->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }


    public function insert($table = "", $data = [])
    {
        if (count($data) === 0) {
            throw new \PDOException(sprintf("data cannot be empty! line: %s, file: %s", __LINE__, __FILE__));
        }

        $this->queryString = sprintf(
            "INSERT INTO {$table} (%s) VALUES(%s)",
            implode(",", array_keys($data)),
            implode(
                ",",
                array_map(
                    function ($input) {
                        return ":{$input}";
                    },
                    array_keys($data)
                )
            )
        );


        foreach ($data as $column => $input) {
            $this->params[":{$column}"] = $input;
        }

        $this->buildStatement();

        $this->bindParams();


        if (!$this->getStatement()->execute()) {
            throw new \PDOException($this->getStatement()->errorInfo()[2]);
        }
        return true;
    }


    public function update($table, $data = [], $where = [])
    {
        $this->query = "UPDATE {$table} SET ";

        foreach ($data as $column => $input) {
            $this->query .= "{$column} = :{$column}, ";
            $this->params[":{$column}"] = $input;
        }
        $this->query = trim($this->query, ", ") . " ";
        $this->where($where);

        $this->buildStatement();


        if (!$this->getStatement()->execute($this->params))
            throw new \PDOException($this->getStatement()->errorInfo()[2]);

        return true;
    }


    public function delete($table, $where = [])
    {
        $this->query = "DELETE FROM {$table}";

        $this->where($where);

        $this->buildStatement();

        $this->bindParams();

        try {
            return $this->getStatement()->execute();
        } catch (\PDOException $e) {
            throw $e;
        }
    }
}
