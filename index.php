<?php
require 'db.php';

$query = "SELECT * FROM `chapter`
LEFT JOIN `illustration` 
ON `chapter`.`id` = `illustration`.`chapter_id`
LEFT JOIN `choice`
ON `chapter`.`id` = `choice`.`chapter_id`
WHERE `chapter`.`id` = ?";

if(isset($_POST['choice'])) {
$id = $_POST['choice'];
$stmt = db::query($query, [$id]);
$data = $stmt->fetchAll();
} else {
    $id = 1;
    $stmt = db::query($query, [$id]);
    $data = $stmt->fetchAll();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>playbook</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript">
        window.history.forward();
        function noBack(){ window.history.forward(); }
    </script>
</head>
<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <div class="book">
        <img class="open_book mt-3 w-100" src="img/kniha.png">

        <div class="container">
            <div class="row">
                <div class="images col-6">
                    <img class="w-100" src="img/<?php foreach($data as $value): ?><?= $value['filename'];?><?php endforeach;?>">
                </div>

                <div class="text_and_choices col-6">
                    <div class="col-12 mp-border">
                        <?php foreach($data as $value): ?>
                            <?= $value['text'];?>
                        <?php endforeach;?>
                    </div>
                    <div class="col-12 mp-border mt-5">
                        <form method="post" class="mb-2">
                        <?php foreach($data as $value): ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="choice" id="option" value="<?= $value['goto_id'];?>">
                                    <?= $value['choice'];?>
                                </label>
                            </div>
                        <?php endforeach;?>
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>