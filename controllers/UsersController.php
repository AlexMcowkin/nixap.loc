<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Users::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionAddparent($id)
    {
        $model = new Users();
        $parent = $this->findModel($id);
        $model->child_name = $parent->parent_name;
        $model->child_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('addparent', [
                'model' => $model,
            ]);
        }
    }

    public function actionAddchild($id)
    {
        $model = new Users();
        $parent = $this->findModel($id);
        $model->parent_name = $parent->child_name;
        $model->parent_id = $id;

        $model->hidden = 'addchild';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('addchild', [
                'model' => $model,
            ]);
        }
    }

    public function actionViewparent($id)
    {
        $user = $this->findModel($id);
        $model = new Users();
        $ancestors = $model->buildUserParentsTree($id);

        return $this->render('viewparent', [
            'user' => $user,
            'ancestors' => $ancestors,
        ]);
    }

    public function actionViewchild($id)
    {
        $user = $this->findModel($id);
        $model = new Users();
        $descendants = $model->buildUserChildTree($id);

        return $this->render('viewchild', [
            'user' => $user,
            'descendants' => $descendants,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
