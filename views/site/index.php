<?php

/* @var $this yii\web\View */

use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Post;
use app\components\CategoryMenuWidget;
use app\queue\ParserJob;
// use yii\queue\Queue;

$this->title = 'My personal blog';
?>
  <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    $parse = Yii::$app->request->get('parse');
                    if ($parse == true) {
                        Yii::$app->queue->push(new ParserJob());
                    }

                    $category = Yii::$app->request->get('category');
                    if (!empty($category)) {
                        $dataProvider = new ActiveDataProvider([
                            'query' => Post::find()->joinWith('postCategories')->where(['post_category.category_id' => $category])->orderBy('id DESC'),
                            'pagination' => [
                                'pageSize' => 5,
                            ],
                        ]);
                    } else {
                        $dataProvider = new ActiveDataProvider([
                            'query' => Post::find()->orderBy('id DESC'),
                            'pagination' => [
                                'pageSize' => 5,
                            ],
                        ]);
                    }
                ?>

                <?php Pjax::begin(); ?>
                    <?= ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemView' => '_post',
                        ]);
                    ?>
                <?php Pjax::end(); ?>
            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4 list-widget">

                <?= CategoryMenuWidget::widget() ?>

            </div>

        </div>
        <!-- /.row -->

    </div>
  <!-- /.container -->
