<?PHP 
include('../header.php');
include('guard_murid.php');
include('../connection.php');

$arahan_kelas="select*from murid where nokp_murid='".$_SESSION['nokp_murid']."'";
$laksana_kelas=mysqli_query($condb,$arahan_kelas);
$data_kelas=mysqli_fetch_array($laksana_kelas);
$arahan_pilih_latihan="SELECT 
set_soalan.no_set,
COUNT(soalan.no_soalan) AS bil_soalan, 
topik, jenis
FROM set_soalan, soalan,guru,kelas
WHERE
set_soalan.no_set   =   soalan.no_set
AND set_soalan.nokp_guru=guru.nokp_guru
AND kelas.nokp_guru = guru.nokp_guru
AND kelas.id_kelas = '".$data_kelas['id_kelas']."'
GROUP BY topik";

$laksana=mysqli_query($condb,$arahan_pilih_latihan);

function skor($no_set,$bil_soalan)
{
    include ('../connection.php');
    
    $arahan_skor="SELECT * 
            FROM set_soalan,soalan,jawapan_murid
            WHERE
                set_soalan.no_set		  	= 	soalan.no_set
            AND soalan.no_soalan			=	jawapan_murid.no_soalan
            AND set_soalan.no_set		  	=  '$no_set'
            AND jawapan_murid.nokp_murid	=	'".$_SESSION['nokp_murid']."'
            ";

    $laksana_skor=mysqli_query($condb,$arahan_skor);
    $bil_jawapan=mysqli_num_rows($laksana_skor);
    $bil_betul=0;
  
    while($rekod=mysqli_fetch_array($laksana_skor))
    {
        switch($rekod['catatan'])
        {
            case 'BETUL': $bil_betul++; break;
            default: break;
        }
    }

    $peratus=$bil_betul/$bil_soalan*100;
    echo"   <td align='right'>$bil_betul/$bil_soalan</td>
            <td align='right'>".number_format($peratus,0)."%</td>";
            $kumpul=$bil_betul."|".$bil_soalan."|".$peratus."|".$bil_jawapan;
    return $kumpul;
}

?>



<?PHP include ('../butang_saiz.php'); ?>
<table border='1' id='besar'>
<tr>
    <td>Bil</td>
    <td>topik</td>
    <td>Jenis latihan</td>
    <td>Bil soalan</td>
    <td>Skor</td>
    <td>Peratus</td>
    <td>Jawap</td>
</tr>
<?PHP
$i=0;
while ($data=mysqli_fetch_array($laksana))
{
    echo"
    
    <tr>
    <td>".++$i."</td>
    <td>".$data['topik']."</td>
    <td>".$data['jenis']."</td>
    <td align='center'>".$data['bil_soalan']."</td>   
    ";

        $kumpul=skor($data['no_set'],$data['bil_soalan']);
        $pecahkanbaris = explode("|",$kumpul);
        list($bil_betul,$bil_soalan,$peratus,$bil_jawapan) = $pecahkanbaris;


        if ($bil_jawapan<=0)
        {
        echo "<td><a href='arahan_latihan.php?no_set=".$data['no_set']."'>Pilih</a></td>";
        }
        else
        {
            echo"<td><a href='ulangkaji.php?no_set=".$data['no_set']."&topik=".$data['topik']."&kumpul=".$kumpul."'>Ulangkaji</a></td>";
        }

echo "</tr>";
}
?>





</table>

<?PHP include ('../footer.php'); ?>