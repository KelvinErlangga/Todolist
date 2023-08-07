<?php 

if (isset($_POST['id'])) {
    require '../db_conn.php';
    
    $id = $_POST['id'];

    if (empty($id)) {
        echo 'error';
    } else {
        $todos = $conn->prepare("SELECT id, cek FROM todo WHERE id = ?");
        $todos->execute([$id]);

        $todo = $todos->fetch();
        $uId = $todo['id'];
        $cek = $todo['cek'];

        $uChecked = $cek ? 0 : 1;

        $result = $conn->query("UPDATE todo SET cek = $uChecked WHERE id = $uId");

        if ($result) {
            echo $cek;
        } else {
            echo "Error";
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../index.php?mess=error");
}

?>