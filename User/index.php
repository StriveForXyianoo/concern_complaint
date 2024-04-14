<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'header.php';
?>

<script src="../plugins/jquery/jquery.min.js"></script>
<div class="content p-2">
<!-- <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> All Books</h1>
          </div>
          <div class="col-sm-6 ">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Books information</li>
            </ol>
          </div>
        </div>
      </div>
    </div> -->
<?php

if (isset($_GET['book_title'])) {
    // $book_title = mysqli_real_escape_string($conn, $_GET['book_title']);
    $book_title = isset($_GET['book_title']) ? htmlspecialchars($_GET['book_title']) : '';

    if (!empty($book_title)) {

        $recordsPerPage = 5;
        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
         $currentPage = $_GET['page'];
        } else {
          $currentPage = 1;
        }
        $offset = ($currentPage - 1) * $recordsPerPage;
        $search2 = mysqli_query($conn, "SELECT * FROM books WHERE qty_available > 0 AND title LIKE '%" . $book_title . "%' LIMIT $offset, $recordsPerPage");

        if ($search2 === false) {
            die("Query execution error: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($search2) > 0) { ?>
          <section class="content-header m-3">
            <div class="container">
              <h2 class="text-center display-3" style="font-weight: bold;">
              <a href="">
                <span style="color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">L</span>
                <span style="color: #dc3545; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">I</span>
                <span style="color: #ffc107; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">B</span>
                <span style="color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">R</span>
                <span style="color: #28a745; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">A</span>
                <span style="color: #dc3545; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">R</span>
                <span style="color: #ffc107; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">Y</span>
              </a>
              </h2>
            </div>
          </section>
          <section class="content">
            <div class="container">
              <form id="searchForm" action="" method="GET">
                <div class="row">
                  <div class="col-md-8 offset-md-2">
                    <div class="form-group">
                      <div class="input-group input-group-lg">
                        <input type="search" class="form-control form-control-lg" placeholder="Search book..." name="book_title" value="<?php echo $book_title; ?>" required>
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-lg btn-default">
                          <i class="fa fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
          <section class="content-header m-2">
              <div class="container">
        <?php
            while ($row = mysqli_fetch_array($search2)) { ?>
                <div class="list-group-item">
                  <div class="row">
                    <div class="col px-0">
                      <div>
                        <div class="float-right text-muted"><?php echo $row['call_num']; ?></div>
                        <h6 class="text-primary"><a href="book-info.php?book_ID=<?php echo $row['book_ID']; ?>"><?php echo $row['title']; ?></a></h6>
                        <p class="mb-0"><?php echo $row['sub_title'] ?><br>
                          <span class="text-success">Available: </span><?php echo $row['qty_available']; ?>
                        </p>
                        <a type="button" class="float-right" data-toggle="modal" data-target="#borrow<?php echo $row['book_ID']; ?>" style="font-size: 13px;">Borrow book</a>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Borrow book (book-info.php) -->
                <div class="modal fade" id="borrow<?php echo $row['book_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-book"></i> Borrow book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                        </button>
                      </div>
                  
                      <div class="modal-body">
                        <form action="process_save.php" method="POST" enctype="multipart/form-data">
                          <input type="hidden" class="form-control form-control-sm" value="<?php echo $book_title; ?>" name="book_title">
                          <input type="hidden" class="form-control form-control-sm" value="<?php echo $row['book_ID']; ?>" name="book_ID">
                          <input type="hidden" class="form-control form-control-sm" value="<?php echo $id; ?>" name="user_ID">
                          <input type="hidden" class="form-control form-control-sm" value="<?php echo $user_type; ?>" id="user_type">
                          <h5 class="card-title"><?php echo ucwords($row['title']); ?></h5>
                          <p class="card-text"><?php echo $row['sub_title']; ?></p>
                          <ul class="list-group list-group-flush">
                              <li class="list-group-item"><strong>Call Number:</strong> <?php echo $row['call_num']; ?></li>
                              <li class="list-group-item"><strong>Accession Number:</strong> <?php echo $row['accession_num']; ?></li>
                              <li class="list-group-item"><strong>Publisher:</strong> <?php echo ucwords($row['publisher']); ?></li>
                              <li class="list-group-item"><strong>Place Published:</strong> <?php echo ucwords($row['place_published']); ?></li>
                              <li class="list-group-item"><strong>Date Published:</strong> <?php echo date("F d, Y", strtotime($row['date_published'])); ?></li>
                              <li class="list-group-item"><strong>Edition:</strong> <?php echo $row['edition']; ?></li>
                              <li class="list-group-item"><strong>Volume:</strong> <?php echo $row['volume']; ?></li>
                              <li class="list-group-item"><strong>ISBN:</strong> <?php echo $row['isbn']; ?></li>
                              <li class="list-group-item"><strong>Quantity:</strong> <?php echo $row['qty']; ?></li>
                              <li class="list-group-item"><strong>Available Quantity:</strong> <?php echo $row['qty_available']; ?></li>
                              <li class="list-group-item"><strong>Copyright:</strong> <?php echo $row['copyright']; ?></li>
                              <li class="list-group-item"><strong>Created At:</strong> <?php echo date("F d, Y", strtotime($row['created_at'])); ?></li>
                          </ul>
                        <hr>
                     <div class="form-group">
                        <span class="text-dark"><b>Where To Use</b></span>
                        <select class="form-control" name="place_to_use" id="place_to_use_<?php echo $row['book_ID']; ?>" required>
                            <option selected disabled value="">Select place</option>
                            <option value="At home">At home</option>
                            <option value="In the library itself">In the library itself</option>
                            <option value="Overnight">Overnight</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <span class="text-dark"><b>Duration</b></span>
                        <select class="form-control" name="duration" id="duration_<?php echo $row['book_ID']; ?>" required>
                            <option selected disabled value="">Select place first</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="symbols">Location Symbols</label>
                        <select class="form-control" name="symbols" id="symbols_<?php echo $row['book_ID']; ?>" required>
                            <option value="CD/VCD/DVD/VHS/GLOBE/MAPS">CD/VCD/DVD/VHS/GLOBE/MAPS</option>
                            <option value="F">F</option>
                            <option value="FC">FC</option>
                            <option value="GC">GC</option>
                            <option value="GS">GS</option>
                            <option value="PR">PR</option>
                            <option value="PROF. ED.">PROF. ED.</option>
                            <option value="R">R</option>
                            <option value="RS">RS</option>
                            <option value="RT">RT</option>
                            <option value="SB">SB</option>
                            <option value="SHS">SHS</option>
                            <option value="SM">SM</option>
                            <option value="TB">TB</option>
                            <option value="TS">TS</option>
                        </select>
                    </div>
                      </div>
                      <div class="modal-footer alert-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
                        <button type="submit" class="btn bg-gradient-primary" name="borrow_book" id="borrow_book"><i class="fa-solid fa-floppy-disk"></i> Confirm</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
             <script>
              $(document).ready(function () {
                  var placeOptions = {
                      'At home': {
                          Student: {
                              duration: ['1 Week Maximum'],
                              symbols: ['F', 'FC', 'GC', 'GS', 'PROF. ED.', 'SB', 'SHS', 'SM', 'TB', 'TS']
                          },
                          Teacher: {
                              duration: ['3 Months Maximum'],
                              symbols: ['F', 'FC', 'GC', 'GS', 'PROF. ED.', 'SB', 'SHS', 'SM', 'TB', 'TS']
                          }
                      },
                      'In the library itself': {
                          Student: {
                              duration: ['Today @5PM'],
                              symbols: ['CD/VCD/DVD/VHS/GLOBE/MAPS', 'R', 'RT', 'PR']
                          },
                          Teacher: {
                              duration: ['Today @5PM'],
                              symbols: ['CD/VCD/DVD/VHS/GLOBE/MAPS', 'R', 'RT', 'PR']
                          }
                      },
                      'Overnight': {
                          Student: {
                              duration: ['Until tomorrow @ 8:00 AM'],
                              symbols: ['RS']
                          },
                          Teacher: {
                              duration: ['1 Month Maximum'],
                              symbols: ['RS']
                          }
                      }
                  };

                  updateOptions();

                  $('#place_to_use_<?php echo $row['book_ID']; ?>').change(function () {
                      updateOptions();
                  });

                  function updateOptions() {
                      var selectedPlace = $('#place_to_use_<?php echo $row['book_ID']; ?>').val();
                      var userType = $('#user_type').val();
                      var durationSelect = $('#duration_<?php echo $row['book_ID']; ?>');
                      var symbolsSelect = $('#symbols_<?php echo $row['book_ID']; ?>');

                      durationSelect.empty();
                      symbolsSelect.empty();

                      durationSelect.append($('<option selected disabled value="">Select place first</option>'));
                      symbolsSelect.append($('<option value="" selected disabled>Select symbol</option>'));

                      if (placeOptions.hasOwnProperty(selectedPlace) && placeOptions[selectedPlace].hasOwnProperty(userType)) {
                          $.each(placeOptions[selectedPlace][userType].duration, function (index, value) {
                              durationSelect.append($('<option>', {
                                  value: value,
                                  text: value
                              }));
                          });

                          $.each(placeOptions[selectedPlace][userType].symbols, function (index, value) {
                              symbolsSelect.append($('<option>', {
                                  value: value,
                                  text: value
                              }));
                          });

                          durationSelect.val(placeOptions[selectedPlace][userType].duration[0]).prop('selected', true);
                      }
                  }
              });
          </script>
        <?php } ?>
            </div>
          </section>

            <div class="container">
                <ul class="pagination justify-content-end">
                    <?php
                    // Modify the query to get the total count based on your search criteria
                    $totalPagesQuery = mysqli_query($conn, "SELECT COUNT(book_ID) AS total FROM books WHERE qty_available > 0 AND title LIKE '%" . $book_title . "%'");
                    $totalPagesRow = mysqli_fetch_assoc($totalPagesQuery);
                    $totalPages = ceil($totalPagesRow['total'] / $recordsPerPage);

                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo "<li class='page-item" . ($currentPage == $i ? ' active' : '') . "'><a class='page-link' href='index.php?book_title=" . $book_title . "&page=$i' data-page='$i'>$i</a></li>";
                    }
                    ?>
                </ul>
            </div>



             <script>
            $(document).ready(function() {
                $('body').on('click', '.page-link', function() {
                    sessionStorage.setItem('scrollPosition', $(window).scrollTop());
                });

                var scrollPosition = sessionStorage.getItem('scrollPosition');
                if (scrollPosition !== null) {
                    $(window).scrollTop(scrollPosition);
                    sessionStorage.removeItem('scrollPosition');
                }
            });
            </script>
        <?php } else { ?>
          <section class="content">
            <div class="not-found m-5">
              <img src="../images/searchnotfound.gif" alt="" class="img-fluid d-block m-auto">
              <h3 class="mb-0 text-center  text-white">No record found</h3>
            </div>
            <div class="container">
              <form id="searchForm" action="" method="GET">
                <div class="row">
                  <div class="col-md-8 offset-md-2">
                    <div class="form-group">
                      <div class="input-group input-group-lg">
                        <input type="search" class="form-control form-control-lg" placeholder="Search book..." name="book_title" required>
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-lg btn-default">
                          <i class="fa fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
        <?php
        }
    } else {
        ?>
          <section class="content">
            <div class="not-found m-5">
              <img src="../images/searchnotfound.gif" alt="" class="img-fluid d-block m-auto">
              <h3 class="mb-0 text-center">Please enter book info to search</h3>
            </div>
            <div class="container">
              <form action="" method="POST">
                <div class="row">
                  <div class="col-md-8 offset-md-2">
                    <div class="form-group">
                      <div class="input-group input-group-lg">
                        <input type="search" class="form-control form-control-lg" placeholder="Search book..." name="book_title" required>
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-lg btn-default">
                          <i class="fa fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
        <?php
    }
} else { ?>

          <section class="content-header m-3">
            <div class="container">
              <h2 class="text-center">
              <img src="../images/logo.png" alt="" width="180" >
              </h2>
              <h2 class="text-center display-3" style="font-weight: bold;">
              <a href="">
                <span style="color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">L</span>
                <span style="color: #dc3545; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">I</span>
                <span style="color: #ffc107; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">B</span>
                <span style="color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">R</span>
                <span style="color: #28a745; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">A</span>
                <span style="color: #dc3545; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">R</span>
                <span style="color: #ffc107; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">Y</span>
              </a>
              </h2>
            </div>
          </section>
          <section class="content">
            <div class="container">
              <form id="searchForm" action="" method="GET">
                <div class="row">
                  <div class="col-md-8 offset-md-2">
                    <div class="form-group">
                      <div class="input-group input-group-lg">
                        <input type="search" class="form-control form-control-lg" placeholder="Search book..." name="book_title" required>
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-lg btn-default">
                          <i class="fa fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>

          <?php
            $recordsPerPage = 5;
            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                $currentPage = $_GET['page'];
            } else {
                $currentPage = 1;
            }

            $offset = ($currentPage - 1) * $recordsPerPage;

            $search2 = mysqli_query($conn, "
                SELECT books.*, COUNT(DISTINCT borrowed_books.book_ID) AS borrow_count
                FROM books
                LEFT JOIN borrowed_books ON books.book_ID = borrowed_books.book_ID
                GROUP BY books.book_ID
                ORDER BY borrow_count DESC
                LIMIT $offset, $recordsPerPage
            ");

            if ($search2 === false) {
              die("Query execution error: " . mysqli_error($conn));
            }
            
          if (mysqli_num_rows($search2) > 0) { ?>
            <section class="content-header mt-2">
              <div class="container">
                <h5><a href="#">Most used books</a></h5>
                <?php while ($row = mysqli_fetch_array($search2)) { ?>
                <div class="list-group-item">
                  <div class="row">
                    <div class="col px-0">
                      <div>
                        <div class="float-right text-muted"><?php echo $row['call_num']; ?></div>
                        <h6 class="text-primary"><a href="book-info.php?book_ID=<?php echo $row['book_ID']; ?>"><?php echo $row['title']; ?></a></h6>
                        <p class="mb-0"><?php echo $row['sub_title'] ?><br>
                          <span class="text-success">Available: </span><?php echo $row['qty_available']; ?>
                        </p>
                        <a type="button" class="float-right" data-toggle="modal" data-target="#borrow<?php echo $row['book_ID']; ?>" style="font-size: 13px;">Borrow book</a>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Borrow book (book-info.php) -->
                <div class="modal fade" id="borrow<?php echo $row['book_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-book"></i> Borrow book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                        </button>
                      </div>
                  
                      <div class="modal-body">
                        <form action="process_save.php" method="POST" enctype="multipart/form-data">
                          <input type="hidden" class="form-control form-control-sm" value="<?php echo $row['title']; ?>" name="book_title">
                          <input type="hidden" class="form-control form-control-sm" value="<?php echo $row['book_ID']; ?>" name="book_ID">
                          <input type="hidden" class="form-control form-control-sm" value="<?php echo $id; ?>" name="user_ID">
                          <input type="hidden" class="form-control form-control-sm" value="<?php echo $user_type; ?>" id="user_type">
                          <h5 class="card-title"><?php echo ucwords($row['title']); ?></h5>
                          <p class="card-text"><?php echo $row['sub_title']; ?></p>
                          <ul class="list-group list-group-flush">
                              <li class="list-group-item"><strong>Call Number:</strong> <?php echo $row['call_num']; ?></li>
                              <li class="list-group-item"><strong>Accession Number:</strong> <?php echo $row['accession_num']; ?></li>
                              <li class="list-group-item"><strong>Publisher:</strong> <?php echo ucwords($row['publisher']); ?></li>
                              <li class="list-group-item"><strong>Place Published:</strong> <?php echo ucwords($row['place_published']); ?></li>
                              <li class="list-group-item"><strong>Date Published:</strong> <?php echo date("F d, Y", strtotime($row['date_published'])); ?></li>
                              <li class="list-group-item"><strong>Edition:</strong> <?php echo $row['edition']; ?></li>
                              <li class="list-group-item"><strong>Volume:</strong> <?php echo $row['volume']; ?></li>
                              <li class="list-group-item"><strong>ISBN:</strong> <?php echo $row['isbn']; ?></li>
                              <li class="list-group-item"><strong>Quantity:</strong> <?php echo $row['qty']; ?></li>
                              <li class="list-group-item"><strong>Available Quantity:</strong> <?php echo $row['qty_available']; ?></li>
                              <li class="list-group-item"><strong>Copyright:</strong> <?php echo $row['copyright']; ?></li>
                              <li class="list-group-item"><strong>Created At:</strong> <?php echo date("F d, Y", strtotime($row['created_at'])); ?></li>
                          </ul>
                        <hr>
                     <div class="form-group">
                        <span class="text-dark"><b>Where To Use</b></span>
                        <select class="form-control" name="place_to_use" id="place_to_use_<?php echo $row['book_ID']; ?>" required>
                            <option selected disabled value="">Select place</option>
                            <option value="At home">At home</option>
                            <option value="In the library itself">In the library itself</option>
                            <option value="Overnight">Overnight</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <span class="text-dark"><b>Duration</b></span>
                        <select class="form-control" name="duration" id="duration_<?php echo $row['book_ID']; ?>" required>
                            <option selected disabled value="">Select place first</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="symbols">Location Symbols</label>
                        <select class="form-control" name="symbols" id="symbols_<?php echo $row['book_ID']; ?>" required>
                            <option value="CD/VCD/DVD/VHS/GLOBE/MAPS">CD/VCD/DVD/VHS/GLOBE/MAPS</option>
                            <option value="F">F</option>
                            <option value="FC">FC</option>
                            <option value="GC">GC</option>
                            <option value="GS">GS</option>
                            <option value="PR">PR</option>
                            <option value="PROF. ED.">PROF. ED.</option>
                            <option value="R">R</option>
                            <option value="RS">RS</option>
                            <option value="RT">RT</option>
                            <option value="SB">SB</option>
                            <option value="SHS">SHS</option>
                            <option value="SM">SM</option>
                            <option value="TB">TB</option>
                            <option value="TS">TS</option>
                        </select>
                    </div>
                      </div>
                      <div class="modal-footer alert-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
                        <button type="submit" class="btn bg-gradient-primary" name="borrow_book" id="borrow_book"><i class="fa-solid fa-floppy-disk"></i> Confirm</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <script>
                  $(document).ready(function () {
                      var placeOptions = {
                          'At home': {
                              Student: {
                                  duration: ['1 Week Maximum'],
                                  symbols: ['F', 'FC', 'GC', 'GS', 'PROF. ED.', 'SB', 'SHS', 'SM', 'TB', 'TS']
                              },
                              Teacher: {
                                  duration: ['3 Months Maximum'],
                                  symbols: ['F', 'FC', 'GC', 'GS', 'PROF. ED.', 'SB', 'SHS', 'SM', 'TB', 'TS']
                              }
                          },
                          'In the library itself': {
                              Student: {
                                  duration: ['Today @5PM'],
                                  symbols: ['CD/VCD/DVD/VHS/GLOBE/MAPS', 'R', 'RT', 'PR']
                              },
                              Teacher: {
                                  duration: ['Today @5PM'],
                                  symbols: ['CD/VCD/DVD/VHS/GLOBE/MAPS', 'R', 'RT', 'PR']
                              }
                          },
                          'Overnight': {
                              Student: {
                                  duration: ['Until tomorrow @ 8:00 AM'],
                                  symbols: ['RS']
                              },
                              Teacher: {
                                  duration: ['1 Month Maximum'],
                                  symbols: ['RS']
                              }
                          }
                      };

                      updateOptions();

                      $('#place_to_use_<?php echo $row['book_ID']; ?>').change(function () {
                          updateOptions();
                      });

                      function updateOptions() {
                          var selectedPlace = $('#place_to_use_<?php echo $row['book_ID']; ?>').val();
                          var userType = $('#user_type').val();
                          var durationSelect = $('#duration_<?php echo $row['book_ID']; ?>');
                          var symbolsSelect = $('#symbols_<?php echo $row['book_ID']; ?>');

                          durationSelect.empty();
                          symbolsSelect.empty();

                          durationSelect.append($('<option selected disabled value="">Select place first</option>'));
                          symbolsSelect.append($('<option value="" selected disabled>Select symbol</option>'));

                          if (placeOptions.hasOwnProperty(selectedPlace) && placeOptions[selectedPlace].hasOwnProperty(userType)) {
                              $.each(placeOptions[selectedPlace][userType].duration, function (index, value) {
                                  durationSelect.append($('<option>', {
                                      value: value,
                                      text: value
                                  }));
                              });

                              $.each(placeOptions[selectedPlace][userType].symbols, function (index, value) {
                                  symbolsSelect.append($('<option>', {
                                      value: value,
                                      text: value
                                  }));
                              });

                              durationSelect.val(placeOptions[selectedPlace][userType].duration[0]).prop('selected', true);
                          }
                      }
                  });
                </script>
                <?php } ?>
              </div>
            </section>

            <!-- Pagination controls -->
            <div class="container">
              <ul class="pagination justify-content-end">
                <?php
                $totalPagesQuery = mysqli_query($conn, "SELECT COUNT(DISTINCT book_ID) AS total FROM borrowed_books");

                $totalPagesRow = mysqli_fetch_assoc($totalPagesQuery);
                $totalPages = ceil($totalPagesRow['total'] / $recordsPerPage);
                for ($i = 1; $i <= $totalPages; $i++) {
                echo "<li class='page-item" . ($currentPage == $i ? ' active' : '') . "'><a class='page-link' href='index.php?page=$i' data-page='$i'>$i</a></li>";
                }
                ?>
              </ul>
            </div>

            <script>
            $(document).ready(function() {
                $('body').on('click', '.page-link', function() {
                    sessionStorage.setItem('scrollPosition', $(window).scrollTop());
                });

                var scrollPosition = sessionStorage.getItem('scrollPosition');
                if (scrollPosition !== null) {
                    $(window).scrollTop(scrollPosition);
                    sessionStorage.removeItem('scrollPosition');
                }
            });
            </script>
            
          <?php } else { ?>
          <section class="content">
            <div class="not-found m-5">
              <h3 class="mb-0 text-center  text-white">No book records yet</h3>
            </div>
          </section>
          <?php } ?>


<?php } ?>

<?php include 'footer.php'; ?>
