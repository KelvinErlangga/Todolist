<?php 

if (isset($_POST['id'])) {
    require '../db_conn.php';
    
    $id = $_POST['id'];

    if (empty($id)) {
        echo 0;
    } else {
        $statement = $conn->prepare("DELETE FROM todo WHERE id = ?");
        $result = $statement->execute([$id]);

        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../index.php?mess=error");
}

?>