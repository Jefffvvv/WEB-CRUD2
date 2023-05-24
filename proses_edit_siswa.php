<?php
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $halaman = $_POST["halaman"];
    $kategori = $_POST["kategori"];

    include "koneksi.php";
    if (    $foto = basename($_FILES["foto"]["name"])) {
        $temp = $_FILES['foto']['tmp_name'];
        $type = $_FILES['foto']['type'];
        $size = $_FILES['foto']['size'];
        $name = rand(0,9999).$_FILES['foto']['name'];
        $folder = "images/";
        $target_file = $folder . basename($_FILES["foto"]["name"]);

        if ($size < 2048000 and ($type =='image/jpeg' or $type == 'image/png'))
        {
            $query_foto = mysqli_query($konn, "SELECT * FROM siswa where id = '".$_POST['id']."'");
            $data_foto = mysqli_fetch_array($query_foto);
            unlink('images/'.$data_foto['foto']);

            move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
            $input = mysqli_query($konn, "UPDATE siswa SET 
            nama='".$nama."', halaman='".$halaman."',
            kategori='".$kategori."', foto='".$foto."'
            where id='".$id."'");
 mysqli_error($konn);
             if ($input) {

                 echo "<script>alert('Sukses mengubah buku');location.href='siswa.php';</script>";
             }
             else {
                 echo "<script>alert('Gagal mengubah buku');location.href='siswa.php';</script>";
             }
        }
    }
    else{
        $input = mysqli_query($konn, "UPDATE siswa SET 
        nama='".$nama."', halaman='".$halaman."', kategori='".$kategori."' where id='".$id."'");

         if ($input) {
             echo "<script>alert('Sukses mengubah buku');location.href='siswa.php';</script>";
         }
         else {
             echo "<script>alert('Gagal mengubah buku');location.href='siswa.php';</script>";
         }
    }

?>
