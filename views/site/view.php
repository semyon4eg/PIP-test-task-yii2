<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<div class="container">
	<div class="row">
        <div class="col">
            <div class="col-lg-8 col-md-10 mx-auto">
          		<div class="post-heading">
                	<h2><?= Html::encode($model->title) ?></h2>
                </div>
        	</div>
    	</div>
	</div>
</div>

<hr>

<article>
    <div class="container">
      	<div class="row">
        	<div class="col-lg-8 col-md-10 mx-auto">
                <p><?= HtmlPurifier::process($model->body) ?></p>
            </div>
        </div>
    </div>
</article>

<hr>