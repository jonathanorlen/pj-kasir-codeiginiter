<?php 
/*
 * function that generate the action buttons edit, delete
 * This is just showing the idea you can use it in different view or whatever fits your needs
 */
function get_retur($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a data-toggle="tooltip" id="'.$id.'" title="Retur" class="btn adetail btn-small btn-info"><i class="fa fa-check"></i>Retur Penjualan</a>
    </div>
    ';
    
    return $html;
}

function batal_retur($id){
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a data-toggle="tooltip" id="'.$id.'" title="Batal" class="btn batal btn-small btn-warning"><i class="fa fa-refresh"></i> Batal</a>
    </div>
    ';
    
    return $html;
}
function cek_jenis_transaksi($id)
{
    if($id=='cod')
        return '<span class="label label-danger">COD</span>';
    else if($id=='kredit')
        return '<span class="label label-warning">KREDIT</span>';
    else if($id=="tunai")
        return '<span class="label label-success">TUNAI</span>';
}
function get_detail_validasi($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="validasi/'.$id.'" data-toggle="tooltip" title="Validasi" class="btn btn-xs green"><i class="fa fa-check-square-o"></i> Validasi</a>
    </div>
    ';
    
    return $html;
}
function get_detail_penjualan($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail_laporan/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i></a>
    </div>
    ';
    
    return $html;
}
function get_url_detail_edit_delete($url,$id){
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail_'.$url.'/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
        <a href="'.$url.'/'.$id.'" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
        <a style="padding:3.5px;" onclick="actDelete('.$id.')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}

function get_detail_edit_delete($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail/'.$id.'" id="detail" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i></a>
    <a href="tambah/'.$id.'" key="'.$id.'" id="ubah" data-toggle="tooltip" title="Edit" class="btn btn-icon-only btn-circle yellow"><i class="fa fa-pencil"></i></a>
    <a onclick="actDelete(\''.$id.'\')" data-toggle="tooltip" title="Delete" class="btn btn-icon-only btn-circle red"><i class="fa fa-remove"></i></a>
    </div>
    ';
    
    return $html;



   /* $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
        <a href="tambah/'.$id.'" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
        <a style="padding:3.5px;" onclick="actDelete('.$id.')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;*/
}

function get_del_id($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a style="padding:3.5px;" onclick="actDelete('.$id.')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}

function get_detail_edit_delete_master_keu($uri, $id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail_'.$uri.'/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
        <a href="tambah_'.$uri.'/'.$id.'" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
        <a style="padding:3.5px;" onclick="actDelete('.$id.')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}

function get_detail_edit_delete_keu($uri, $id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail_'.$uri.'/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
    </div>
    ';
    
    return $html;
}

function get_detail_edit_delete_string($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail/'.$id.'" id="detail" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i></a>
    <a href="tambah/'.$id.'" key="'.$id.'" id="ubah" data-toggle="tooltip" title="Edit" class="btn btn-icon-only btn-circle yellow"><i class="fa fa-pencil"></i></a>
    <a onclick="actDelete(\''.$id.'\')" data-toggle="tooltip" title="Delete" class="btn btn-icon-only btn-circle red"><i class="fa fa-remove"></i></a>
    </div>
    ';
    
    return $html;


  /*  $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
        <a href="tambah/'.$id.'" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
        <a  onclick="actDelete(\''.$id.'\')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;*/
}

function get_detail_edit_delete_reservasi($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a onclick="buka_reservasi()" kode="<?php echo $daftar->kode_reservasi; ?>" href="#" data-toggle="tooltip" title="Buka Meja" class="btn btn-icon-only btn-circle purple buka"><i class="fa fa-folder-open"></i></a>
    <a href="detail_reservasi/'.$id.'" id="detail" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i></a>
    <a href="reservasi/'.$id.'" key="'.$id.'" id="ubah" data-toggle="tooltip" title="Edit" class="btn btn-icon-only btn-circle yellow"><i class="fa fa-pencil"></i></a>
    <a onclick="actDelete(\''.$id.'\')" data-toggle="tooltip" title="Cancel" class="btn btn-icon-only btn-circle red"><i class="fa fa-remove"></i></a>
    </div>
    ';
    
    return $html;
    
    /*$ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail_reservasi/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
        <a href="reservasi/'.$id.'/edit" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
        <a style="padding:3.5px;" onclick="actDelete(\''.$id.'\')" data-toggle="tooltip" title="Cancel" class="btn btn-xs red"><i class="fa fa-trash"> cancel</i></a>
    </div>
    ';
    
    return $html;*/
}

function get_detail_edit_delete_string_bj($kode_unit,$kode_rak,$id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail/'.$kode_unit.'/'.$kode_rak.'/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
        <a href="tambah/'.$kode_unit.'/'.$kode_rak.'/'.$id.'" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
        <a style="padding:3.5px;" onclick="actDelete(\''.$id."|".$kode_unit."|".$kode_rak.'\')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}

function get_detail_edit($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
        <a href="tambah/'.$id.'" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
    </div>
    ';
    
    return $html;
}

function cek_status($id)
{
    if($id=='1')
        return '<span class="label label-info">AKTIF</span>';
    else 
        return '<span class="label label-danger">NON AKTIF</span>';
}

function cek_status_pengiriman($id)
{
    if($id=='belum terkirim')
        return '<span class="label label-danger">Belum Terkirim</span>';
    else if($id=='sedang dikirim')
        return '<span class="label label-warning">Sedang Dikirim</span>';
    else if($id=="sudah dikirim")
        return '<span class="label label-success">Sudah Dikirim</span>';
}


function get_edit_del($id,$kode)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a onclick="actEdit('.$id.')" data-toggle="tooltip" title="Edit" class="btn purple btn-xs btn-default"><i class="fa fa-pencil"></i> Edit</a>
    <a style="padding:3.5px;" onclick="actDelete('.$id.',\''.$kode.'\')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}

function get_edit_del_bj($id,$kode_unit,$kode_rak,$kode_bahan_jadi)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a onclick="actEdit('.$id.')" data-toggle="tooltip" title="Edit" class="btn purple btn-xs btn-default"><i class="fa fa-pencil"></i> Edit</a>
    <a style="padding:3.5px;" onclick="actDelete('.$id.',\''.$kode_unit.'\',\''.$kode_rak.'\',\''.$kode_bahan_jadi.'\')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}

function get_edit_del_id($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a onclick="actEdit('.$id.')" data-toggle="tooltip" title="Edit" class="btn purple btn-xs btn-default"><i class="fa fa-pencil"></i> Edit</a>
    <a onclick="actDelete('.$id.')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}

function get_del_temp($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a style="padding:3.5px;" onclick="actDeleteTemp('.$id.')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}


function get_detail($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail/'.$id.'" data-toggle="tooltip" title="Detail" style="width:150px;" class="btn btn-block green"><i class="fa fa-search"></i> Detail</a>
    </div>
    ';
    
    return $html;
}

function get_detail_laporan($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail_laporan/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
    </div>
    ';
    
    return $html;
}

function get_detail_laporan_menu($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail_laporan_menu/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
    </div>
    ';
    
    return $html;
}

function get_detail_persediaan($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail_stok/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
    </div>
    ';
    
    return $html;
}

function get_detail_print($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> Detail</a>
        <a href="print_po/'.$id.'" target="_blank" data-toggle="tooltip" title="Print" class="btn btn-xs blue"><i class="fa fa-print"></i> Print</a>
    </div>
    ';
    
    return $html;
}


function get_detail_mutasi($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail_mutasi/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
    </div>
    ';
    
    return $html;
}

function get_detail_stok($kode_unit, $kode_rak ,$kode_bahan)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="../detail/'.$kode_unit.'/'.$kode_rak.'/'.$kode_bahan.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
    </div>
    ';
    
    return $html;
}

function get_validasi_opname($uri, $id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="../validasi_opname/'.$uri.'/'.$id.'" data-toggle="tooltip" title="Validasi" class="btn btn-xs green"><i class="fa fa-check-square-o"></i>  Validasi</a>
    </div>
    ';
    
    return $html;
}

function get_detail_spoil($uri, $id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="../detail_spoil/'.$uri.'/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
    </div>
    ';
    
    return $html;
}

function get_detail_proses($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs blue"><i class="fa fa-search"></i> detail</a>
        <a href="proses/'.$id.'" data-toggle="tooltip" title="Proses" class="btn btn-xs green"><i class="fa fa-pencil"></i> proses</a>
    </div>
    ';
    
    return $html;
}

function cek_status_retur($status)
{
    if($status=='menunggu'){
        return '<div class="btn btn-xs red">'.$status.'</div>';
    }
    else {
        return '<div class="btn btn-xs green">'.$status.'</div>';
    }
}

function cek_status_meja($id)
{
    if($id==0)
        return '<span class="label label-success">Kosong</span>';
    else 
        return '<span class="label label-danger">Terpakai</span>';
}
function cek_status_penerimaan($id)
{
    if($id=="diambil")
        return '<span class="label label-success">Diambil</span>';
    else 
        return '<span class="label label-danger">Dikirim</span>';
}

function bill_php_right($variable,$karakter){
    $j_karakter = $karakter;
    $varia = $variable; 
    $hitung = $j_karakter - strlen($varia);
    $nilai = ' ';
    $nilaii = '';
    for($nil=0;$nil<$hitung;$nil++){
        $nilaii = $nilai.$nilaii;
    }
    if($hitung < 1){
        $hasil = substr($varia, 0, $j_karakter);
    } else {
        $hasil = $nilaii.$varia;
    }
    

    return $hasil;
}
function bill_php_Left($variable,$karakter){
    $j_karakter = $karakter;
    $varia = $variable; 
    $hitung = $j_karakter - strlen($varia);
    $nilai = ' ';
    $nilaii = '';
    for($nil=0;$nil<$hitung;$nil++){
        $nilaii = $nilai.$nilaii;
    }
    if($hitung < 1){
        $hasil = substr($varia, 0, $j_karakter);
    } else {
        $hasil = $varia.$nilaii;
    }
    

    return $hasil;
}
function bill_php_middle($variable,$karakter){
    $j_karakter = $karakter;
    $varia = $variable; 
    $hitung_awal = ($j_karakter - strlen($varia))/2;
    $hitung = round($hitung_awal, 0, PHP_ROUND_HALF_DOWN);
    $nilai = ' ';
    $nilaii = '';
    for($nil=0;$nil<$hitung;$nil++){
        $nilaii = $nilai.$nilaii;
    }
    if($hitung < 1){
        $hasil = substr($varia, 0, $j_karakter);
    } else {
        $hasil = $nilaii.$varia.$nilaii;
    }
    
    return $hasil;
}
function bill_php_middle_alamat($variable,$karakter){
    $j_karakter = $karakter;
    $varia = $variable; 
    $hitung_awal = ($j_karakter - strlen($varia))/2;
    $hitung = round($hitung_awal, 0, PHP_ROUND_HALF_DOWN);
    $nilai = ' ';
    $nilaii = '';
    for($nil=0;$nil<$hitung;$nil++){
        $nilaii = $nilai.$nilaii;
    }
    if($hitung < 1){
        $hasil = substr($varia, 0, $j_karakter)."\n";
        
        $varia2 = substr($varia, $j_karakter, ($j_karakter*2));
        $hitung_awal2 = ($j_karakter - strlen($varia2))/2;
        $hitung2 = round($hitung_awal2, 0, PHP_ROUND_HALF_DOWN);
        $nilai2 = ' ';
        $nilaii2 = '';
        for($nil=0;$nil<$hitung2;$nil++){
            $nilaii2 = $nilai2.$nilaii2;
        }
        $hasil .= $nilaii2.$varia2.$nilaii2;

    } else {
        $hasil = $nilaii.$varia.$nilaii;
    }
    
    return $hasil;
}
?>