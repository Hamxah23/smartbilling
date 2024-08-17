<div class="container-fluid">
  <div class="row">
      <div class="col-sm-5"></div>
      <div class="col-sm-5"></div>
      <div class="col-sm-2">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userForm"><strong><i class="fas fa-fw fa-user-plus"></i>&nbsp;Add User</strong></button>
      </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <table class="table table-striped" id="userTable" >
        <thead>
          <tr>
            <th>#</th>
            <th>FullName</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Depart.</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          </thead>
          <?php $i = 1; foreach($sqlUsers as $user):?>
            <tr>
              <td style="text-align: center;"><?= $i ++; ?></td>
              <td><?= htmlspecialchars($user['Fullname']); ?></td>
              <td><?= htmlspecialchars($user['Email']); ?></td>
              <td><?= htmlspecialchars($user['Phone']); ?></td>
              <td><?= htmlspecialchars($user['Department']); ?></td>
              <td><?= htmlspecialchars($user['Role']); ?></td>
              <td><?= htmlspecialchars($user['Status']); ?></td>
              <td style="text-align: center;"><button class="btn btn-primary" name="edituser" id="<?= htmlspecialchars($user['userID']) ?>">edit</button></td>
            </tr>
          <?php endforeach ?>
      </table>
    </div>
  </div>
</div>

<div id="userForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="my-modal-title"><strong class="text-primary">User Registration</strong></h5>
        <button class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-dange" style="color: red;">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="formUser">
          <div class="form-group">
            <label for="fullname">Fullname:</label>
            <input type="text" class="form-control" id="fullname" name="userFullname">
            <i id="fullnameError" class="text-danger"></i>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email">
            <i id="emailError" class="text-danger"></i>
          </div>
          <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="number" class="form-control" id="phone" name="phone">
            <i id="phoneError" class="text-danger fs-6"></i>
          </div>
          <div class="form-group">
            <label for="">Role:</label>
            <select name="role" id="" class="form-control">
              <option value="--choose--">--choose--</option>
              <option value="Admin">Admin</option>
              <option value="User">User</option>
            </select>
            <i id="roleError" class="text-danger"></i>
          </div>
          <div class="form-group">
            <label for="dpt">Department:</label>
            <select name="department" id="dpt" class="form-control">
							<option value="--choose--">--choose--</option>
              <?php foreach($resultDepartment as $department):?>
                <option value="<?= htmlspecialchars($department['deptID']) ?>"><?= htmlspecialchars($department['Department']) ?></option>
              <?php endforeach ?>
            </select>
            <i id="departmentError" class="text-danger"></i>
          </div>
          <button type="submit" name="adduser" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('#formUser').on('submit', function(e){
      e.preventDefault();
      $.ajax({
        url: 'controller/adduser.php',
        dataType: 'json',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response){
          console.log(response);
          if(!response.status){
            if(response.errors.fname){
              $('#fullnameError').text(response.errors.fname);
            }else{
              $('#fullnameError').text('');  
            }
            if(response.errors.phone){
              $('#phoneError').text(response.errors.phone);
            }else if(response.errors.phoneExist){
              $('#phoneError').text(response.errors.phoneExist);  
            }else{
              $('#phoneError').text('');
            }
            if(response.errors.department){
              $('#departmentError').text(response.errors.department);
            }else{
              $('#departmentError').text('');
            }
            if(response.errors.email){
              $('#emailError').text(response.errors.email);
            }else if(response.errors.emailExist){
              $('#emailError').text(response.errors.emailExist);
            }else{
              $('#emailError').text('');
            }
            if(response.errors.role){
              $('#roleError').text(response.errors.role);
            }else{
              $('#roleError').text('');
            }
          }else{
            //alert('success');
            const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "success",
            title: response.message.success
            });
            $('#formUser')[0].reset();
            $('#userForm').modal('hide');
            $('#fullnameError').text(''); 
            $('#phoneError').text('');   
            $('#departmentError').text('');
          }
        },
        error: function(xhr, status, error){
          console.error(xhr);
          alert('error: ' + status+ ' ' + error);
        }
      });
    });
  });
</script>
<script>
  $('#userTable').DataTable();
	$('#usersTable').DataTable({
		//autoFill: true

	});
</script>