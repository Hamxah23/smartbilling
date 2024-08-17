

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-5"></div>
    <div class="col-sm-5"></div>
    <div class="col-sm-2">
      <button type="submit" class="btn btn-primary" data-target="#modalUnit" data-toggle="modal"><strong><span class="fa fa-plus-square"></span> Add unit</strong></button>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-sm-12">
      <table class="table table-striped" id="tblUnit" style="width: 100%; margin: auto;">
        <thead>
          <tr>
            <th style="text-align: center;">#</th>
            <th>Department</th>
            <th>Date Register</th>
            <th>Time Register</th>
            <th>Register by</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<!-- modal units -->
<div class="modal fade" tabindex="-1" id="modalUnit" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><strong class="text-primary">Add Unit/Department</strong></h5>
        <button class="close" aria-label="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form id="formUnit">
          <input id="deptID" type="text" name="deptID">
          <div class="form-group">
            <label for="units"><strong>Unit:</strong></label>
            <input id="units" class="form-control" type="text" name="units">
            <i class="text-danger" id="errorUnit"></i>
          </div>
          <button type="submit" id="saveButton" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<style>
    .center {
        text-align: center;
    }
</style>
<script>
  $(document).ready(function() {
    var table = $('#tblUnit').DataTable({
        "processing": true,
        "serverSide": false,
        "responsive": true,
        "ajax": {
            "url": "controller/unit.table.php",
            "type": "GET",
            "dataType": "json",
            "dataSrc": "data"
        },
        "columns": [
            { "data": null,
              "sn": "center", 
              "render": function (data, type, row, meta) {
                return meta.row + 1; 
              } 
            },
            { "data": "Department" },
            { "data": "dateregister" },
            { "data": "timeregister" },
            { "data": "registerby" },
            { "data": "Status" },
            { "data": null, "render": function(data, type, row) {
                return '<button class="btn btn-primary edit-button"><span class="fa fa-edit"></span></button>'; 
            }}
        ]
    });

    $('#tblUnit tbody').on('click', 'button.edit-button', function() {
        var data = table.row($(this).parents('tr')).data();
        $('#units').val(data.Department);
        $('#deptID').val(data.deptID); // Ensure the hidden input is set
        $('#saveButton').text('Update').removeClass('btn-primary').addClass('btn-info');
        $('#modalUnit').modal('show');
    });

    $('#formUnit').on('submit', function(e) {
        e.preventDefault();
        var id = $('#deptID').val();
        var url = id ? 'controller/update.unit.php' : 'controller/add.unit.php';
        var buttonLabel = id ? 'Update' : 'Save';

        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#modalUnit').modal('hide');
                table.ajax.reload();
                $('#saveButton').text(buttonLabel).removeClass('btn-info').addClass('btn-primary');
            }
        });
    });

    $('#modalUnit').on('hidden.bs.modal', function() {
        $('#formUnit')[0].reset();
        $('#saveButton').text('Save').removeClass('btn-info').addClass('btn-primary');
        $('#deptID').val(''); 
    });
});




  /* $(document).ready(function(){
    $('#tblUnit').DataTable({
      "processing": true,
      "serverSide": false,
      "responsive": true, 
      "ajax": {
          "url": "controller/unit.table.php",
          "type": "GET",
          "dataType": "json",
          "dataSrc": "data"
        },
        "columns": [
          { "data": null,
            "sn": "center", 
            "render": function (data, type, row, meta) {
            return meta.row + 1; 
          } },
          { "data": "Department" },
          { "data": "dateregister" },
          { "data": "timeregister" },
          { "data": "registerby" },
          { "data": "Status" },
          { "data": null, "render": function(data, type, row) {
              return '<button class="btn btn-primary" data-id="'+row.id+'" data-department="'+ row.Department +'"><span class="fa fa-edit"></span></button>'; 
          }}
        ]
    });
  }); */
  
</script>
<script>
  $(document).ready(function(){
    $('#formUnit').on('submit', function(e){
      e.preventDefault();
      $.ajax({
        url: 'controller/addunit.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        success: function(response){
          console.log(response);
          if(!response.status){
            if(response.errors.emptyUnit){
              $('#errorUnit').text(response.errors.emptyUnit);
            }else if(response.errors.unitExists){
              $('#errorUnit').text(response.errors.unitExists);
            }else{
              $('#errorUnit').text(''); 
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
            $('#formUnit')[0].reset();
            $('#modalUnit').modal('hide');
            $("#errorUnit").text('');
          } 
        },
        error: function(xhr, status, error){
          console.error();
          alert('error: ' + error);
        }
      });
    });
  }); 
</script>