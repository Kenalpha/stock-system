<?php

include "db.php";

class DataOperation extends Database
{
  public function insert_record($table, $fileds){
      //"INSERT INTO computers(d_name, qty) VALUES('', '')";
  	  $sql= "";
  	  $sql.="INSERT INTO ".$table;
  	  $sql.=" (".implode(",", array_keys($fileds)).") VALUES";
  	  $sql.="('".implode("','", array_values($fileds))."')";
  	  $query = mysqli_query($this->con, $sql);
  	  if($query){
         return true;
  	  }
  }

  public function fetch_record($table){
      $sql = "SELECT * FROM ".$table;
      $array = array();
      $query = mysqli_query($this->con, $sql);
      while($row = mysqli_fetch_assoc($query)){
        $array[] = $row;
      }
      // print_r($array);
      return $array;
  }

  public function select_record($table,$where){
      $sql = "";
      $condition = "";
      foreach ($where as $key => $value) {
        # id = '5' AND d_name = 'something'
        $condition .= $key ."='".$value."' AND ";
      }
      $condition = substr($condition, 0, -5);
      $sql .= "SELECT * FROM ".$table." WHERE ".$condition;
      $query = mysqli_query($this->con, $sql);
      $row = mysqli_fetch_array($query);
      return $row;
  }

  public function update_record($table, $where, $fields){
      $sql = "";
      $condition = "";
      foreach ($where as $key => $value) {
        # id = '5' AND d_name = 'something'
        $condition .= $key ."='".$value."' AND ";
      }
      $condition = substr($condition, 0, -5);
      foreach ($fields as $key => $value) {
        //UPDATE table SET d_name = '', qty = '' WHERE id = ''
        $sql .= $key . "='".$value."', ";
      }
      $sql = substr($sql, 0, -2);
      $sql ="UPDATE ".$table." SET ".$sql." WHERE ".$condition;
      if (mysqli_query($this->con, $sql)) {
          return true;
      }
  }

  public function delete_record($table, $where){
      $sql = "";
      $condition = "";
      foreach ($where as $key => $value) {
        $condition .= $key ."='".$value."' AND ";
      }
      $condition = substr($condition, 0, -5);
      $sql = "DELETE FROM ".$table." WHERE ".$condition;
      if(mysqli_query($this->con, $sql)){
        return true;
      }
  }
}

//upload function
function upload_Image($comp_image){
  $target_dir = "devices_images/";
  $target_file = $target_dir . basename($comp_image);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  return $imageFileType;
}

$obj = new DataOperation;
if(isset($_POST["submit"])){
  #test
  $comp_image=$_FILES["comp_image"]["name"];
  #test
  $myArray = array(
    "d_name" => $_POST["name"],
    "qty" => $_POST["qty"]
  	);
  if($obj->insert_record("computers", $myArray)){
    echo upload_Image($comp_image);
    // header("location: index.php?msg=Record Inserted");
  }
}

if(isset($_POST["edit"])){
  $id = $_POST["id"];
  $where = array("id"=>$id);
  $myArray = array(
    "d_name" => $_POST["name"],
    "qty" => $_POST["qty"]
    );
  if ($obj->update_record("computers", $where, $myArray)) {
      header("location: index.php?msg=Record Updated Successfully");
  }
}

if (isset($_GET["delete"])) {
    $id = $_GET["id"] ?? null;
    $where = array("id"=>$id);
    if($obj->delete_record("computers", $where)){
        header("Location: index.php?msg=Record Deleted Successfully");
    }
}

?>