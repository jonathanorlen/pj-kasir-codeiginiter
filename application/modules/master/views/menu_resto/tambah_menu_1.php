<!--<?php
//mengambil dari address bar segmen ke 4 dari base_url
$param = $this->uri->segment(4);
//jika terdapat segmen maka tampilkan view_user berdasar id sesuai value segmen
if (!empty($param)) {
 $get_menu = $this->db->get_where('master_menu' , array('kode_menu' => $param));
 $hasil_edit_menu = $get_menu->row();
}
?>-->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Menu </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin').'/dasboard' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>
<style type="text/css">
 .ombo{
  width: 600px;
 } 

</style>    
    <!-- Main content -->
    <section class="content">             
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app green" href="<?php echo base_url().'master/kategori_menu/tambah'; ?>">
              <i class="fa fa-plus"></i> Tambah Kategori Menu
            </a>
            
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app blue" href="<?php echo base_url().'master/kategori_menu/daftar_kategori_menu'; ?>">
              <i class="fa fa-list"></i> Daftar Kategori Menu
            </a>
            
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app green" href="<?php echo base_url().'master/menu_resto/tambah'; ?>">
              <i class="fa fa-plus"></i> Tambah Menu
            </a>
            
            <a style="padding:13px; margin-bottom:10px" class="btn btn-app blue" href="<?php echo base_url().'master/menu_resto/daftar_menu'; ?>">
              <i class="fa fa-list"></i> Daftar Menu
            </a>
                <div class="box box-info">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools"></div><!-- /. tools -->
                    </div>
                    
                        <div class="sukses" ></div>
                        
                    <form id="data_form" action="" method="post">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-6">

                              <div class="form-group">
                                <label>Kode Menu</label>
                                <input <?php if(!empty($param)){ echo "readonly='true'"; } ?> type="text" class="form-control" name="kode_menu" id="kode_menu" value="<?php echo @$hasil_edit_menu->kode_menu;?>"/>
                                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo @$hasil_edit_menu->id;?>" required/>
                              </div>

                              <div class="form-group">
                                <label>Status</label>
                                <select class="form-control select2" name="status_menu" id="status_menu" required>
                                  <option value="reguler" <?php if (@$hasil_edit_menu->status_menu == 'reguler'){echo'selected="true"';} ?> >Reguler</option>
                                  <option value="konsinyasi" <?php if (@$hasil_edit_menu->status_menu == 'konsinyasi'){echo'selected="true"';} ?> >Konsinyasi</option>
                                </select>
                                
                              </div>

                              <div class="form-group">
                                <label class="gedhi">Satuan</label>
                                <?php
                                  $satuan = $this->db->get_where('master_satuan',array('alias' => 'porsi'));
                                  $hasil_satuan = $satuan->result();
                                ?>
                                <select class="form-control select2" name="satuan_stok" id="satuan_stok" required>
                                  <?php foreach($hasil_satuan as $item){ ?>
                                  <option value="<?php echo $item->kode ?>" <?php if (@$hasil_edit_menu->kode_satuan_stok == $item->kode){echo'selected="true"';} ?> ><?php echo $item->nama ?></option>
                                  <?php } ?>
                                </select>
                              </div> 
                              
                              
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Nama Menu</label>
                                <input type="text" class="form-control" name="nama_menu" id="nama_menu" value="<?php echo @$hasil_edit_menu->nama_menu;?>"/>
                              </div>
                              
                              <div class="form-group">
                                <label>Kategori Menu</label>
                                <?php
                                  $kategori = $this->db->get('master_kategori_menu');
                                  $kategori = $kategori->result();
                                ?>
                                <select class="form-control select2" name="kode_kategori_menu" id="kode_kategori_menu">
                                   <option selected="true" value="">--Pilih Kategori--</option>
                                   <?php foreach($kategori as $daftar){ ?>
                                    <option value="<?php echo $daftar->kode_kategori_menu ?>" <?php if (@$hasil_edit_menu->kode_kategori_menu == $daftar->kode_kategori_menu){echo'selected="true"';} ?> ><?php echo $daftar->nama_kategori_menu ?></option>
                                    <?php } ?>
                                </select> 
                              </div>

                              <div class="form-group">
                                <label>Harga Jual</label>
                                <input type="text" class="form-control" name="harga_jual" id="harga_jual" value="<?php echo @$hasil_edit_menu->harga_jual;?>"/>
                              </div>
                              
                                                           

                            </div>
                          </div>
                        </div>
                      </form> 

                      <div class="box-body" id="untuk_konsinyasi">
                          <div class="row">

                            <div class="col-md-3">
                              <label class="gedhi">Unit</label>
                                <?php
                                  $unit_kons = $this->db->get('master_unit');
                                  $hasil_unit_kons = $unit_kons->result();
                                ?>
                                <select class="form-control" name="unit_konsinyasi" id="unit_konsinyasi" required>
                                  <option selected="true" value="">--Pilih Unit--</option>
                                  <?php foreach($hasil_unit_kons as $item){ ?>
                                  <option value="<?php echo $item->kode_unit ?>" <?php if (@$hasil_edit_menu->unit == $item->kode_unit){echo'selected="true"';} ?> ><?php echo $item->nama_unit ?></option>
                                  <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                              <label class="gedhi">Rak</label>
                                <?php
                                  if(!empty($param)){
                                      $kode_unit_kons = @$hasil_edit_menu->unit;
                                      $get_rak_kons = $this->db->get_where('master_rak',array('kode_unit'=>$kode_unit_kons));
                                      $hasil_get_rak_kons = $get_rak_kons->result();
                                  }
                                ?>
                              <select name="rak_konsinyasi" id="rak_konsinyasi" class="form-control">
                                <option selected="true" value="">--Pilih Rak--</option>
                                <?php if(!empty($param)){ 
                                    foreach($hasil_get_rak_kons as $daftar){    
                                ?>
                                <option <?php if(@$hasil_edit_menu->rak==$daftar->kode_rak){ echo "selected"; } ?> value="<?php echo $daftar->kode_rak; ?>"><?php echo $daftar->nama_rak; ?></option>
                                <?php } } ?>
                              </select>
                            </div>

                          </div>
                      </div>

                  <div id="komposisi">

                        <div class="box-body" >
                          <label><h3><b>Komposisi</b></h3></label>
                          <div class="row">
                          <form id="form_temp" action="" method="post">  
                            <div class="col-md-12">
                            <div class="col-md-2">
                                <label class="gedhi">Unit</label>
                                <?php
                                  $unit = $this->db->get('master_unit');
                                  $hasil_unit = $unit->result();
                                ?>
                                <select class="form-control" name="kode_unit" id="kode_unit" required>
                                  <option selected="true" value="">--Pilih Unit--</option>
                                  <?php foreach($hasil_unit as $item){ ?>
                                  <option value="<?php echo $item->kode_unit ?>" <?php if (@$hasil_edit_menu->kode_unit == $item->kode_unit){echo'selected="true"';} ?> ><?php echo $item->nama_unit ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="col-md-2">
                              <label class="gedhi">Rak</label>
                                <?php
                                  if(!empty($param)){
                                      $kode_unit = @$hasil_edit_menu->kode_unit;
                                      $get_rak = $this->db->get_where('master_rak',array('kode_unit'=>$kode_unit));
                                      $hasil_get_rak = $get_rak->result();
                                  }
                                ?>
                              <select name="kode_rak" id="kode_rak" class="form-control">
                                <option selected="true" value="">--Pilih Rak--</option>
                                <?php if(!empty($param)){ 
                                    foreach($hasil_get_rak as $daftar){    
                                ?>
                                <option <?php if(@$hasil_edit_menu->kode_rak==$daftar->kode_rak){ echo "selected"; } ?> value="<?php echo $daftar->kode_rak; ?>"><?php echo $daftar->nama_rak; ?></option>
                                <?php } } ?>
                              </select>
                            </div>
                              
                              <div class="col-md-2">
                                <label>Jenis Bahan</label>
                                <select name="jenis_bahan" id="jenis_bahan" class="form-control">
                                  <option value="" selected="true">--Pilih Jenis Bahan--</option>
                                  <option value="Bahan Baku">Bahan Baku</option>                     
                                  <option value="Bahan Jadi">Bahan Jadi</option> 
                                </select> 
                              </div>
                              
                              <div class="col-md-2">
                                <label>Nama Bahan</label>
                                <select class="form-control" name="kode_bahan" id="kode_bahan">

                                </select> 
                              </div>

                              <div class="col-md-1">
                                <label>QTY</label>
                                <input type="text" class="form-control" name="qty" id="qty"/>
                                <input <?php if(!empty($param)){ echo "readonly='true'"; } ?> type="hidden" class="form-control" name="kd_menu" id="kd_menu" value="<?php echo @$hasil_edit_menu->kode_menu;?>"/>
                                <input <?php if(!empty($param)){ echo "readonly='true'"; } ?> type="hidden" class="form-control" name="nm_menu" id="nm_menu" value="<?php echo @$hasil_edit_menu->nama_menu;?>"/>
                              </div>
                              <div class="col-md-2">
                                <label>Satuan</label>
                                <select name="satuan" id="satuan" class="form-control">
                                </select>
                              </div>
                              <div class="col-md-1" style="padding:25px;">
                                <button type="submit" class="btn btn-primary">Add</button>
                              </div>

                            </div>
                          </form>

                            <form id="form_edit_temp" action="" method="post">  
                            <div class="col-md-12">
                              <div class="col-md-2">
                                <label class="gedhi">Unit</label>
                                <?php
                                  $unit = $this->db->get('master_unit');
                                  $hasil_unit = $unit->result();
                                ?>
                                <select class="form-control" name="kode_unit_temp" id="kode_unit_temp" required>
                                  <option selected="true" value="">--Pilih Unit--</option>
                                  <?php foreach($hasil_unit as $item){ ?>
                                  <option value="<?php echo $item->kode_unit ?>" <?php if (@$hasil_edit_menu->kode_unit == $item->kode_unit){echo'selected="true"';} ?> ><?php echo $item->nama_unit ?></option>
                                  <?php } ?>
                                </select>
                              </div>

                              <div class="col-md-2">
                              <label class="gedhi">Rak</label>
                                <?php
                                  if(!empty($param)){
                                      $kode_unit = @$hasil_edit_menu->kode_unit;
                                      $get_rak = $this->db->get_where('master_rak',array('kode_unit'=>$kode_unit));
                                      $hasil_get_rak = $get_rak->result();
                                  }
                                ?>
                              <select name="kode_rak_temp" id="kode_rak_temp" class="form-control">
                                <option selected="true" value="">--Pilih Rak--</option>
                                <?php if(!empty($param)){ 
                                    foreach($hasil_get_rak as $daftar){    
                                ?>
                                <option <?php if(@$hasil_edit_menu->kode_rak==$daftar->kode_rak){ echo "selected"; } ?> value="<?php echo $daftar->kode_rak; ?>"><?php echo $daftar->nama_rak; ?></option>
                                <?php } } ?>
                              </select>
                            </div>

                              <div class="col-md-2">
                                <label>Jenis Bahan</label>
                                <select name="jenis_bahan_temp" id="jenis_bahan_temp" class="form-control">
                                  <option value="" selected="true">--Pilih Jenis Bahan--</option>
                                  <option value="Bahan Baku">Bahan Baku</option>                     
                                  <option value="Bahan Jadi">Bahan Jadi</option> 
                                </select> 
                              </div>
                              <div class="col-md-2">
                                <label>Nama Bahan</label>
                                <select class="form-control" name="kode_bahan_temp" id="kode_bahan_temp">

                                </select> 
                              </div>
                              <div class="col-md-1">
                                <label>QTY</label>
                                <input type="text" class="form-control" name="qty_temp" id="qty_temp"/>
                                <input type="hidden" class="form-control" name="id_menu_temp" id="id_menu_temp"/>
                                <input type="hidden" class="form-control" name="kode_menu_temp" id="kode_menu_temp" />
                              </div>
                              <div class="col-md-2">
                                <label>Satuan</label>
                                <select name="satuan_temp" id="satuan_temp" class="form-control">
                                </select>
                              </div>
                              <div class="col-md-1" style="padding:25px;">
                                <button type="submit" class="btn btn-primary">Update</button>
                              </div>
                            </div>
                            </form>
                          </div>
                        </div>
                    
                    <div id="list_komposisi">
                      <div class="box-body">
                        <table id="tabel_daftar" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Nama bahan</th>
                                <th>QTY</th>
                                <th>Satuan</th>
                                <th>Nama Unit</th>
                                <th>Nama Rak</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                  $param = $this->uri->segment(4);
                                  //echo $param;
                                  if (!empty($param)) {
                                    $get_opsi_menu = $this->db->get_where('opsi_menu_temp' , array('kode_menu' => $param));
                                    $hasil_opsi_menu = $get_opsi_menu->result_array();
                                  }else if (empty($param)){
                                    $get_opsi_menu = $this->db->get_where('opsi_menu_temp',array('kode_menu' => ''));
                                    $hasil_opsi_menu = $get_opsi_menu->result_array();
                                  }

                                    $i = 0;
                                    foreach ($hasil_opsi_menu as $item) {
                                    $i++;
                                ?>    
                                <tr>
                                  <td><?php echo $i;?></td>
                                  <td><?php echo $item['nama_bahan'];?></td>
                                  <td><?php echo $item['jumlah_bahan'];?></td>
                                  <td><?php echo $item['satuan_dalam_stok'];?></td>
                                  <td><?php echo $item['nama_unit'];?></td>
                                  <td><?php echo $item['nama_rak'];?></td>
                                  <td><?php echo get_edit_del($item['id_menu'],$item['kode_menu']); ?></td>
                                </tr>

                                <?php } ?>
                               
                            </tbody>
                              <tfoot>
                               <tr>
                                <th>No</th>
                                <th>Nama bahan</th>
                                <th>QTY</th>
                                <th>Satuan</th>
                                <th>Nama Unit</th>
                                <th>Nama Rak</th>
                                <th>Action</th>
                              </tr>
                             </tfoot>
                          </table>
                      </div>
                    </div>

                  </div>


                    <div class="box-footer">
                        <button onclick="addMenu()" class="btn btn-success pull-right">Simpan</button>
                    </div>
            </section><!-- /.Left col -->      
        </div><!-- /.row (main row) -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:grey">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" style="color:#fff;">Konfirmasi Hapus Data</h4>
            </div>
            <div class="modal-body">
                <span style="font-weight:bold; font-size:14pt">Apakah anda yakin akan menghapus data komposisi menu tersebut ?</span>
                <input id="id-delete" type="hidden">
                <input id="kode-delete" type="hidden">
            </div>
            <div class="modal-footer" style="background-color:#eee">
                <button class="btn green" data-dismiss="modal" aria-hidden="true">Tidak</button>
                <button onclick="delData()" class="btn red">Ya</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

function get_produk(){
    var url = "<?php echo base_url().'master/menu_resto/get_produk'; ?>";
    var jenis_bahan = $('#jenis_bahan').val();
    var kode_rak = $("#kode_rak").val();
    if(jenis_bahan){
        $.ajax({
            type: 'POST',
            url: url,
            data: {jenis_bahan:jenis_bahan,kode_rak:kode_rak},
             beforeSend:function(){
          $(".tunggu").show();  
        },
success: function(msg){
                if(msg){
                    $('#kode_bahan').html(msg);
                    //$('#kode_bahan').select2().trigger('change');
                }
            }
        });
    }
}

function get_produk_temp(){
    var url = "<?php echo base_url().'master/menu_resto/get_produk'; ?>";
    var jenis_bahan = $('#jenis_bahan_temp').val();
    var kode_rak = $("#kode_rak_temp").val();
    if(jenis_bahan){
        $.ajax({
            type: 'POST',
            url: url,
            data: {jenis_bahan:jenis_bahan,kode_rak:kode_rak},
             beforeSend:function(){
          $(".tunggu").show();  
        },
success: function(msg){
                if(msg){
                    $('#kode_bahan_temp').html(msg);
                    //$('#kode_bahan_temp').select2().trigger('change');
                }
            }
        });
    }
}

function actEdit(id_menu) {
  var id_opsi_menu = id_menu;
  var url = "<?php echo base_url().'master/menu_resto/get_komposisi'; ?>";
  $.ajax({
          type: 'POST',
          url: url,
          dataType: 'json',
          data: {id_opsi_menu:id_opsi_menu},
           beforeSend:function(){
          $(".tunggu").show();  
        },
success: function(msg){
            $('#form_temp').hide();
            $('#form_edit_temp').show();
            $('#id_menu_temp').val(msg.id_menu);
            $("#kode_unit_temp").val(msg.kode_unit);
            $('#kode_rak_temp').empty();
            $('#kode_rak_temp').html("<option value="+msg.kode_rak+" selected='true'>"+msg.nama_rak+"</option>");
            $('#jenis_bahan_temp').val(msg.jenis_bahan);
            $('#kode_menu_temp').val(msg.kode_menu);
            $('#qty_temp').val(msg.jumlah_bahan);
            $('#kode_bahan_temp').empty();
            $('#kode_bahan_temp').html("<option value="+msg.kode_bahan+" selected='true'>"+msg.nama_bahan+"</option>");
            $('#satuan_temp').empty();
            $('#satuan_temp').html("<option value="+msg.kode_satuan+" selected='true'>"+msg.satuan_dalam_stok+"</option>");
            $("#list_komposisi").load("<?php echo base_url() . 'master/menu_resto/list_komposisi/'; ?>"+msg.kode_menu);
          }
      });
}

function actDelete(id,kode) {
    $('#id-delete').val(id);
    $('#kode-delete').val(kode);
    $('#modal-confirm').modal('show');
}

function delData() {
    var id = $('#id-delete').val();
    var kode = $('#kode-delete').val();
    var url = '<?php echo base_url().'master/menu_resto/hapus/'; ?>'+kode;
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id:id
        },
        success: function(msg) {
            $('#modal-confirm').modal('hide');
            get_bahan();
            clear('menu_resto');
            $("#list_komposisi").load("<?php echo base_url() . 'master/menu_resto/list_komposisi/'; ?>"+kode);
        }
    });
    return false;
}

