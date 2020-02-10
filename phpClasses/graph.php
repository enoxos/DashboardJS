<?php


class graph
{

    private $limit=30;
    private $dataPoints = array();
    private $labelTime = array();
    private $table = 'beverages';
    private $pdo; //obj

    public function __construct($pdo)
    {
      $this->pdo = $pdo;
    }

    public function fillLine($column){
      $this->dataPoints = array();
      $this->labelTime = array();
      
      try {
        foreach($this->pdo->query("SELECT * FROM " . $this->table . " LIMIT " . $this->limit) as $row )
        {
        	array_push($this->labelTime, $row["Date"]);
        	array_push($this->dataPoints, $row[$column]);

        }

      }
      catch (PDOException $e) {
        echo 'error with graph: ' . $e->getMessage();
      }
    }

    public function getDatapoints(){
      return $this->dataPoints;
    }
    public function getLabelTime(){
      return $this->labelTime;
    }
    public function setColumn($column){
      $this->column = $column;
    }
    public function setLimit($limit){
      $this->limit = $limit;
    }
}


?>
