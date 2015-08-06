<?php
session_start();
require './class/db-connection.php';
connection();
include './class/data-truncate.php';
?>
<!DOCTYPE html>
<head>
  <?php
  include './themepart/headerscripts.php';
  $qry;
  $msg = "";
  if ($_GET) {
    $qry = $_GET['qry'];

    if ($qry == 'true') {
      $msg = "<div class='alert alert-success'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>
                                         Your Operation has been Completed Successfully..
                                    </div>";
    } else if ($qry == 'false') {
      $msg = "<div class='alert alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>
                                        <strong>Error!</strong> Your Operation has been Failed " . mysql_error() . "
                                    </div>";
    }
  }
  ?>

</head>
<body>
  <!-- START Template Wrapper -->
  <div id="wrapper" class="fixed-header fixed-sidebar">
    <!-- START Template Canvas -->
    <div id="canvas">
      <?php
      include './themepart/header.php';
      include './themepart/sidebar.php';
      ?>
      <!-- START Template Main Content -->
      <section id="main">
        <!-- START Content -->
        <div class="navbar navbar-static-top">
          <div class="navbar-inner">
            <!-- Breadcrumb -->
            <ul class="breadcrumb">
              <li><a href="comment-display.php">Comment</a> <span class="divider"></span></li>
              <li class="active">View Comments</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
        <div class="container-fluid">
          <!-- START Row -->
          <?php echo $msg; ?>
          <div class="row-fluid">
            <!-- START Datatable 1 -->

            <div class="span12 widget dark stacked">
              <header>
                <h4 class="title pull-left"></span>Comments</h4>
                
              </header>
              <section class="body">
                <div class="body-inner no-padding">
                  <table class="table table-bordered table-striped table-hover " id="datatable1" name="commenttable">
                    <thead>
                      <tr>  
                        <th width="5%">ID</th>
                        <th width="10%">Foodie</th>
                        <th width="20%">Review</th>
                        <th width="33%">Comment</th>
                        <th width="10%">Date</th>
                        <th width="7%">status</th>
                        <th width="20%">Action</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      /*   data base connectivity */

                      $query = "select cm.*,fd.foodie_id,fd.foodie_name,rv.review_text from comment cm,foodie_detail fd,review rv where cm.review_id=rv.review_id and cm.foodie_id=fd.foodie_id";
                      $result = mysql_query($query) or die(mysql_error());
                      while ($row = mysql_fetch_array($result)) {
                        $comment_id = $row['comment_id'];
                        $comment_date = $row['comment_date'];
                        $comment_text = truncate($row['comment_text'], 50, " ");
                        $review_text = truncate($row['review_text'], 100, " ");
                        $foodie_name = $row['foodie_name'];
                        $comment_status = $row['comment_status'];
                        if ($comment_status == 1) {

                          $status = "<span class='label label-success'>Moderated</span>";
                        } 
                        else if($comment_status==0)
                        {
                          $status = "<span class='label'>Pending</span>";
                        }
                        else {

                          $status = "<span class='label label-important'>Blocked</span>";
                        }


                        echo "<tr>"
                        . "<td>{$comment_id}"
                        . "<td>{$foodie_name}"
                        . "<td>{$review_text}"
                        . "<td>{$comment_text}"
                        . "<td>{$comment_date}"
                        . "<td><a href='comment-change-status.php?qry={$comment_id}'>{$status}</a>&nbsp;" 
                        . "<td><a href='comment-delete.php?qry={$comment_id}' class='btn1 btn1-red'><span class='icone-trash'></span> Delete</a>"
                        . "</tr>";
                      }
                      ?>
                    </tbody>
                    
                  </table>
                </div>
              </section>
            </div>
            <!--/ END Datatable 1 -->
          </div>
          <!--/ END Row -->

        </div>
        <!--/ END Content -->

      </section>
      <!--/ END Template Main Content -->

      <?php
      include './themepart/footer.php';
      ?>
    </div>
    <!--/ END Template Canvas -->
  </div>
  <!--/ END Template Wrapper -->

  <?php
  include './themepart/footerscripts.php';
  ?>  
</body>
</html>