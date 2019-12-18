<?php

namespace app\components;

use app\models\Post;
use yii\base\Widget;
use app\models\Category;

/**
 * This is the class for category menu widget.
 *
 * @property string $tpl
 * @property Category[] $data
 * @property Post $model
 */
class CategoryMenuWidget extends Widget
{
    /**
     * @var string name of a widget template to use for display: list-type or horizontal.
     */
    public $tpl;
    /**
     * @var array that represents categories list.
     */
    public $data;
    /**
     * @var post-model for which to show a horizontal type of widget in detailed view.
     */
    public $model;

    /**
     *  Used to choose template type to display a widget.
     */
    public function init()
    {
        parent::init();
        if($this->tpl === null){
            $this->tpl = 'list';
        }
        $this->tpl .= '.php';
    }

    /**
     * Loads a template for a widget and populates it with appropriate data.
     * @return false|string
     */
    public function run(){
        $this->data = Category::find()->indexBy('id')->all();
        ob_start();
        include __DIR__ . '/category_menu_tpls/' . $this->tpl;
        return ob_get_clean();
    }
}