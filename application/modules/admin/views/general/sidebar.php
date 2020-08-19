<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <!-- <div  class="page-sidebar-wrapper">
  <?php
    $user = $this->session->userdata("astrosession");
    $jabatan = $user->jabatan;
  ?>
    <div  class="page-sidebar navbar-collapse collapse">
      <ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <?php if($jabatan=="002"){ ?>
        <li class="start active ">
          <a href="<?php echo base_url() . 'admin/' ?>">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
            <span class="selected"></span>

          </a>
        </li>
         <li class="tooltips" data-container="body" data-placement="right" data-html="true">
          <a href="<?php echo base_url() . 'master' ?>">
            <i class="icon-rocket"></i>
            <span class="title">Master</span>


          </a>
        </li>
        

        <li class="tooltips" data-container="body" data-placement="right" data-html="true">
          <a href="<?php echo base_url() . 'kasir' ?>">
            <i class="icon-rocket"></i>
            <span class="title">Kasir</span>


          </a>
        </li>

        <li class="tooltips" data-container="body" data-placement="right" data-html="true">
          <a href="<?php echo base_url() . 'kasir/dft_transaksi_kasir' ?>">
            <i class="icon-rocket"></i>
            <span class="title">Transaksi Kasir</span>


          </a>
        </li>
        <?php } ?>
      </ul>

    </div>
  </div> -->