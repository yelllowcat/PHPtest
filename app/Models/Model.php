<?php

namespace app\Models;

use mysqli;

class Model{
    
    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_name = DB_NAME;


    protected $connection;
    protected $query;

    protected $orderBy;
    protected $where, $values =[];
    protected $select = "*";

    public function __construct(){
        $this->connection();
    }
    public function connection(){
        
        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if($this->connection->connect_error){
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql, $data =[], $params =null){
        if($data){
            if($params == null){
                $params = str_repeat('s', count($data));
            }
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param($params, ...$data);
            $stmt->execute();
            $this->query =$stmt->get_result();
        }else{
            $this->query = $this->connection->query($sql);
        }
         return $this;
    }
    public function select(...$columns){
        $this->select = implode(', ', $columns);
        return $this;
    }
    
    public function fetchAll(){

        if(empty($this->query)){

            $sql = "SELECT {$this->select} FROM {$this->table}";
            if($this->where){
                $sql .= " WHERE {$this->where}";
            }
            if($this->orderBy){
                $sql .= " {$this->orderBy}";
            }

            $this->query($sql, $this->values);
        }


        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

    public function orderBy($column, $order = 'ASC'){
        if(empty($this->orderBy)){
            
            $this->orderBy = " ORDER BY {$column} {$order}";
        }else{
            $this->orderBy .= " , {$column} {$order}";
        }
        return $this;
    }

    public function fetchOne(){

        if(empty($this->query)){

            $sql = "SELECT {$this->select} FROM {$this->table}";
            if($this->where){
                $sql .= " WHERE {$this->where}";
            }
            if($this->orderBy){
                $sql .= " {$this->orderBy}";
            }

            $this->query($sql, $this->values);
        }

        return $this->query->fetch_assoc();
    }

    public function paginate($limit = 10){
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

  

        if(empty($this->query)){

            $sql = "SELECT {$this->select} FROM {$this->table}";
            if($this->where){
                $sql .= " WHERE {$this->where}";
            }
            if($this->orderBy){
                $sql .= " {$this->orderBy}";
            }
            $sql .= " LIMIT " . ($page - 1)*$limit .",{$limit}";
            $data = $this->query($sql, $this->values)->fetchAll();

        }

        $total = $this->query("SELECT FOUND_ROWS() as total")->fetchOne()['total'];
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');
        $from = ($page - 1)*$limit + 1;
        $to = min($page*$limit, $total);
      

        if(strpos($uri, '?')){
            $uri = substr($uri, 0, strpos($uri, '?'));
            
        }
        $prev = $page ==1? null : '/' . $uri . '?page=' . $page - 1;

        $next = $page == ceil($total/$limit) ? null : '/' . $uri . '?page=' . $page + 1;

        $last_page = ceil($total/$limit);
        return compact('data', 'page', 'limit', 'total', 'from', 'to', 'prev', 'next', 'last_page');
    }

    public function all(){
      
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->fetchAll();
    }

    public function find($id){
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->query($sql, [$id], 'i')->fetchOne();
    }

    public function where($column, $operator,$value = null){

        if($value == null){
            $value = $operator;
            $operator = '=';
        }

     
        if (empty($this->where)) {
            $this->where = "$column $operator ?";
        } else {
            $this->where .= " AND $column $operator ?";
        }
        $this->values[] = $value;
        
        
        
        return $this;
    }
    
    public function create($data){

        $columns = array_keys($data);
        $columns = implode(', ', $columns);
        $values = array_values($data);

        $query = "INSERT INTO {$this->table} ($columns) VALUES (" . str_repeat('?, ', count($values)-1) . '?)';
        $this->query($query, $values);

        $insert_id =$this->connection->insert_id;
        return $this->find($insert_id);
    }

    public function update($id, $data){
       
        $fields = [];
        foreach($data as $key => $value){
            $fields[] = "{$key} = ?";
        }
        $fields = implode(', ', $fields);

        $query = "UPDATE {$this->table} SET $fields WHERE id = ?";
        $values = array_values($data);

        $values[] = $id;
        $this->query($query, $values);
        return $this->find($id);
    }

    public function delete($id){
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        $this->query($query, [$id], 'i');
    }
}
