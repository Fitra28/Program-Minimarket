<!DOCTYPE html>
<html>
<head>
    <title>penjualan</title>
</head>
<body>
<form name="frm_penjualan" targwt="_self" action="" method="GET">
    <table>
        <caption>Form Minimarket</caption>
        <tr>
            <td>Nama Barang</td>
            <td>
                <input type="text" name="nama_barang_txt">
            </td>
        </tr>
        <tr>
            <td>Harga</td>
            <td>
                <input type="text" name="harga_barang_txt">
            </td>                 
        </tr>
        <tr>
            <td>Quantity</td>
            <td>
                <input type="text" name="qty_barang_txt">
            </td>    
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <input type="radio" name="rd_status" value="pelanggan">pelanggan<br>
                <input type="radio" name="rd_status" value="bukan_pelanggan">bukan pelanggan
            </td>    
        </tr>
        <tr>
            <td>Kota</td>
            <td>
                <select name="kota">
                    <option value="tidak_memilih">Pilih kota</option>
                    <option value="jakarta">Jakarta</option>
                    <option value="depok">Depok</option>
                    <option value="bandung">Bandung</option>
                    <option value="semarang">Semarang</option>
                    <option value="surabaya">Surabaya</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="btn_submit" value="Proses">
                <input type="reset" value="Reset">
            </td>
        </tr>
    </table>
</form>
<?php
if(isset($_GET['btn_submit']))
{
    @$nama_barang=$_GET['nama_barang_txt'];
    @$harga_barang=$_GET['harga_barang_txt'];
    @$qty_barang=$_GET['qty_barang_txt'];
    @$status=$_GET['rd_status'];
    @$kota=$_GET['kota'];
    $pesan_validasi=array();
    //validasi nama barang
    if(empty($nama_barang))
    {
        $pesan_validasi[]="tentukan nama barang";
    }
    //valisadi harga barang    
    if(empty($harga_barang))
    {
        $pesan_validasi[]="Tentukan harga barang";
    }    
    else
    {
        if(!is_numeric($harga_barang))
        {
            $pesan_validasi="Harga barang harus berupa angka";
        }
    }
    //validasi quantity
    if(empty($qty_barang))
    {
        $pesan_validasi[]="Tentukan quantity barang";
    }
    else
    {
        if(!is_numeric($qty_barang))
        {
            $pesan_validasi[]="Quantity barang harus berupa angka";
        }
    }
    //validasi status
    if(empty($status))
    {
        $pesan_validasi[]="Tentukan status";
    }
    //validasi kota
    if($kota == "tidak_memilih")
    {
        $pesan_validasi[]="Tentukan kota";
    }
    //pengecekan validasi
    if(count($pesan_validasi) !=0)
    {
        foreach ($pesan_validasi as $pesan) {
            echo "<p><sup>*</sup>$pesan</p>" ;
        }
    }
    else
    {
        //MENGHITUNG SUBTOTAL
        $sub_total=$harga_barang * $qty_barang;
        //MENGHITUNG DISKON
        if($status == "pelanggan")
        {
            $status = "pelanggan";
            $diskon = 0.1 * $sub_total;
        }
        else
        {
            $status = "Bukan pelanggan";
            $diskon = 0;
        }
        //MENGHITUNG ONGKOS KIRIM
        if($kota == "jakarta")
        {
            $ongkos_kirim = 10000;
        }
        else if ($kota == "depok")
        {
            $ongkos_kirim = 20000;
        }
        else if ($kota == "bandung")
        {
            $ongkos_kirim = 25000;
        }
        else if ($kota == "semarang")
        {
            $ongkos_kirim = 30000;
        }
        else if ($kota == "surabaya")
        {
            $ongkos_kirim = 25000;
        }
        //MENGHITUNG TOTAL
        $total = ($sub_total - $diskon) + $ongkos_kirim;
        ?>

             <table border="1">
                 <tr>
                     <th colspan="2">DATA PENJUALAN</th>
                 </tr>
                 <tr>
                     <td>Nama Barang</td>
                     <td>
                         <?php echo $nama_barang; ?>
                     </td>
                 </tr>
                 <tr>
                     <td>Harga</td>
                     <td>
                         Rp.
                         <?php echo number_format($harga_barang,0,',','.'); ?>
                     </td>
                 </tr>
                 <tr>
                     <td>Quantity</td>
                     <td>
                         <?php echo $qty_barang; ?>
                         unit
                     </td>
                 </tr>
                 <tr>
                     <td>Subtotal</td>
                     <td>
                         Rp
                         <?php echo number_format($sub_total,0,',','.'); ?>
                     </td>
                 </tr>
                 <tr>
                     <td>Status</td>
                     <td>
                         <?php echo $status; ?>
                     </td>
                 </tr>
                 <tr>
                     <td>Diskon</td>
                     <td>Rp
                         <?php echo number_format($diskon,0,',','.'); ?>
                     </td>
                 </tr>
                 <tr>
                     <td>Ongkos Kirim</td>
                     <td>Rp
                         <?php echo number_format($ongkos_kirim,0,',','.') ?>
                         (<?php echo $kota ?>)
                     </td>
                 </tr>
                 <tr>
                     <td>Total</td>
                     <td>
                         Rp
                         <?php echo number_format($total,0,',','.') ?>
                     </td>
                 </tr>
             </table>

        <?php
    }
}
?>
</body>
</html>
