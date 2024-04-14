
<!-- STATUS -->
<div class="modal fade" id="updateStatus<?php echo $row['complaint_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-comment-alt nav-icon"></i> Update status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['complaint_ID']; ?>" name="complaint_ID">
          <select name="complaint_status" class="form-control" id="" required>
            <option value="0" <?php if($row['status'] == 0) { echo 'selected'; } ?>>Pending</option>
            <option value="1" <?php if($row['status'] == 1) { echo 'selected'; } ?>>Verified</option>
            <option value="2" <?php if($row['status'] == 2) { echo 'selected'; } ?>>Rejected</option>
            <option value="3" <?php if($row['status'] == 3) { echo 'selected'; } ?>>Solved</option>
          </select>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-primary" name="update_complaint_status"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
        </form>
    </div>
  </div>
</div>






<!-- DELETE -->
<div class="modal fade" id="delete<?php echo $row['complaint_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-comment-alt nav-icon"></i> Delete complaint</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['complaint_ID']; ?>" name="complaint_ID">
          <h6 class="text-center">Delete complaint record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-danger" name="delete_complaint"><i class="fas fa-trash"></i> Delete</button>
      </div>
        </form>
    </div>
  </div>
</div>








