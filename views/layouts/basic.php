<?php
/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php
$this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Начальная страница</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <?php
    $this->head() ?>
</head>
<body>
<?php
$this->beginBody() ?>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark ">
    <div class="container-fluid">
        <a class="navbar-brand">Logo</a>
    </div>
</nav>
<div class="container mt-4">
    <div class="col">
        <?= $content ?>
    </div>
</div>
<?php
$this->endBody() ?>
</body>
</html>
<?php
$this->endPage() ?>

