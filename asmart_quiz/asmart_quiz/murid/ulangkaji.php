<?PHP 
include ('../header.php');
include ('../connection.php');

if(empty($_GET) or empty($_SESSION['nama_murid']))
{ 
    die("<script>alert('Akses tanpa kebenaran');
    window.location.href='pilih_latihan.php';</script>");
}

$pecahkanbaris = explode("|",$_GET['kumpul']);
list($bil_betul,$bil_soalan,$peratus,$bil_jawapan) = $pecahkanbaris;
$arahan_carian="SELECT*
from set_soalan,soalan,jawapan_murid,murid
where
	set_soalan.no_set		=		soalan.no_set
AND	soalan.no_soalan		= 		jawapan_murid.no_soalan
AND murid.nokp_murid		=		jawapan_murid.nokp_murid
AND	murid.nokp_murid		=		'".$_SESSION['nokp_murid']."'
AND	soalan.no_set			=		'".$_GET['no_set']."'
";

$laksana_carian=mysqli_query($condb,$arahan_carian);
echo "
<h3>Bahagian Ulangkaji</h3>
<h4>Anda telah selesai menjawap soalan dalam latihan/Kuiz ini</h4>
Topik : ".$_GET['topik']."<br>
Skor : ".$bil_betul." / ".$bil_soalan."<br>
Peratus : ".$peratus."
<hr>";
$bil=0;
while($rekod=mysqli_fetch_array($laksana_carian))
{
    if($rekod['jawapan']!="tidak jawap")
    {
        $nilai_jawapan=$rekod[$rekod['jawapan']];
    }
    else
    {
        $nilai_jawapan='Tidak Jawap';
    }
     
    echo "
    No Soalan : ".++$bil."<br>
    ".$rekod['soalan']."<br>
    <img src='".$rekod['gambar']."'><br>
    <li>".$rekod['jawapan_a']." <br>
    <li>".$rekod['jawapan_b']."<br>
    <li>".$rekod['jawapan_c']."<br>
    <li>".$rekod['jawapan_d']."<br><br>

    Jawapan Sebenar : ".$rekod['jawapan_a']."<br>
    Jawapan anda : ".$nilai_jawapan."<br>
    Status : ".$rekod['catatan']."
<hr>

    ";
}
mysqli_close($condb);
?>
<?PHP include ('../footer.php'); ?>