<?php

namespace app\controllers;

use app\models\Product;
use app\services\HistoryService;
use Yii;
use app\models\History;
use app\models\HistorySearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HistoryController implements the CRUD actions for History model.
 */
class HistoryController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all History models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HistorySearch();
        $searchModel->user_id = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $products = HistoryService::getAllTimeStatistic(1);

//        $query = History::find()
//            //->innerJoin('products', 'histories.product_id = products.id')
//            //->innerJoin('categories', 'products.category_id = categories.id')
//            ->select('id AS categoryName, COUNT(*) AS amount')
//            ->groupBy('categoryName');
//        $pieDataProvider1 = new ActiveDataProvider([
//            'query' => $query,
//            'pagination' => false
//        ]);
//
//        var_dump($pieDataProvider1->getModels());
//
//        $pieDataProvider = new ActiveDataProvider([
//            'query' => $query,
//            'pagination' => false
//        ]);
//
//        //$pieDataProvider1 = $searchModel->search(Yii::$app->request->queryParams);


        $sortedProducts = HistoryService::getSortedProducts();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $products,
            'sortedByCategory' => $sortedProducts
            //'pieDataProvider' => $pieDataProvider,
        ]);
    }

    /**
     * Displays a single History model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => HistoryService::findModel($id),
        ]);
    }

    /**
     * Creates a new History model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new History();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing History model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = HistoryService::findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing History model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        HistoryService::findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
