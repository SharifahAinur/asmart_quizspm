<?PHP 
# Memulakan fungsi session
session_start();
# Memanggil fail guard_guru.php
include ('guard_guru.php'); 
# Memanggil fail connection dari folder utama
include ('../connection.php');
# Menguji pembolehubah session tahap mempunyai nilai atau tidak
if(empty($_SESSION['tahap']))
{
    # proses untuk mendapatkan tahap pengguna yang sedang login samada admin atau guru
    $arahan_semak_tahap="select* from guru where 
    nokp_guru   =   '".$_SESSION['nokp_guru']."' 
    limit 1";
    $laksana_semak_tahap=mysqli_query($condb,$arahan_semak_tahap);
    $data=mysqli_fetch_array($laksana_semak_tahap);
    $_SESSION['tahap']=$data['tahap'];
}
?>
<!-- tajuk Sistem -->
<h1>ASmart Quiz : Bahagian Guru</h1>
<hr>

<!-- Menu -->
| <a href='index.php'>Laman Utama</a>
<?PHP if($_SESSION['tahap']=='ADMIN'){ ?>
    | <a href='guru_senarai.php'>Maklumat Guru</a>
    | <a href='murid_senarai.php'>Pengurusan Murid</a>
    | <a href='senarai_kelas.php'>Pengurusan Kelas</a>
<?PHP } ?>
    | <a href='soalan_set.php'>Pengurusan Soalan</a>
    | <a href='analisis.php'>Analisis Prestasi</a>
    | <a href='../logout.php'>Logout</a> |
<hr>