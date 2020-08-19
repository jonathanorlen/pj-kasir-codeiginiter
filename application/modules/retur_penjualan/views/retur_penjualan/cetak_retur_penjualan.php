<!DOCTYPE html>
<html>
<?php
$penjualan = $this->db->get_where('transaksi_penjualan',array('kode_penjualan'=>$kode));
$list_penjualan = $penjualan->row();
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>RETUR
	</title>
	<link rel="stylesheet" href="">
</head>
<style type="text/css">
	body{


	}
	.table1{
		border-collapse: collapse;
		width:100%;
		position: absolute;
		top: 0px;
		text-align: left;
		vertical-align: middle;
	}
	.right{
		text-align: right;
		margin-right: 5px;
	}
	.left{
		text-align: left;
	}
	.table2{
		width:100%; 
		text-align:center;
		border-collapse: collapse;
	}
	.table2 tr th{
		border: 0.5px solid #222;
	}
	.table2 tr td{
		border: 0.5px solid #222;
	}
	@media print {
		html, body {


			display: block;
			font-family: "Dotrice";
			font-size: auto;
		}

		@page
		{
			size: 21cm 14cm;
		}

	}
	div.page { page-break-after: always;
		position: relative;
		margin:10px 15px 0px 15px;
		padding:0px; }
	</style>
	<body onload="window.print();">
		<?php  
		$produk1 = $this->db->query("SELECT Count(kode_penjualan) AS jumlah FROM opsi_transaksi_penjualan WHERE kode_penjualan='$kode'");
		$list_produk1 = $produk1->row();

		$jumlah_page = 1;
		for($batas=7;$list_produk1->jumlah>$batas;$batas=$batas+7){
			$jumlah_page = $jumlah_page + 1;
		}
		
		$penjualan = $this->db->get_where('transaksi_penjualan',array('kode_penjualan'=>$kode));
		$list_penjualan = $penjualan->row();

		//$member = $this->db->get_where('master_member',array('kode_member'=>$list_penjualan->kode_member));
		//$list_member = $member->row();

		if(!empty($list_penjualan->kode_member)){
			$customer = $this->db->get_where('master_member',array('kode_member'=>$list_penjualan->kode_member));
		}else{
			$customer = $this->db->get_where('master_reseller',array('kode_reseller'=>$list_penjualan->kode_reseller));
			}
		$list_customer = $customer->row();

		//$urut_faktur = $this->db->get_where('tabel_kode_faktur',array('urut'=>$urut_faktur));
		//$list_urut_faktur = $urut_faktur->row();

		
		$no = 0;
		$nomor = 1;
		for($page=1;$page<=$jumlah_page;$page++){
			
			$start = $no * 7;
			$end = $page * 7;
			$no++;
			if($kode){
				$produk = $this->db->query("SELECT * FROM opsi_transaksi_penjualan WHERE kode_penjualan='$kode' LIMIT 7 OFFSET $start");
				$list_produk = $produk->result();

			}
			?>

			<div class="page">
				<table style="float:right; text-align:right;">
					<tr>
						<?php
						if($kode){
							// $penjualan = $this->db->get_where('transaksi_penjualan',array('kode_penjualan'=>$kode));
							// $list_penjualan = $penjualan->row();
						}
						?>
						<td>
							<font size="4"><u><b>RETUR
							</b></u></font>
							<?php
							if($kode){
								$kode_retur = $this->db->get_where('opsi_transaksi_retur_penjualan',array('kode_penjualan'=>$kode));
								$list_kode_retur = $kode_retur->row();
							}
							?>
							<br><?php echo $list_kode_retur->kode_retur; ?>
						</td>
					</tr>
				</table>
				<br><br>
				<table class="table1">
					<tr>
						<td rowspan="6" width="10%">
							<img style="width: 65px; height: 55;" src="<?php echo base_url() . 'component/upload/foto/uploads/logo-print.png' ?>" /><br>
						</td>
					</tr>		
					<tr>
						<td width="9%">Faktur date</td>
						<td width="1%">:</td>
						<td width="40%"><?php echo tanggalIndo($list_penjualan->tanggal_penjualan); ?></td>
						<td width="9%"><b>Kepada Yth</b></td>
						<td width="1%"></td>
						<td width="40%"></td>
					</tr>
					<tr>
						<td>Nomor SI</td>
						<td>:</td>
						<td>-</td>
						<td>Customer Code</td>
						<td>:</td>
						<td><?php echo @$list_penjualan->kode_member; echo @$list_penjualan->kode_reseller; ?></td>
					</tr>
					<tr>
						<?php
						 $member = $this->db->get_where('master_member',array('kode_member'=>@$list_penjualan->kode_member));
						 $list_member = $member->row();
                         
                         $reseller = $this->db->get_where('master_reseller',array('kode_reseller'=>@$list_penjualan->kode_reseller));
                         $hasil_reseller = $reseller->row();
						?>
						<td>Payment Term</td>
						<td>:</td>
						<td>
							<?php if (@$list_penjualan->proses_pembayaran == 'kredit') {
								echo @$list_member->kategori_kredit; echo @$hasil_reseller->kategori_kredit;
							} else {
								echo "Cash";			
							}
							?>
						</td>
						<td>Customer Name</td>
						<td>:</td>
						<td><?php echo @$list_penjualan->nama_member; echo @$list_penjualan->nama_reseller; ?></td>
					</tr>
					<tr>
						<td>Due Date</td>
						<td>:</td>
						<td><?php if (@$list_penjualan->proses_pembayaran == 'kredit') {
							echo "";
						} else {
							echo tanggalIndo($list_penjualan->tanggal_penjualan);			
						}
						?></td>
						<td>Address</td>
						<td>:</td>
						<td><?php echo @$list_customer->alamat_member;  echo @$list_customer->alamat_reseller; ?></td>
					</tr>
					<tr>
						<td colspan="3"></td>
						<td>No Phone</td>
						<td>:</td>
						<td><?php echo @$list_customer->telp_member;echo  @$list_customer->telp_reseller;  ?></td>
					</tr>			
					<tr>
						<td colspan="7">
							<table class="table2">
								<!--<thead>-->
									<tr>
										<th rowspan="2">NO</th>
										<th rowspan="2">CODE</th>
										<th rowspan="2">PRODUCT NAME</th>
										<th colspan="3">QUANTITY</th>
										<th rowspan="2">PRICE</th>
										<th rowspan="2">SUM</th>
									</tr>
									<tr>
										<th>PACK</th>
										<th>KG/PC</th>
										<th>OVERAGE</th>
									</tr>
								<!--</thead>-->

								<tbody>
									<?php
									if($kode){
										// $produk = $this->db->get_where('opsi_transaksi_penjualan',array('kode_penjualan'=>$kode));
										// $list_produk = $produk->result();
										// $nomor = 1;  

										$total_produk = 0; $total_konversi = 0; $harga_satuan = 0; $subtotal = 0;
										foreach($list_produk as $daftar){ 
											?>
											<tr>
												<td><?php echo $nomor; ?></td>
												<td><?php echo $daftar->kode_produk; ?></td>
												<td class="left">&nbsp;&nbsp;<?php echo $daftar->nama_produk; ?></td>
												<td align="center"><?php echo $daftar->jumlah; ?></td>
												<td align="center"><?php echo $daftar->jumlah_konversi; ?></td>
												<td align="center"><?php echo @round(@$daftar->jumlah_konversi/@$daftar->jumlah,2); ?></td>
												<td align="right"><?php echo format_rupiah($daftar->harga_satuan); ?>&nbsp;&nbsp;</td>
												<td align="right"><?php echo format_rupiah($daftar->subtotal); ?>&nbsp;&nbsp;</td>
											</tr>
											<?php 
											$nomor++;
										} 
									}
									?>
								</tbody>
								
								<tfoot>
									<?php
									if($page==$jumlah_page){
										$sub = $this->db->query("SELECT SUM(jumlah) as produk, SUM(jumlah_konversi) as konversi, SUM(harga_satuan) as harga_satuan, SUM(subtotal) as subtotal FROM opsi_transaksi_penjualan WHERE kode_penjualan='$kode'");
										$list_sub = $sub->row();
										?>
										<tr>
											<td colspan="3"  style="text-align: right;"><b>TOTAL</b></td>
											<td><?php echo $list_sub->produk; ?></td>
											<td><?php echo $list_sub->konversi; ?></td>
											<td><?php echo @round($list_sub->konversi/$list_sub->produk, 2); ?></td>
											<td class="right" class="right"><?php echo format_rupiah($list_sub->harga_satuan); ?>&nbsp;&nbsp;</td>
											<td class="right"><?php echo format_rupiah($list_sub->subtotal); ?>&nbsp;&nbsp;</td>
										</tr>
										<?php
										$penjualan = $this->db->get_where('transaksi_penjualan',array('kode_penjualan'=>$kode));
										$list_penjualan = $penjualan->row();
										?>

										<tr style="vertical-align: top;">
											<td colspan="4" rowspan="3" style="text-align: left; border:0px;"><b><i>&nbsp;&nbsp;Terbilang : == <?php echo Terbilang($list_penjualan->total_nominal - $list_penjualan->diskon_rupiah + $list_penjualan->biaya_pengiriman); ?> Rupiah ==</i></b></td>
											<td colspan="3" style="text-align: right; border:0px;">Diskon</td>

											<td class="right"><?php echo format_rupiah($list_penjualan->diskon_rupiah); ?>&nbsp;&nbsp;</td>
										</tr>
										<tr>
											<td colspan="3" style="text-align: right; border:0px;">PPN 10%</td>
											<td class="right"></td>
										</tr>
										<tr>
											<?php
										// $penjualan = $this->db->get_where('transaksi_penjualan',array('kode_penjualan'=>$kode));
										// $list_penjualan = $penjualan->row();
											?>
											<td colspan="3" style="text-align: right; border:0px;"><b>GRAND TOTAL</b></td>
											<td class="right"><?php echo format_rupiah($list_penjualan->total_nominal - $list_penjualan->diskon_rupiah + $list_penjualan->biaya_pengiriman); ?></td>
										</tr>
										<?php
									}
									?>
									<tr style="vertical-align: top;">
										<td colspan="8" style="text-align: left; border:0px;">&nbsp;&nbsp;Transfer Bank : <b>Bank BCA Cab Blitar</b></td>
									</tr>
									<tr style="vertical-align: top;">
										<td colspan="8" style="text-align: left; border:0px;">&nbsp;&nbsp;Acc/ No Rek : <b style="font-size: 20px">09 008 12221 &nbsp; &nbsp;&nbsp; an. Achmad Luluk F.</b></td>
									</tr>
								</tfoot>

							</table>
						</td>
					</tr>
					<tr>
						<td colspan="8">
							<table style="width:100%;">
								<tr style="text-align: center; vertical-align: top; width:10%;">
									<td style="border: 2px solid #222;">Finance/Accounting<br><br><br></td>
									<td style="border: 2px solid #222;">Penerima/ Customer<br><br></td>
									<td style="text-align: right; width:10%; ">Note:</td>
									<td>:</td>
									<td style="text-align: left; width:35%"><i>Mohon dicek kembali sebelumditandatagani faktur ini. Kami tidak menerima Faktur setelah barang benar-benar diterima dan ditanda tangani</i></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<?php
		}?>
	</body>
	</html>