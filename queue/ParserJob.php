<?php
namespace app\queue;

use yii\base\BaseObject;
use yii\queue\JobInterface;

class ParserJob extends BaseObject implements JobInterface
{
    
    public function execute($queue)
    {
        require __DIR__ . '/../parser.php';
    }

}