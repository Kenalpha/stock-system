<?php
  include "action.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="icon" href="devices_images/favicon.jpg" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Alpha computers</title>
  </head>
  <body>
    <div class="container">
      <div class="jumbotron">
        <h1><span class="text-primary">Alpha Computers Stock </span><small>Alpha softwares inc</small></h1>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-info text-white">Enter device details</div>
            <div class="card-body">
              <?php
                if (isset($_GET["update"])) {
                  //from php 7
                  $id = $_GET["id"] ?? null;
                  $where = array("id"=>$id);
                  $row=$obj->select_record("computers",$where);
                  ?>

                    <form method="post" action="action.php" enctype="multipart/form-data">
                      <table class="table table-hover">
                        <tr>
                          <td><input type="hidden" name="id" value="<?php echo $id ?>"></td>
                        </tr>
                        <tr>
                          <td>Device name</td>
                          <td><input type="text" name="name" class="form-control" value="<?php echo $row['d_name'] ?>" placeholder="Enter device name"></td>
                        </tr>
                        <tr>
                          <td>Quantity</td>
                          <td><input type="text" name="qty" class="form-control" value="<?php echo $row['qty'] ?>" placeholder="Enter device quantity"></td>
                        </tr>
                        <tr>
                          <td>Image</td>
                          <td><input type="file" name="comp_image" class="form-control"></td>
                        </tr>
                        <tr>
                          <td colspan="2" align="center"><input type="submit" class="btn btn-primary" name="edit" value="Update"></td>
                        </tr>
                      </table>
                    </form>

                  <?php
                }else{
                  ?>
                      <form method="post" action="action.php" enctype="multipart/form-data">
                        <table class="table table-hover">
                          <tr>
                            <td>Device name</td>
                            <td><input type="text" name="name" class="form-control" placeholder="Enter device name"></td>
                          </tr>
                          <tr>
                            <td>Quantity</td>
                            <td><input type="text" name="qty" class="form-control" placeholder="Enter device quantity"></td>
                          </tr>
                          <tr>
                          <td>Image</td>
                          <td><input type="file" name="comp_image" class="form-control"></td>
                        </tr>
                          <tr>
                            <td colspan="2" align="center"><input type="submit" class="btn btn-primary" name="submit" value="Store"></td>
                          </tr>
                        </table>
                      </form>
                  <?php
                }
              ?>
            </div>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 table-responsive">
          <table class="table table-bordered">
            <tr>
              <th>#</th>
              <th>Device Name</th>
              <th>Available Stock</th>
              <th>Image</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
            <?php
              $myrow=$obj->fetch_record("computers");
              for ($i=0; $i<sizeof($myrow); $i++) {
                // breaking point
                ?>
                   <tr>
                      <td><?php echo $myrow[$i]['id'] ?></td>
                      <td><?php echo $myrow[$i]['d_name'] ?></td>
                      <td><b><?php echo $myrow[$i]['qty'] ?></b></td>
                      <td><img src="devices_images\comp.jpg" class="img-thumbnail" alt="device" width="304" height="236"></td>
                      <td><a href="index.php?update=1&id=<?php echo $myrow[$i]['id'] ?>" class="btn btn-primary">Edit</a></td>
                      <td><a href="index.php?delete=1&id=<?php echo $myrow[$i]['id'] ?>" class="btn btn-danger">Delete</a></td>
                   </tr>
                <?php
              }
            ?>
          </table>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
