<?php 

if (isset($_POST['judul'])) {
    require '../db_conn.php';
    
    $judul = $_POST['judul'];

    if (empty($judul)) {
        header("Location: ../index.php?mess=error");
    } else {
        $statement = $conn->prepare("INSERT INTO todo(judul) VALUE(?)");
        $result = $statement->execute([$judul]);

        if ($result) {
            header("Location: ../index.php?mess=success");
        } else {
            header("Location: ../index.php");
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../index.php?mess=error");
}

?>