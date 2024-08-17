<div class="container-fluid">
    <div class="row">
      <div class="col-sm-5"></div>
      <div class="col-sm-5"></div>
      <div class="col-sm-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalProduct"><strong>Add Service</strong></button>
      </div>
    </div>
    <br/>
    <div class="row">
      <div class="col-sm-12">
        <table class="table table-striped" id="productTable" style="width:100%">
          <thead>
              <tr style="text-align: center;">
                  <th>#</th>
                  <th>Department</th>
                  <th>Service</th>
                  <th>Price (NGN)</th>
                  <th>Status</th>
                  <th>Date Added</th>
                  <th>Time Added</th>
                  <th>Added By</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach($resultProduct as $pro):?>
              <tr>
                <td><?= $counter++ ?></td>
                <td><?= htmlspecialchars($pro['Department']) ?></td>
                <td><?= htmlspecialchars($pro['Productname']) ?></td>
                <td><?= htmlspecialchars($pro['Price']) ?></td>
                <td><?= htmlspecialchars($pro['Status']) ?></td>
                <td><?= htmlspecialchars($pro['DateRegister']) ?></td>
                <td><?= htmlspecialchars($pro['TimeRegister']) ?></td>
                <td><?= htmlspecialchars($pro['RegisterBy']) ?></td>
                <td>edit</td>
              </tr>
              <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
</div>
<div class="modal fade" id="modalProduct" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><strong>Add Product</strong></h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form id="FormProduct">
          <div class="form-group">
            <label for="product_department">Department:</label>
            <select name="department" id="product_department" class="form-control">
              <option value="--choose--">--choose--</option>
              <?php foreach($resultDepartment as $department):?>
                <option value="<?= htmlspecialchars($department['deptID']) ?>"><?= htmlspecialchars($department['Department']) ?></option>
              <?php endforeach ?>
            </select>
          <i id="errorDepartment" class="text-danger"></i>
          </div>
          <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" name="productName" id="product_name" class="form-control" placeholder="Enter Product Name">
            <i class="text-danger" id="errorProduct"></i>
          </div>
          <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" class="form-control">
            <i id="errorPrice" class="text-danger"></i>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('#FormProduct').on('submit', function(e){
      e.preventDefault();
      $.ajax({
        url: 'controller/addproduct.php',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response){
          if(!response.status){
            if(response.errors.product){
              $('#errorProduct').text(response.errors.product);
            }else{
              $('#errorProduct').text('');
            }
            if(response.errors.price){
              $('#errorPrice').text(response.errors.price);
            }else{
              $('#errorPrice').text('');
            }
            if(response.errors.department){
              $('#errorDepartment').text(response.errors.department) 
            }else{
              $('#errorDepartment').text('');
            }
          }else{
            //alert('success');
            const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
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
            $('#FormProduct')[0].reset();
            $('#modalProduct').modal('hide'); 

          }
        },
        error: function(xhr, status, error){
          console.error('Error' + xhr.responseText)
          alert('error script:' + error);
          console.error(error);
        }
      });
    });
  });
</script>
<script>
  $('#productTable').DataTable();
  /* $(document).ready(function() {
    $('#productTable').DataTable({
        "processing": true,
        "serverSide": false, 
        "ajax": {
            "url": "controller/manageproduct.php",
            "type": "GET",
            "dataType": "json",
            "dataSrc": function (json) {
                console.log(json); 
                return json.data;
            }
          },
        "columns": [
          { "data": "#" },
          { "data": "Department" },
          { "data": "Service" },
          { "data": "Price" }, 
          { "data": "Status" },
          { "data": "Date Added" },
          { "data": "Time Added" },
          { "data": null, "render": function(data, type, row) {
              return '<button>Edit</button>'; 
          }}
        ]
    });
}); */
</script>