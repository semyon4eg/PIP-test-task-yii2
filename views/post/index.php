<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider;
use app\models\Post;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="post-index">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>
<!--     <?php echo $this->render('_search', ['model' => $searchModel]); ?> -->

        <?php
             $newDataProvider = new ActiveDataProvider([
                'query' => Post::find(),
                'pagination' => [
                    'pageSize' => 25,
                ],
                'sort' => [
                    'defaultOrder' => [
                        'id' => SORT_DESC,
                    ]
                ],
            ]);
        ?>

        <?= ListView::widget([
            'dataProvider' => $newDataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                return Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
            },
        ]) ?>

        <?php Pjax::end(); ?>
    </div>
</div>
