<?PHP 
# memanggil fail header_guru.php
include('header_guru.php'); 

# menyemak kewujudan data POST untuk proses mendaftar guru baru
if(!empty($_POST))
{
    # mengambil data dari form yang dimasukan oleh admin
    $nama           =   mysqli_real_escape_string($condb,$_POST['nama_baru']);
    $nokp           =   mysqli_real_escape_string($condb,$_POST['nokp_baru']);
    $katalaluan     =   mysqli_real_escape_string($condb,$_POST['katalaluan_baru']);
    $tahap          =   $_POST['tahap']; 

    # menyemak kewujudan data yang diambil
    if(empty($nama) or empty($nokp) or empty($katalaluan)or empty($tahap))
    {
        # jika data tidak wujud, aturcara akan terhenti disini.
        die("<script>alert('Sila lengkapkan maklumat');
        window.history.back();</script>");
    }

    # Had atas & had bawah. data validation bagi nokp guru
    if(strlen($nokp)!=12 or !is_numeric($nokp))
    {
        die("<script>alert('Ralat No K/P.');
        window.history.back();</script>");
    }

    # arahan untuk menyimpan data guru
    $arahan_simpan="insert into guru
        (nama_guru,nokp_guru,katalaluan_guru,tahap)
        values
        ('$nama','$nokp','$katalaluan','$tahap')";

    # melaksanakan arahan untuk menyimpan data guru ke dalam jadual
    if(mysqli_query($condb,$arahan_simpan))
    {
        # data berjaya disimpan
        echo "<script>alert('Pendaftaran BERJAYA.');
        window.location.href='guru_senarai.php';</script>";
    }
    else
    {   
        # data gagal disimpan
        echo "<script>alert('Pendaftaran GAGAL.');
        window.location.href='guru_senarai.php';</script>";
    }
}
?>

<!-- Bahagian untuk memaparkan senarai guru-->
<h3>Senarai Guru</h3>
<?PHP include ('../butang_saiz.php'); ?>
<table width='100%' border='1' id='besar'>
    <tr>
        <td>Nama</td>
        <td>Nokp</td>
        <td>katalaluan</td>
        <td>Tahap</td>
        <td>tindakan</td>       
    </tr>
    <tr>
    <!-- borang untuk mendaftar guru baru -->
        <form action='' method='POST'>
            <td><input      type='text'         name='nama_baru'></td>
            <td><input      type='text'         name='nokp_baru'></td>
            <td><input      type='password'     name='katalaluan_baru'></td>
            <td>
                <select name='tahap'>
                    <option value selected disabled>Pilih</option>
                    <option value='GURU'>GURU</option>
                    <option value='ADMIN'>ADMIN</option>            
                </select>
            </td>
            <td><input type='submit' value='simpan'></td>
        </form> 
    </tr>

<?PHP

# arahan SQL untuk memilih data dari jadual guru
$arahan_cari_guru="select* from guru order by tahap ASC";

# melaksanakan arahan SQL diatas
$laksana_cari_guru=mysqli_query($condb,$arahan_cari_guru);

# mengambil semua data yang ditemui 
while ($data=mysqli_fetch_array($laksana_cari_guru))
{
    # umpuk data kedalam tatasusunan.
    $data_guru=array(
        'nama_guru'            =>      $data['nama_guru'],
        'nokp_guru'            =>      $data['nokp_guru'],
        'katalaluan_guru'      =>      $data['katalaluan_guru']
    );

    # memaparkan data dalm bentuk jadual baris demi baris
    echo "<tr>
        <td>".$data['nama_guru']."</td>
        <td>".$data['nokp_guru']."</td>
        <td>".$data['katalaluan_guru']."</td>
        <td>".$data['tahap']."</td>
        <td>
            | <a href='guru_kemaskini.php?".http_build_query($data_guru)."'> Kemaskini </a>
            | <a href='padam.php?jadual=guru&medan=nokp_guru&kp=".$data['nokp_guru']."'
              onClick=\"return confirm('Sebelum memadam data guru, pastikan beliau tidak mempunyai kelas terlebih dahulu')\" > Padam </a> |   
        </td> 
    </tr>";
}
?>
</table>

<?PHP include('footer_guru.php'); ?>