<?php
  require_once ('connect.php');

  
	class User
	{
    public $table = 'users';
    
    // select record     
    public function getUsers($id=null)
    {
      $connect = new Connect();
      $conn = $connect->openConnection();
        
      $sql = "SELECT id,name,description, age FROM `{$this->table}`";
      if(!is_null($id) && is_numeric($id)){
        $sql.=" where id={$id}";
      }
      $sql.= " ORDER BY id DESC";
      $resource = $conn->query($sql);
      $result = $resource->fetchAll(PDO::FETCH_ASSOC);
      $connect->closeConnection();
      return $result;  
    }
    
    // insert record
		public function addUser($user)
		{
        $connect = new Connect();
        $conn = $connect->openConnection();
          
				$query=$conn->prepare("INSERT INTO `{$this->table}` (name,age,description) VALUES (:name,:age,:description)");
        $query->bindParam(':name',$user['name']);
        $query->bindParam(':age',$user['age']);
        $query->bindParam(':description',$user['description']);

				$query->execute();
        $connect->closeConnection();
        if( !$query->rowCount() ){
          return false;	
        }else{
          return true;	
        }
			
		}
    
    //update record
    public function updateUser($id,$user)
    {
        $connect = new Connect();
        $conn = $connect->openConnection();
    		$query=$conn->prepare("UPDATE `{$this->table}` SET name=:name,age=:age,description=:description WHERE id=:id");
        $query->bindParam(':name',$user['name']);
        $query->bindParam(':age',$user['age']);
        $query->bindParam(':description',$user['description']);
        $query->bindParam(':id',$id);
    		$query->execute();
    		$connect->closeConnection();
        if( !$query->rowCount() ){
          return false;	
        }else{
          return true;	
        }
    }
    
    // delete record
    public function deleteUser($id)
    {	
        $connect = new Connect();
        $conn = $connect->openConnection();
        $query=$conn->prepare("DELETE FROM `{$this->table}` WHERE id =:id");
        $query->bindParam(':id',$id);
        $query->execute();
        $connect->closeConnection();

        if( !$query->rowCount() ){
          return false;	
        }else{
          return true;	
        }
    }   
    
	}

?>