<?php
  class Menu {

    
    private $db;

    public function __construct(){
      $this->db = new Database;
    }


    public function findMenu(){
      
      $this->db->query("select * from menu");

	if(isset($_GET['find']))
 		{
 			$find = '%' . $_GET['find'] . '%';
 			$query = "select * from menu where title like :find order by id desc limit $limit offset $offset";
 			$arr['find'] = $find;
 		}

 		$results = $user->query($query,$arr);
  
    return $results;

    }


    public function getMenus(){
      $this->db->query('SELECT *,
                        menu.id as postId,
                        menu.id as userId,
                        menu.price as price,
                        menu.created_at as postCreated,
                        users.created_at as userCreated
                        FROM menu
                        INNER JOIN users
                        ON menu.user_id = users.id
                        ORDER BY menu.created_at DESC
                        ');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addMenu($data){
      $this->db->query('INSERT INTO menu (title, user_id, price, description) VALUES(:title, :user_id, :price, :description)');
      // associate values
      $this->db->associate(':title', $data['title']);
      $this->db->associate(':user_id', $data['user_id']);
      $this->db->associate(':description', $data['description']);
      $this->db->associate(':price', $data['price']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateMenu($data){
      $this->db->query('UPDATE menu SET title = :title, description = :description , price = :price WHERE id = :id');
      // associate values
      $this->db->associate(':id', $data['id']);
      $this->db->associate(':title', $data['title']);
      $this->db->associate(':description', $data['description']);
      $this->db->associate(':price', $data['price']);
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getMenuById($id){
      $this->db->query('SELECT * FROM menu WHERE id = :id');
      $this->db->associate(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function deleteMenu($id){
      $this->db->query('DELETE FROM menu WHERE id = :id');
      // associate values
      $this->db->associate(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function query($query,$data = array(),$data_type = "object")
	{

		$con = $this->con();
		$stm = $con->prepare($query);

		$result = false;
		if($stm){
			$check = $stm->execute($data);
			if($check){
				if($data_type == "object"){
					$result = $stm->fetchAll(PDO::FETCH_OBJ);
				}else{
					$result = $stm->fetchAll(PDO::FETCH_ASSOC);
				}
 
 			}
		}
  }
}