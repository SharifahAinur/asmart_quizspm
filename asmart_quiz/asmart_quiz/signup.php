<?PHP 
#memanggil fail header.php dan connection.php
include('header.php');
include('connection.php'); 

#menguji kewujudan data POST yang dihantar oleh bahagian borang di bawah
if(!empty($_POST))
{
    #mengambil dan menapis data POST
    $nama           =   mysqli_real_escape_string($condb,$_POST['nama']);
    $nokp           =   mysqli_real_escape_string($condb,$_POST['nokp']);
    $katalaluan     =   mysqli_real_escape_string($condb,$_POST['katalaluan']);
    $id_kelas       =   $_POST['id_kelas'];

    # menyemak kewujudan data yang dimasukkan.
    if(empty($nama) or empty($nokp) or empty($katalaluan) or empty($id_kelas))
    {
        die("<script>alert('Sila lengkapkan maklumat');
        window.history.back();</script>");
    }

    #had atas dan had bawah : sebagai data validation kepada nokp
    if(strlen($nokp)!=12 or !is_numeric($nokp))
    {
        die("<script>alert('Ralat No K/P.');
        window.history.back();</script>");
    }
    # arahan untuk menyimpan data murid yang dimasukkan
    $arahan_simpan="insert into murid
        (nama_murid,nokp_murid,katalaluan_murid,id_kelas)
        values
        ('$nama','$nokp','$katalaluan','$id_kelas')";
    #laksanakan arahan dalam block if
    if(mysqli_query($condb,$arahan_simpan))
    {
        # data berjaya disimpan. papar popup
        echo "<script>alert('Pendaftaran BERJAYA.');
        window.location.href='index.php';</script>";
    }
    else
    {
        # data gagal disimpan papar popup
        echo "<script>alert('Pendaftaran GAGAL.');
        window.history.back();</script>";
    }
    
}
?>

<!-- Bahagian borang untuk mendaftar murid baru -->
<h3>Pendaftaran Murid Baru</h3>
<form action='' method='POST'>
    Nama Murid      <input type='text'      name='nama'><br>
    No K/P Murid    <input type='text'      name='nokp'><br>
    Katalaluan      <input type='password'  name='katalaluan'><br>
    Kelas           <select name='id_kelas'>
                        <option value selected disable>Pilih</option>
                        <?PHP 
                        # arahan untuk mencari semua data dari jadual kelas
                        $sql="select* from kelas";
                        # Melaksanakan arahan mencari data
                        $laksana_arahan_cari=mysqli_query($condb,$sql);
                        # pemboleh ubah $rekod_bilik mengambil data yang ditemui baris demi baris
                        while ($rekod_bilik=mysqli_fetch_array($laksana_arahan_cari))
                        {
                            # memaparkan data yang ditemui dalam element <option></option>
                            echo "<option value=".$rekod_bilik['id_kelas'].">".$rekod_bilik['ting']." ".$rekod_bilik['nama_kelas']."</option>";
                        }

                    ?>
                    </select><br>
                    <input type='submit'    value='Daftar'>
</form>

<?PHP 
mysqli_close($condb);
include ('footer.php'); ?>