$(document).ready(function(){
  //  $("#tabel_daftar").dataTable();
  $(".tgl").datepicker();
  $(".select2").select2();
  $('#form_edit_temp').hide();
  get_produk();
  get_produk_temp();
  get_bahan();

  var status = $('#status_menu').val();
  if(status=='konsinyasi'){
      $('#komposisi').hide();
      $('#untuk_konsinyasi').show();
  }
  else{
      $('#komposisi').show();
      $('#untuk_konsinyasi').hide();
  }
  

  $('#status_menu').on('change',function(){
      var status_menu = $('#status_menu').val();
      if(status_menu=='konsinyasi'){
         $('#komposisi').hide();
         $('#untuk_konsinyasi').show();
      }
      else if(status_menu=='reguler'){
        $('#komposisi').show();
        $('#untuk_konsinyasi').hide();
      }
  });

  $('#kode_menu').on('change',function(){
      var kode_menu = $('#kode_menu').val();
      var url = "<?php echo base_url() . 'master/menu_resto/get_kode' ?>";
      $.ajax({
          type: 'POST',
          url: url,
          data: {kode_menu:kode_menu},
           beforeSend:function(){
          $(".tunggu").show();  
        },
success: function(msg){
              if(msg == 1){
                $(".sukses").html('<div class="alert alert-warning">Kode_Telah_dipakai</div>');
                  setTimeout(function(){
                    $('.sukses').html('');
                },1700);              
                $('#kode_menu').val('');
          
              }
              else{

              }
          }
      });
    });
 
  $('#kode_unit').on('change',function(){
      var kode_unit = $('#kode_unit').val();
      var url = "<?php echo base_url() . 'master/menu_resto/get_rak' ?>";
      $.ajax({
          type: 'POST',
          url: url,
          data: {kode_unit:kode_unit},
           beforeSend:function(){
          $(".tunggu").show();  
        },
success: function(msg){
            $('#kode_rak').html(msg);
            //$('#kode_rak').select2().trigger('change');
          }
      });
  });

  $('#unit_konsinyasi').on('change',function(){
      var unit_konsinyasi = $('#unit_konsinyasi').val();
      var url = "<?php echo base_url() . 'master/menu_resto/get_rak' ?>";
      $.ajax({
          type: 'POST',
          url: url,
          data: {kode_unit:unit_konsinyasi},
           beforeSend:function(){
          $(".tunggu").show();  
        },
success: function(msg){
            $('#rak_konsinyasi').html(msg);
            //$('#kode_rak').select2().trigger('change');
          }
      });
  });

  $('#kode_unit_temp').on('change',function(){
      var kode_unit = $('#kode_unit_temp').val();
      var url = "<?php echo base_url() . 'master/menu_resto/get_rak' ?>";
      $.ajax({
          type: 'POST',
          url: url,
          data: {kode_unit:kode_unit},
           beforeSend:function(){
          $(".tunggu").show();  
        },
success: function(msg){
            $('#kode_rak_temp').html(msg);
            //$('#kode_rak').select2().trigger('change');
          }
      });
  });

  $('#jenis_bahan').on('change',function(){
    var jenis_bahan = $('#jenis_bahan').val();
    if (jenis_bahan =='Bahan Baku') {
        get_produk();
    }else if(jenis_bahan =='Bahan Jadi') {
        get_produk();
    }
  });

  $('#jenis_bahan_temp').on('change',function(){
    var jenis_bahan_temp = $('#jenis_bahan_temp').val();
    if (jenis_bahan_temp =='Bahan Baku') {
        get_produk_temp();
    }else if(jenis_bahan_temp =='Bahan Jadi') {
        get_produk_temp();
    }
  });

  $('#kode_bahan').on('change',function(){
      var kode_bahan = $('#kode_bahan').val();
      var url = "<?php echo base_url() . 'master/menu_resto/get_satuan' ?>";
      $.ajax({
          type: 'POST',
          url: url,
          data: {kode_bahan:kode_bahan},
           beforeSend:function(){
          $(".tunggu").show();  
        },
success: function(msg){
            $('#satuan').html(msg);
            //$('#satuan').select2().trigger('change');
          }
      });
  });

  $('#kode_bahan_temp').on('change',function(){
      var kode_bahan = $('#kode_bahan_temp').val();
      var url = "<?php echo base_url() . 'master/menu_resto/get_satuan' ?>";
      $.ajax({
          type: 'POST',
          url: url,
          data: {kode_bahan:kode_bahan},
           beforeSend:function(){
          $(".tunggu").show();  
        },
success: function(msg){
            $('#satuan_temp').html(msg);
            //$('#satuan_temp').select2().trigger('change');
          }
      });
  });

  $("#form_temp").submit( function() { 
      var kd_menu = $('#kd_menu').val();
      $.ajax( {  
        type :"post", 
        url : "<?php  echo base_url() . 'master/menu_resto/simpan_komposisi_temp'; ?>",
        cache :false,  
        data :$(this).serialize(),
         beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {  
          //$("#list_komposisi").load("<?php echo base_url() . 'master/menu_resto/list_komposisi'; ?>");              
          $("#list_komposisi").load("<?php echo base_url() . 'master/menu_resto/list_komposisi/'; ?>"+kd_menu);
          clear('menu_resto');
        },  
        error : function() {  
          alert("Data gagal dimasukkan.");  
        }  
      });
      return false;                          
    });

  $("#form_edit_temp").submit( function() { 
      var kode_menu_temp = $('#kode_menu_temp').val();
      $.ajax( {  
        type :"post",
        url : "<?php echo base_url() . 'master/menu_resto/simpan_edit_komposisi_temp'; ?>",
        cache :false,  
        data :$(this).serialize(),
         beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) {  

          get_bahan();
          clear('menu_resto');
          $('#form_edit_temp').hide();
          $("#form_temp").show();
          $("#list_komposisi").load("<?php echo base_url() . 'master/menu_resto/list_komposisi/'; ?>"+kode_menu_temp);
        },  
        error : function() {  
          alert("Data gagal dimasukkan.");  
        }  
      });
      return false;                          
    });


});


