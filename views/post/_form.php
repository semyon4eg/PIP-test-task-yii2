<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
// use dosamigos\multiselect\MultiSelect;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">
    <div class="row">
        <div class="col-10">
            <div class="post-form">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

            </div>
        </div>
        <div class="col">

            <h3>Categories</h3>

            <?= Html::activeCheckboxList($model, 'categoriesChosen', ArrayHelper::map($category, 'id', 'name'), ['separator'=>'<br/>']) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

