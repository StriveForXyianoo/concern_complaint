<title>Concern and Complaint Reporting System | Dashboard</title>
<?php
require_once 'sidebar.php';
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $days = $diff->days;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );

    foreach ($string as $key => &$value) {
        if (!empty($diff->$key)) {
            $value = $diff->$key . ' ' . $value . ($diff->$key > 1 ? 's' : '');
        } else {
            unset($string[$key]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inbox</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Inbox</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="row">
        <!-- <div class="col-md-3">
          <a href="compose.html" class="btn btn-primary btn-block mb-3">Compose</a>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Folders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <a href="#" class="nav-link">
                    <i class="fas fa-inbox"></i> Inbox
                    <span class="badge bg-primary float-right">12</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-envelope"></i> Sent
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-file-alt"></i> Drafts
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-filter"></i> Junk
                    <span class="badge bg-warning float-right">65</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-trash-alt"></i> Trash
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div> -->
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Complaints inbox</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" id="searchMailInput" placeholder="Search Mail">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <button type="button" class="btn btn-danger btn-sm checkbox-toggle">Mark as read</button>
                

              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <?php 
                    $get_c = mysqli_query($conn, "SELECT * FROM complaint c JOIN users u ON c.added_by=u.user_Id ORDER BY is_read ASC, date_added DESC");
                    if(mysqli_num_rows($get_c) > 0) {
                      while ($row2 = mysqli_fetch_array($get_c)) {
                  ?>
                    <tr <?php echo ($row2['is_read'] == 0) ? 'style="font-weight: bold;"' : 'class="text-muted"'; ?> data-searchable="<?= strtolower($row2['firstname'].' '.$row2['lastname'].' '.$row2['complaint_nature'].' '.$row2['details']); ?>">

                      <td>
                          <div class="icheck-primary">
                              <input type="checkbox" value="<?= $row2['complaint_ID']; ?>" id="check<?= $row2['complaint_ID']; ?>" <?php if($row2['is_read'] == 1) { echo 'disabled'; }  ?>>
                              <label for="check<?= $row2['complaint_ID']; ?>"></label>
                          </div>
                      </td>
                      <td class="mailbox-name"><a href="complaint_view.php?complaint_ID=<?= $row2['complaint_ID'] ?>"><?= ucwords($row2['firstname'].' '.$row2['lastname']) ?></a></td>
                      <td class="mailbox-subject"><b><?= ucwords($row2['complaint_nature']) ?></b> - <?php echo ucwords(substr($row2['details'], 0, 30)) . '...'; ?>
                      </td>
                      <td class="mailbox-date"><?php echo time_elapsed_string($row2['date_added']); ?></td>
                    </tr>
                  <?php
                      }
                    } else {
                  ?>
                    <tr>
                      <td class="text-center">No record found</td>
                    </tr>
                  <?php
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
           <div class="card-footer p-1">
              <!-- pagination here -->
          </div>


          </div>
        </div>
      </div>
    </section>
  <?php require_once '../includes/footer.php'; ?>

<script>
$(document).ready(function() {
  // Function to filter the table rows based on user input
  function filterTable(query) {
    query = query.toLowerCase(); // Convert the input to lowercase for case-insensitive search

    $('.mailbox-messages tbody tr').each(function() {
      var searchableText = $(this).data('searchable');
      if (searchableText.includes(query)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  }

  // Event listener for input changes in the search input
  $('#searchMailInput').on('input', function() {
    var searchTerm = $(this).val();
    filterTable(searchTerm);
  });
});
</script>
<script>
  $(document).ready(function() {
    $('.checkbox-toggle').on('click', function() {
      var checked = $('.mailbox-messages input[type="checkbox"]:checked');
      var complaintIds = [];

      checked.each(function() {
        complaintIds.push($(this).val());
      });

      if (complaintIds.length > 0) {
        markComplaintsAsRead(complaintIds);
      } else {
        alert('Please select at least one complaint to mark as read.');
      }
    });

    function markComplaintsAsRead(complaintIds) {
      $.ajax({
        type: 'POST',
        url: 'mark_as_read_complaint.php',
        data: { complaint_ids: complaintIds },
        success: function(response) {
          if (response.startsWith('success')) {
            alert('Complaints marked as read successfully.');
            location.reload();
          } else {
            alert('Error marking complaints as read. Please try again. Error: ' + response);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error marking complaints as read. Please try again. Error: ' + errorThrown);
        }
      });
    }
  });
</script>