function clear(Object){
    if(Object=='menu_resto'){
        $('#jenis_bahan').val('');
        //$('#jenis_bahan').select2().trigger('change');
        $('#kode_bahan').val('');
        //$('#kode_bahan').select2().trigger('change');
        $('#qty').val('');
        $('#satuan').val('');
        //$('#satuan').select2().trigger('change');

        $('#kode_bahan_temp').val('');
        $('#qty_temp').val('');
        $('#kode_bahan_temp').val('');
        $('#satuan_temp').val('');
    }
}

function addMenu(){
    var id = $('#id').val();
    var kode_menu = $('#kode_menu').val();
    var nama_menu = $('#nama_menu').val();
    var kode_kategori_menu = $('#kode_kategori_menu').val();
    var harga_jual = $('#harga_jual').val();
    var kode_unit = $('#kode_unit').val();
    var kode_rak = $('#kode_rak').val();
    var unit_konsinyasi = $('#unit_konsinyasi').val();
    var rak_konsinyasi = $('#rak_konsinyasi').val();
    var satuan_stok = $('#satuan_stok').val();
    var status_menu = $('#status_menu').val();

    //var url = "<?php echo base_url() . 'master/bahan_jadi/simpan_tambah_bahan_jadi' ?>";
    var form_data = {
        id:id,
        kode_menu: kode_menu,
        nama_menu: nama_menu,
        kode_kategori_menu: kode_kategori_menu,
        harga_jual: harga_jual,
        kode_unit: kode_unit,
        kode_rak: kode_rak,
        unit_konsinyasi:unit_konsinyasi,
        rak_konsinyasi:rak_konsinyasi,
        status_menu:status_menu,
        satuan_stok: satuan_stok
    };
    $.ajax({
        type: "POST",
        <?php
          $param = $this->uri->segment(4); 
          if (empty($param)) {
        ?>
        //jika tidak terdapat segmen maka simpan di url berikut
          url : "<?php echo base_url() . 'master/menu_resto/simpan_tambah_menu'; ?>",
        <?php }
          else { ?>
        //jika terdapat segmen maka simpan di url berikut
          url : "<?php echo base_url() . 'master/menu_resto/simpan_edit_menu'; ?>",
        <?php }
        ?> 
        //url: url,
        data: form_data,
         beforeSend:function(){
          $(".tunggu").show();  
        },
 success : function(data) { 
          $(".sukses").html(data);   
          setTimeout(function(){$('.sukses').html('');window.location = "<?php echo base_url() . 'master/menu_resto/daftar_menu' ?>";},1500);              
        },  
        error : function() {  
          alert("Data gagal dimasukkan.");  
        }
    });
}

function get_bahan(){
    var url = "<?php echo base_url().'master/menu_resto/get_bahan'; ?>"
    $.ajax({
            type: "POST",
            url: url,
            data: "id",
            cache: false,
             beforeSend:function(){
          $(".tunggu").show();  
        },
success: function(msg){
                $("#kode_bahan").html(msg);
                
            }
        });
}
</script>