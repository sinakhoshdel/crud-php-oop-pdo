<?php
require_once('views/layouts/header.php');
require_once('controllers/userController.php');
$users = new userController();
$users = $users->getUsers();
?>
<body>

    <div class="container">
      <div class="row">
          <div class="table-top-wrapper">
            <div class="table-top-title">
              <div class="row">
                <div class="col-xs-6">
                  <h2>REMOVIFY TESTS</h2>
                </div>

              </div>
            </div>
          </div>

        <div id="accordion">

          <div class="card">

              <div class="card-body">
                <div class="table-wrapper">
                    <div class="table-title">
                      <div class="row">
                        <div class="col-xs-6">
                          <h2>Manage <b>Users</b></h2>
                        </div>
                        <div class="col-xs-6">
                          <a href="#addUserModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                  if(isset($feedback)){
                    $feedback['status'] = $feedback['status']=='error' ? 'danger' : $feedback['status'];
                    echo "
                    <div class='alert alert-{$feedback['status']}'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                      <strong>{$feedback['message']}
                    </div>
                    ";
                  }
                  ?>

                <div class="table-responsive">

                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>

                            <th class="col-md-4">Name</th>
                            <th class="col-md-2">Age</th>
                            <th class="hidden-xs hidden-sm col-md-5">Description</th>
                            <th class="col-md-1">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                              if(isset($users) && count($users)>0){
                                foreach ($users as $key => $value) {
                                  echo '
                                    <tr class="bg-light">

                                      <td>'.$value["name"].'</td>
                                      <td>'.$value["age"].'</td>
                                      <td class="hidden-xs hidden-sm">'.$value["description"].'</td>
                                      <td>
                                        <a href="#editUserModal'.$value["id"].'" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                        <a href="#deleteEmployeeModal" data-id="'.$value["id"].'" class="delete deleteUser" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                      </td>
                                      <div id="editUserModal'.$value["id"].'" class="modal fade">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                              <form action="process.php" method="post">
                                                <input type="hidden" name="token" value="'.$_SESSION['token'] .'">
                                                <input type="hidden" name="user_id" value="'.$value["id"].'">
                                                <input type="hidden" name="operation" value="UPDATE">
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Edit User</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                  <div class="form-group">
                                                    <label>Name</label>
                                                    <input name="name" type="text" class="form-control" value="'.$value["name"].'" required>
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Age</label>
                                                    <input name="age" type="number" min="1" max="120" class="form-control" value="'.$value["age"].'" required>
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea name="description" class="form-control" >'.$value["description"].'</textarea>
                                                  </div>

                                                </div>
                                                <div class="modal-footer">
                                                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                  <input type="submit" class="btn btn-success" value="Save">
                                                </div>
                                              </form>
                                          </div>
                                        </div>
                                      </div>
                                  </tr>
                                  ';
                                }
                              }else{
                                echo '
                                    <tr>
                                      <td colspan="5" class="bg-info">
                                        <h5 class="text-center">no record found!</h5>
                                      </td>
                                    </tr>
                                ';
                              }


                          ?>

                        </tbody>
                      </table>

                </div>
            </div>
          </div>
        </div>
      </div>


	<!-- add Modal HTML -->
	<div id="addUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="process.php" method="post">
          <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
          <input type="hidden" name="operation" value="CREATE">
					<div class="modal-header">
						<h4 class="modal-title">Add User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Name</label>
							<input name="name" type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Age</label>
							<input name="age" type="number" min="1" max="120" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea name="description" class="form-control"></textarea>
						</div>

					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="process.php" method="post">
          <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
          <input type="hidden" name="user_id" value="">
          <input type="hidden" name="operation" value="DELETE">
					<div class="modal-header">
						<h4 class="modal-title">Delete User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete this User?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default cancelDelete" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div>

  <?php
  require_once('views/layouts/footer.php');
  ?>
