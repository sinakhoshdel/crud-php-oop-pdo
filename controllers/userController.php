<?php
require_once ('models/User.php');
class userController{
  
  public $response = [
    'status'=>'error',
    'message' => 'Failed - Something went wrong!'
  ];
  
  /*Select users*/
  public function getUsers(){
    $userModel = new User;
    $users = $userModel->getUsers();
    return $users;
  }
  
  public function addUser($user){
    $userModel = new User;
    if($userModel->addUser($user)){
      $this->response = [
        'status'=>'success',
        'message' => 'User has been created successfully!'
      ];
    }
    return $this->response;
  }
  
  public function updateUser($id,$user){
    $userModel = new User;
    if($userModel->updateUser($id,$user)){
      $this->response = [
        'status'=>'success',
        'message' => 'User has been updated successfully!'
      ];
    }
    return $this->response;
  }
  
  /* Delete a User */
      public function deleteUser($id)
      {
        $userModel = new User;
        if($userModel->deleteUser($id)){
          $this->response = [
            'status'=>'success',
            'message' => 'User has been deleted successfully!'
          ];
        }
        return $this->response;
      }

}