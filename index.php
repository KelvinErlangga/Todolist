<?php 

require 'db_conn.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <title>Todolist</title>
</head>
<body>
    <div class="main-section">

        <!-- Bagian input todo -->
        <div class="add-section">
            <form action="App/tambah.php" method="POST" autocomplete="off">
                <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error' ) { ?>
                    <input type="text" 
                        name="judul"
                        style="border-color: #ff0000;"
                        placeholder="Kolom ini perlu diisi"/>
                    <button type="submit">Tambah &nbsp; <span>&#43;</span></button>
                    
                <?php } else { ?>
                <input type="text" 
                    name="judul" 
                    placeholder="Tambah todo"/>
                <button type="submit">Tambah &nbsp; <span>&#43;</span></button>
                <?php } ?>
            </form>
        </div>
        <!-- Akhir bagian input todo -->

        <!-- Bagian tampil todos -->
        <?php 
        $todos = $conn->query("SELECT * FROM todo ORDER BY id DESC")
        ?>
        <div class="show-todo-section">
            <?php if ($todos->rowCount() <= 0) { ?>
                <div class="todo-item">
                    <div class="empty">
                        <img src="img/f.png" width="100%">
                        <img src="img/Ellipsis.gif" width="80px">
                    </div>
                </div>
            <?php } ?>

            <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="todo-item">
                <span id="<?php echo $todo['id']; ?>"
                      class="remove-to-do">x</span>
                <?php if ($todo['cek']) { ?>
                    <input type="checkbox"
                           class="check-box"
                           data-todo-id="<?php echo $todo['id']; ?>"
                           checked />
                    <h2 class="checked"><?php echo $todo['judul'] ?></h2>
                <?php } else { ?>
                    <input type="checkbox"
                           data-todo-id="<?php echo $todo['id']; ?>"
                           class="check-box" />
                    <h2><?php echo $todo['judul'] ?></h2>
                <?php } ?>
                <br>
                <small>Created: <?php echo $todo['tanggal_waktu'] ?></small>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- Akhir bagian tampil todos -->

    <script src="js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.remove-to-do').click(function() {
                const id = $(this).attr('id');

                $.post("App/hapus.php",
                    {
                        id: id
                    },
                    (data) => {
                        if (data) {
                            $(this).parent().hide(600);
                        }
                    }
                );
            });

            $(".check-box").click(function(e) {
                const id = $(this).attr('data-todo-id');
                
                $.post('App/cek.php',
                    {
                        id: id
                    },
                    (data) => {
                        if (data != 'error') {
                            const h2 = $(this).next();
                            if (data === '1') {
                                h2.removeClass("checked");
                            } else {
                                h2.addClass("checked");
                            }
                        }
                    }
                );
            });
        });
    </script>

</body>
</html>