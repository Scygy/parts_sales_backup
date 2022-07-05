<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/view_pobar.php'; ?>
 
  <section class="content">
      <div class="container-fluid">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">View Purchase Order</h1>
            <br>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View  Purchase Order</li>
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
                    <div class="col-5">
                      <label>Purchase Order Number:</label><input type="text" name="po_num"  id="po_num" class="form-control">
                    </div>
                    <div class="col-4">
                      <label>Customer:</label>
                       <select id="customer_code" class="form-control">
                            <option value="">Select Customer</option>
                          <?php
                            require '../../process/conn.php';
                            $get_description = "SELECT DISTINCT customer_code FROM pss_po_details";
                            $stmt = $conn->prepare($get_description);
                            $stmt->execute();
                            foreach($stmt->fetchALL() as $x){

                                echo '<option value="'.$x['customer_code'].'">'.$x['customer_code'].'</option>';
                            }

                     ?>
                        </select>
                    </div>
                   
                  </div>
                </h3> 
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 100px;">
                    <button class="btn btn-primary" id="searchReqBtn" onclick="load_po()">Search <i class="fas fa-search"></i></button> 
                  </div>
                </div>
              </div>
                <div class="row">
                    <div class="col-sm-6">
                      &nbsp;<button class="btn btn-success " onclick="export_unit('export_po')">Export</button>
                    </div>
                  </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 420px;">
                <table class="table table-head-fixed text-nowrap table-hover" id="view_po">
                <thead style="text-align:center;">
                    <th>#</th>
                    <th>Purchase Order</th>
                    <th>Parts Code</th>
                    <th>Parts Name</th>
                    <th>Description</th>
                    <th>Supplier Code</th>
                    <th>Customer Code</th>
                    <th>Stocks Needed</th>
                    
            </thead>
            <tbody id="view_po_data" style="text-align:center;"></tbody>
                </table>
                 <div class="row">
                  <div class="col-6">


                    
                  </div>
                  <div class="col-6">
                      <input type="hidden" name="" id="stocks">
   
                    <div class="spinner" id="spinner" style="display:none;">
                        
                        <div class="loader float-sm-center"></div>    
                    </div>
             
                  </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->

        
</div>
</div>
</section>

<?php include 'plugins/footer.php'; ?>
<?php include 'plugins/javascript/view_po_script.php'; ?>