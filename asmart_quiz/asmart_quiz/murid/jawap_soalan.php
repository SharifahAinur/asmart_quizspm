<?PHP 
include ('../header.php');
if(empty($_GET))
{ 
    die("<script>alert('Akses tanpa kebenaran');
    window.location.href='pilih_latihan.php';</script>");
}
include('../connection.php');

$arahan_pilih_soalan="select* from soalan where no_set='".$_GET['no_set']."' order by rand()";
$laksana=mysqli_query($condb,$arahan_pilih_soalan);
?>
<h3>Soalan Latihan</h3>
<hr>
<form name='soalan_kuiz' action='jawap_semak.php?no_set=<?PHP echo $_GET['no_set']; ?>' method='POST'>

<?PHP 

if($_GET['jenis']=="Kuiz")
{
include('timer2.php'); 
timer_kuiz($_GET['masa']);
}

?>
<?PHP include ('../butang_saiz.php'); ?>
<table border='1' width='50%' id='besar'>
<tr>
    <td>Bil</td>
    <td>soalan</td>
</tr>
<?PHP
$i=0;
while ($data=mysqli_fetch_array($laksana))
{
    echo"<tr>
    <td>".++$i."</td>
    <td>";
    $a=array("jawapan_a","jawapan_b","jawapan_c","jawapan_d");
    shuffle($a);
    $xjawap='TIDAK MENJAWAB';
    if($data['gambar']!=" ")
    {
        $gambar=$data['gambar'];
    }    
    else
    {
        $gambar=" ";
    }    

        echo $soalan=str_replace("'"," ",$data['soalan']);
        echo"
        <br><img src='$gambar'><br>
        <input type='radio' name='s".$data['no_soalan']."' value='".$a[0]."|".$data[$a[0]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'>
        <label>".$data[$a[0]]."</label><br>
        <input type='radio' name='s".$data['no_soalan']."' value='".$a[1]."|".$data[$a[1]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'>
        <label>".$data[$a[1]]."</label><br>
        <input type='radio' name='s".$data['no_soalan']."' value='".$a[2]."|".$data[$a[2]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'>
        <label>".$data[$a[2]]."</label><br>
        <input type='radio' name='s".$data['no_soalan']."' value='".$a[3]."|".$data[$a[3]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'>
        <label>".$data[$a[3]]."</label>
        <input type='radio' name='s".$data['no_soalan']."' value='tidak jawab|tidak jawab|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['jawapan_a']."|".$gambar."'  checked style='visibility: hidden'>
        <br>
        "; #
echo"</td> 
</tr>";
}
?>
</table>
<input type='submit' value='Hantar'>

</form>
<?PHP include ('../footer.php'); ?>