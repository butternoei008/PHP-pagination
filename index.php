<?php
    include_once("config.php");
    include_once("pagination.inc.php");

    $num = 0;
    $e_page = 50;
    $step_num = 0;
    $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;

    if (!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] == 1)) {
        $_GET['page'] = 1;
        $step_num = 0;
        $s_page = 0;
    } else {
        $s_page = $_GET['page'] - 1;
        $step_num = $_GET['page'] - 1;
        $s_page = $s_page * $e_page;
    }

    if (isset($_GET['keyword']) && $_GET['keyword'] != "") {
        $keyword = $_GET['keyword'];
        $list = $conn->query("SELECT * FROM name WHERE fname LIKE '%$keyword%'");
        $list_count = $list->num_rows;
    } else {
        $list = $conn->query("SELECT * FROM name LIMIT $s_page, $e_page");
        $list_count = $conn->query("SELECT * FROM name")->num_rows;
    }
    
    $total = $list_count;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>บทความ</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        p {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <section>
    <?php $i = 1; while($row = $list->fetch_assoc()) { ?>
        <p><?= $row['n_id'].'. '.$row['fname'].' '.$row['lname'] ?></p>
    <?php $i++; } ?>

    <?php page_navi($total, $cur_page, $e_page); ?>
    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>