<?php
namespace app\controllers;

use yii\rest\ActiveController;

/**
 * Class PostrestController
 * @package app\controllers
 */
class PostrestController extends ActiveController
{
	/**
	 * Model class implemented as REST.
     * @var string
     */
    public $modelClass = 'app\models\Post';

    /**
     * Replaces original CreateAction class with an improved one.
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        $actions['create']['class'] = 'app\actions\postrest\CreateAction';
        return $actions;
    }
}
