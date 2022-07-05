<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/packinglist_file_bar.php';?>

 <section class="content">
      <div class="container-fluid">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Packing List</h1>
            <br>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Packing List</li>
            </ol>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <div class="row">
            
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
       <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title col-6">
                  <div class="row">
                
                <div class="col-4">
               <label>Invoice No.:</label> <label type="text" name="" id="po_num_assign" class="form-control" disabled><?=$invoice_count;?> </label>
                </div>

                <div class="col-4">
                  <label>Date of Issue:</label><label type="text" name="" id="" class="form-control" disabled><?=$server_date_only;?></label>
                </div>

                 <div class="col-4">
               <label>Shipping Marks:</label><input type="text" name="">
                </div>
                
                <div class="col-12">
                  <label>Payment Terms:</label>
                  <label>T/T REMITTANCE WITHIN 90 DAYS AFTER IMPORT PERMITE DUE</label>
                </div>

                <div class="col-8">
                  <label>MESSRS:</label>
                  <label>FURUKAWA AUTOMOTIVE SYSTEMS INC</label>
                  <p>475-2 Fukuoka-cho, Kuwana-shi<br>
                  MIE</p>
                </div>




                  </div>
                </h3> 
              </div>
                
              <!-- /.card-header -->
              
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</div>
</div>
</section>


















<?php include 'plugins/footer.php';?>

