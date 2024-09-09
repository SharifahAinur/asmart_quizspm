<?PHP 
include('header_guru.php'); 
?>

<h3>Analisis Prestasi Murid</h3>
<form action='' method='POST'>

Kelas
<select name='id_kelas'">
        <option value selected disable>Pilih</option>
    <?PHP 
    if($_SESSION['tahap']=='ADMIN')
    {
        $sql="select* from kelas, guru
        where
        kelas.nokp_guru=guru.nokp_guru
        ";
    }
    else
    {
        $sql="select* from kelas, guru
        where
        kelas.nokp_guru=guru.nokp_guru
        and
        kelas.nokp_guru='".$_SESSION['nokp_guru']."'
        ";
    }
    # arahan untuk mencari semua data dari jadual kelas
   
    # Melaksanakan arahan mencari data
    $laksana_arahan_cari=mysqli_query($condb,$sql);
    # pemboleh ubah $rekod mengambil data yang ditemui baris demi baris
    while ($rekod=mysqli_fetch_array($laksana_arahan_cari))
    {
        # memaparkan data yang ditemui dalam element <option></option>
        echo "<option value=".$rekod['id_kelas'].">".$rekod['ting']." ".$rekod['nama_kelas']."</option>
        ";
    }

    ?>
</select>
<br>
Topik
<select name='no_set'">
        <option value selected disable>Pilih</option>
    <?PHP 
    if($_SESSION['tahap']=='ADMIN')
    {
        $sql2="select* from set_soalan, guru
        where
        set_soalan.nokp_guru=guru.nokp_guru
        ";
    }
    else
    {
        $sql2="select* from set_soalan, guru
        where
        set_soalan.nokp_guru=guru.nokp_guru
        and
        set_soalan.nokp_guru='".$_SESSION['nokp_guru']."'
        ";
    }
    # arahan untuk mencari semua data dari jadual set
    
    # Melaksanakan arahan mencari data
    $laksana_arahan_cari2=mysqli_query($condb,$sql2);
    # pemboleh ubah $rekod mengambil data yang ditemui baris demi baris
    while ($rekod2=mysqli_fetch_array($laksana_arahan_cari2))
    {
        # memaparkan data yang ditemui dalam element <option></option>
        echo "<option value=".$rekod2['no_set'].">".$rekod2['topik']."</option>
        ";
        
    }

    ?>
</select>
<br>
<input type='submit' value = 'Papar Keputusan'>
</form>
<?PHP 

if(!empty($_POST))
{
    $id_kelas=$_POST['id_kelas'];
    $no_set=$_POST['no_set'];

    $arahan_kelas="select* from kelas where id_kelas='$id_kelas'";
    $laksana_kelas=mysqli_query($condb,$arahan_kelas);
    $data1=mysqli_fetch_array($laksana_kelas);
    $nama_kelas=$data1['ting'].$data1['nama_kelas'];

    $arahan_topik="select* from set_soalan where no_set='$no_set'";
    $laksana_topik=mysqli_query($condb,$arahan_topik);
    $data2=mysqli_fetch_array($laksana_topik);
    $nama_topik=$data2['topik'];

    $arahan_pilih="select* from murid,kelas where murid.id_kelas=kelas.id_kelas and murid.id_kelas='$id_kelas' order by murid.nama_murid ASC";
    $laksana_pilih= mysqli_query($condb,$arahan_pilih);

if(mysqli_num_rows($laksana_pilih))
{
    echo"
    <br>Kelas : $nama_kelas
    <br>Topik : $nama_topik
    <br><button onclick='window.print()'>Cetak Keputusan</button>";
    include ('../butang_saiz.php');
    echo"<table width='100%' border='1' id='besar'>
    <tr>
        <td>Nama Murid</td>
        <td>Nokp Murid</td>
        <td>Skor</td>
        <td>Markah</td>
    </tr>";
}
else
{
    echo "tiada data yang ditemui bagi kelas tersebut";
}

function skor($no_set,$nokp_murid)
{
    include ('../connection.php');
    
    $arahan_skor="SELECT* 
    FROM jawapan_murid,set_soalan,soalan
    WHERE
            set_soalan.no_set			=	soalan.no_set 
    AND     jawapan_murid.no_soalan		=	soalan.no_soalan
    AND 	jawapan_murid.nokp_murid 	= 	'$nokp_murid'
    AND 	set_soalan.no_set			=	'$no_set'	";

    $laksana_skor=mysqli_query($condb,$arahan_skor);
    $bil_jawapan=mysqli_num_rows($laksana_skor);
    $bil_betul=0;
    if($bil_jawapan>=1)
    {
       while($rekod=mysqli_fetch_array($laksana_skor))
        {
            switch($rekod['catatan'])
            {
                case 'BETUL'    : $bil_betul++; break;
                default         : break;
            }
            $topik=$rekod['topik'];
        }
        
        $markah=$bil_betul/$bil_jawapan*100;

        echo "  
            <td>".$bil_betul." / ".$bil_jawapan."</td>
            <td>".number_format($markah,0)." %</td> ";
    }
    else
    echo "<td></td> <td>Belum Jawab</td>";
}

while($data=mysqli_fetch_array($laksana_pilih))
{
    echo "<tr>
    <td>".$data['nama_murid']."</td>
    <td>".$data['nokp_murid']."</td>";
    skor($no_set,$data['nokp_murid']);
echo "</tr>";
}
}
 ?>
</table>

<?PHP include('footer_guru.php'); ?>