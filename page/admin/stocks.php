
<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/stocksbar.php';?>
  <!-- Main Sidebar Container -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Stocks
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Stocks</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                   <div class="row">
        <!--   <div class="col-lg-4 col-6"> -->
            <!-- small box -->
            <!-- <div class="small-box bg-info">
              <div class="inner">
                <a href="" style="color:white;" data-toggle="modal" data-target="#exampleModal">
                <h5>Add <br> Stocks</h5>
                <p></p>
               
              </div>
              <div class="icon">
                <i class="fas fa-plus-circle"></i>
              </div>
               </a>
              <a href="#" class="small-box-footer" data-toggle="modal" data-target="#exampleModal">Proceed <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
 
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                 <a href="" style="color:white;" data-toggle="modal" data-target="#import_stocks">
                <h5>Import <br> Stocks</h5>
                <p></p>
              </div>
              <div class="icon">
                <i class="fas fa-upload"></i>
              </div>
              </a>
              <a href="#" class="small-box-footer" data-toggle="modal" data-target="#import_stocks">Proceed <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <a href="../../template/stocks.csv" style="color:white;">
                <h5>Download Template <br> Stocks</h5>
                <p></p>
              </div>
              <div class="icon">
                <i class="fas fa-download"></i>
              </div>
              </a>
              <a href="../../template/stocks.csv" class="small-box-footer">Proceed <i class="fas fa-arrow-circle-right"></i></a>
              
            </div>
          </div>
        </div>
      
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
               
                </div>
              </form>
            </div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>



<?php include 'plugins/footer.php';?>
<?php include 'plugins/javascript/dashboard_script.php'; ?>