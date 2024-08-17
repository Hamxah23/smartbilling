

<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registrationModalLabel">User Registration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modalclose">
          <span aria-hidden="true" style="color: red;">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="registrationForm">
          <div class="form-group">
            <label for="fullname">Fullname:</label>
            <input type="text" class="form-control" id="fullname" name="fullname">
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email">
          </div>
          <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="number" class="form-control" id="phone" name="phone">
          </div>
          <div class="form-group">
            <label for="dpt">Department:</label>
            <select name="dpt" id="dpt" class="form-control">
              <option value=""></option>
              <?php foreach($dptddd as $value): ?>
                <option value="<?= htmlspecialchars($value['Department']) ?>"><?= htmlspecialchars($value['Department']) ?></option>
              <?php endforeach; ?>
              <option value="hh">kjhkjh</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end of modal registration -->



<!-- modal product -->
<!-- <div class="modal fade" id="product" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="form-group">
            <label for="product_department">Department:</label>
            <select name="product_department" id="product_department" class="form-control"></select>
          </div>
          <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter Product Name" required>
          </div>
          <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div> -->
<!-- end of modal product -->
