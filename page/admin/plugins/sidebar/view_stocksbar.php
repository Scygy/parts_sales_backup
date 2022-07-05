  <aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../../dist/img/pss.png" alt="ETRS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?=$name;?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user.png" class="img-circle elevation-2" alt="User Image">

        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$name;?></a>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="stocks.php" class="nav-link ">
              <i class="fas fa-boxes"></i>
              <p>
                Stocks
               
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="view_stocks.php" class="nav-link active">
                <i class="fas fa-file-alt"></i>
              <p>
               View Stocks
               
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="update_stocks.php" class="nav-link">
               <i class="fas fa-dollar-sign"></i>
              <p>
                Update Unit Price
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="view_stocks_unit.php" class="nav-link">
                <i class="fas fa-file-alt"></i>
              <p>
               View Unit Price
               
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="po.php" class="nav-link">
                <i class="fas fa-download"></i>
              <p>
               
               Import Purchase Order
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="view_po.php" class="nav-link">
                <i class="fas fa-file-alt"></i>
              <p>
               
               View Purchase Order
               
              </p>
            </a>
          </li>
         
               <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="fas fa-edit"></i>
              <p>
                Prepare Packing List
               
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="packing_view.php" class="nav-link">
              <i class="fas fa-search"></i>
              <p>
                View Packing List Attachment
               
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="packinglist_file.php" class="nav-link">
              <i class="fas fa-file-invoice"></i>
              <p>
               Packing List
               
              </p>
            </a>
          </li>
          
           
          </li>  
         <?php include 'logout.php' ;?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
