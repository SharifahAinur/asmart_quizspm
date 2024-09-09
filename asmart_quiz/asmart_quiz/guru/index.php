<?PHP 
# memanggil fail header.php
include ('header_guru.php'); 

# Memaparkan nama guru dah tahap
echo "Nama Guru : ".$_SESSION['nama_guru']."(".$_SESSION['tahap'].")";
?>
<br>
<hr>
<!-- Memaparkan senarai latihan terkini -->
Senarai Latihan Terkini
        <table border='1'>
        <tr>
            <td>Topik</td>
            <td>Kelas</td>
            <td>Nama Guru</td>
        </tr>
        <?PHP 
        # Arahan untuk mencari data guru, kelas dan set_soalan
        $arahan_latihan="SELECT* FROM set_soalan, guru, kelas
        WHERE
                    set_soalan.nokp_guru		=		guru.nokp_guru
        AND 	    kelas.nokp_guru			    =		guru.nokp_guru
        ORDER BY    set_soalan.tarikh ASC ";

        # Melaksanakan arahan carian di atas
        $laksana_latihan=mysqli_query($condb,$arahan_latihan);

        #mengambil data dan memaparkan semula data tersebut
        while($rekod=mysqli_fetch_array($laksana_latihan))
        {
            echo "
            <tr>
                <td>".$rekod['topik']."</td>
                <td>".$rekod['ting']." ".$rekod['nama_kelas']."</td>
                <td>".$rekod['nama_guru']."</td>           
            </tr>";
        }

        ?>
        </table>

<?PHP include('footer_guru.php'); ?>