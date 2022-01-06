<?php

require_once "../../config/_dbCon.php";
$sql = 'SELECT * FROM foxic_userType';
if ($statement = $pdo->prepare($sql)) {
  if ($statement->execute()) {
    $userTypes = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
}

?>
<?php include_once "../partials/header.php" ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">DashBord</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../../public/index.php">Home</a></li>
            <li class="breadcrumb-item active">State</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">UserType <a href="./add.php" class="btn btn-info btn-xs">Add</a></h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($userTypes as $i => $userType) : ?>
                    <tr>
                      <td><?php echo $i + 1 ?></td>
                      <td><?php echo $userType['userType_title'] ?></td>
                      <td><?php echo $userType['create_at'] ?></td>
                      <td>
                        <a href="./update.php?id=<?php echo $userType['userType_id'] ?>" class="btn btn-info btn-xs">Update</a>
                        <form action="delete.php" method="POST" style="display: inline-block;">
                          <input type="hidden" name="id" value="<?php echo $userType['userType_id'] ?>">
                          <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once "../partials/footer.php" ?>