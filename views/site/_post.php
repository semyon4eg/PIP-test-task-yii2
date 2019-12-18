<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<!-- Blog Post -->
<div class="card mb-4">
<!--       <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap"> -->
    <div class="card-body">
        <h5 class="card-title"><?= Html::encode($model->title) ?></h5>
        <!-- <p class="card-text"><?= HtmlPurifier::process($model->body) ?></p> -->
        <a href="<?= yii\helpers\Url::to(['site/view', 'id' => $model->id, 'slug' => $model->slug]) ?>" class="btn btn-primary">Read More &rarr;</a>
    </div>
    <div class="card-footer text-muted">
        Posted on <?= Yii::$app->formatter->asDate($model->created_at, 'long') ?> by
        <a href="#">Author</a>
    </div>
</div>