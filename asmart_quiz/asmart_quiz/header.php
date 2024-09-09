<?PHP 
# memulakan fungsi session_start bagi membolehkan pembolehubah super global session digunakan
session_start(); ?>

<!-- Tajuk Sistem -->
<h1 align='center'>KUIZ ONLINE MATEMATIK</h1>
<hr>

<!-- Menu bahagian Murid -->
<?PHP if(!empty ($_SESSION)){ ?>
<?PHP echo "Nama Murid : ". $_SESSION['nama_murid']; ?>
| <a href='pilih_latihan.php'>Laman Utama</a>
| <a href='../logout.php'>logout</a>|
<hr>
<?PHP } ?>
