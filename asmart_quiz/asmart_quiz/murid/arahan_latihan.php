<?PHP 
include ('../header.php');
if(empty($_GET))
{ 
    die("<script>alert('Akses tanpa kebenaran');
    window.location.href='pilih_latihan.php';</script>");
}

include('../connection.php');

$arahan_pilih_set   =   "select* from set_soalan where no_set='".$_GET['no_set']."'";
$laksana            =   mysqli_query($condb,$arahan_pilih_set);
$data               =   mysqli_fetch_array($laksana)
?>

<h3>Arahan</h3>
<hr>
<?PHP echo $data['arahan']; ?><br>
<a href='jawap_soalan.php?no_set=<?PHP echo $_GET['no_set']; ?>&masa=<?PHP echo $data['masa']; ?>&jenis=<?PHP echo $data['jenis']; ?>'>Mula</a>
<?PHP include ('../footer.php'); ?>