<?php

namespace app\queue;

use Yii;
use yii\base\BootstrapInterface;
use app\queue\ParserJob;


class ParserBootstrapper implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Yii::$app->queue->push(new ParserJob());
    }
}