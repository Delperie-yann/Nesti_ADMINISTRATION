

<head>
<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/fontawesome-free-5.15.1-web/css/all.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/styleConnection.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/styleNavigation.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/styleStats.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/recipes.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/toastui-chart.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/importation.css">
  
    <script>
        let vars = <?= json_encode($arrayVars ?? []) ?>;
    </script>
    <title>PHP_Nesti_Site</title>
</head>

<body>
    <?php
    if ($loc != "connection") {
        include 'navigation.php';
    }
    ?>
  