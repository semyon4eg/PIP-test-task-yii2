<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\CategoryMenuWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
    <div class="post-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= CategoryMenuWidget::widget([
            'model' => $model,
            'tpl' => 'horizon',
        ]) ?>
        <br />

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'title',
                'body:ntext',
            ],
        ]) ?>
    </div>
</div>
