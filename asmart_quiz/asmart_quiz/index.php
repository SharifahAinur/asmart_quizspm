 <?PHP 
#memanggil fail header.php
include ('header.php'); 
?>
<!-- antara muka untuk daftar masuk / login -->
<table  width='100%'>
    <tr>
        <td align='center' width='50%'>
            <h3>Login Pengguna</h3>
            <form action='login.php' method='POST'>
            No K/P      <input type='text'      name='nokp' placeholder='040503010203'><br>
            Katalaluan  <input type='password'  name='katalaluan'><br>
                        <input type='radio'     name='jenis' value='murid' checked>murid
                        <input type='radio'     name='jenis' value='guru'>guru<br>
                        <input type='submit'    value='Login'>
            
            </form>
            <!-- pautan untuk mendaftar murid baru -->
            <a href='signup.php'>Daftar Murid Baru</a>
        </td>
        <td>
        <!--Senarai set latihan terkini -->
        Senarai Latihan Terkini
        <table border='1'>
        <tr>
            <td>Topik</td>
            <td>Kelas</td>
            <td>Nama Guru</td>
        </tr>
        <?PHP 
        #memanggil fail connection.php
        include('connection.php');
        #arahan sql untuk mencari data set soalan yang terkini
        $arahan_latihan="SELECT* FROM set_soalan, guru, kelas
        WHERE
                set_soalan.nokp_guru		=		guru.nokp_guru
        AND 	kelas.nokp_guru			    =		guru.nokp_guru
        ORDER BY    set_soalan.tarikh ASC ";

        #melaksanakan arahan SQL diatas
        $laksana_latihan=mysqli_query($condb,$arahan_latihan);

        #mengambil dan memaparkan senarai set soalan, tingkatan yang terlibat dan guru
        while($rekod=mysqli_fetch_array($laksana_latihan))
        {
            echo "
            <tr>
                <td>".$rekod['topik']."</td>
                <td>".$rekod['ting']." ".$rekod['nama_kelas']."</td>
                <td>".$rekod['nama_guru']."</td>           
            </tr>";
        }
        mysqli_close($condb);
        ?>
        </table>
        </td>   
    </tr>


</table>
<?PHP 
# Memanggil fail footer.php
include ('footer.php'); ?>