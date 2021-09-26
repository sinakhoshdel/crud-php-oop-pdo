<?php
session_start();
require_once('controllers/userController.php');

$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

function Validator($data){
  $validationResponse = [
    'status' => true,
    'message' => ''
  ];
  
  if($data["operation"]!='DELETE'){
  
    if(empty($data['name']) || !preg_match("/^([a-zA-Z' ]+)$/",$data['name'])){
      $validationResponse = [
        'status' => 'error',
        'message' => 'Please Provide a correct name!'
      ];
    }
    if(empty($data['age']) || !is_numeric($data['age'])){
      $validationResponse = [
        'status' => 'error',
        'message' => 'Please Provide a correct age!'
      ];
    }
  }
    return $validationResponse;
}

if (!$token || $token !== $_SESSION['token'] || !isset($_REQUEST['operation'])) {
    // return 405 http status code
    die($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
} else {
    $data = $_POST;
    $ValidationResponse = Validator($data);
    
    if($ValidationResponse['status'] === true){
      
      $operation = $data['operation'];
      $users = new userController();
      $result = array(
        'status' => 'error',
        'message' => ''
      );
      switch ($operation) {
        //add new users
        case 'CREATE':
          $result = $users->addUser($data);
        break;
        //update existing user
        case 'UPDATE':
          $id = is_numeric($data['user_id']) ? $data['user_id'] : null;
          if(!is_null($id)){
            $result = $users->updateUser($id,$data);
          }else{
            $result = array(
              'status' => 'error',
              'message' => 'Failed! User Id is missing!'
            );
          }
        break;
        
        //delete users
        case 'DELETE':
          $id = is_numeric($data['user_id']) ? $data['user_id'] : null;
          if(!is_null($id)){
            $result = $users->deleteUser($id);
          }else{
            $result = array(
              'status' => 'error',
              'message' => 'Failed! User Id is missing!'
            );
          }
          break;
        
        
      }
    }else{
      $result = $ValidationResponse;
    }
    
    
    $_SESSION['feedback'] = $result;
    header('location:index.php');
}