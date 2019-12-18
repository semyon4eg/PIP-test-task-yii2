<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
// use yii\bootstrap\Nav;
// use yii\bootstrap\NavBar;
// use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
    <div class="wrapper">
    <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="<?= Url::to(['site/index']) ?>">Semyon4eg's personal blog</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= Url::to(['site/index']) ?>">Home<span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <?php if(!Yii::$app->user->isGuest): ?>
                             <li class="nav-item">
                                <a class="nav-link" href="<?= Url::to(['post/index']) ?>">Posts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= Url::to(['category/index']) ?>">Categories</a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link" href="<?= Url::current(['parse' => true]); ?>">MOAR posts for postGod</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= Url::to(['/site/logout']) ?>"><?= Yii::$app->user->identity->username?> (Logout)</a>
                            </li>
                        <?php endif ?>
                        <?php if(Yii::$app->user->isGuest): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= Url::to(['/site/login']) ?>">Login</a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </nav>

    <?= $content ?>

    </div>
    <!-- /.wrapper -->
<!-- Footer -->
<footer class="py-5 bg-dark footer page-footer">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Semyon4eg <?= date('Y') ?></p>
        </div>
    <!-- /.container -->
</footer>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>