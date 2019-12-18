<?php
namespace app\actions\postrest;

use Yii;
use yii\rest\Action;
use yii\base\Model;
use app\models\Category;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;

/**
 * Class CreateAction replaces original one to enable dynamic post-category linking via junction table.
 * @package app\actions\postrest
 */
class CreateAction extends Action
{
    /**
     * @var string the scenario to be assigned to the new model before it is validated and saved.
     */
    public $scenario = Model::SCENARIO_DEFAULT;
    /**
     * @var string the name of the view action. This property is needed to create the URL when the model is successfully created.
     */
    public $viewAction = 'view';


    /**
     * Creates a new model.
     * @return \yii\db\ActiveRecordInterface the model newly created
     * @throws ServerErrorHttpException if there is any error when creating the model
     */
    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        /* @var $model \yii\db\ActiveRecord */
        $model = new $this->modelClass([
            'scenario' => $this->scenario,
        ]);
        //Getting all categories and making an array of their names.
        $categoriesBase = Category::find()->select('name')->asArray()->all();
        $cats = [];
        foreach ($categoriesBase as $cat) {
            $cats[] = $cat['name'];
        }
        //Receiving REST POST request body params with new post-model data.
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        //Checking whether categories are already in the base and writing them if not.
        $categoriesArray = [];
        $categories = $model->categoriesChosen;
        if (!empty($categories)) {
            foreach ($categories as $category) {
                if (!in_array($category, $cats, true)) {
                    $cat = new Category();
                    $cat->name = $category;
                    $cat->save();
                    $cats[] = $cat->name;
                    $categoriesArray[] = $cat->id;
                } else {
                    $cat = Category::find()->where(['name' => $category])->one();
                    $categoriesArray[] = $cat->id;
                }
            }
        }
        //Linking new post-models with appropriate categories if any.
        $model->categoriesChosen = $categoriesArray;
        if ($model->save()) {
            foreach ($model->categoriesChosen as $key => $value) {
                $model->link('categories', Category::findOne($value));
            };
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute([$this->viewAction, 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        return $model;
    }
}
