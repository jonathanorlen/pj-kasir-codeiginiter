                      <div id="list_komposisi">  
                        <div class="box-body">
                          <table id="tabel_daftar" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Nama bahan</th>
                                <th>QTY</th>
                                <th>Satuan</th>
                                <th>Hpp</th>
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

                                    $i = 0; $sum_hpp_per_bahan = 0;
                                    foreach ($hasil_opsi_menu as $item) {
                                    $i++;
                                    $hpp = @$item['hpp'];
                                    $juml = @$item['jumlah_bahan'] ;
                                    $sum_hpp_per_bahan += @$item['jumlah_bahan'] *$item['hpp'] ;
                                ?>    
                                <tr>
                                  <td><?php echo $i;?></td>
                                  <td><?php echo $item['nama_bahan'];?></td>
                                  <td><?php echo $item['jumlah_bahan'];?></td>
                                  <td><?php echo $item['satuan_dalam_stok'];?></td>
                                  <td><?php echo $item['hpp'];?></td>
                                  <td><?php echo $item['nama_unit'];?></td>
                                  <td><?php echo $item['nama_rak'];?></td>
                                  <td><?php echo get_edit_del($item['id_menu'],$item['kode_menu']); ?></td>
                                </tr>
                                

                                <?php } 
                                ?>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td><b>Total Hpp</td>
                                  <td><b><?php echo format_rupiah(@$sum_hpp_per_bahan) ;?></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                            </tbody>
                              <tfoot>
                               
                             </tfoot>
                          </table>
                        </div>
                      </div>