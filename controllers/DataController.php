<?php

namespace app\controllers;

use Yii;
use app\models\Data;
use app\models\DataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
/**
 * DataController implements the CRUD actions for Data model.
 */
class DataController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Data models.
     * @return mixed
     */
    
    
    public function actionLocation() {
        
        
        $query = new Query;
        /*
        if (isset($_GET['id']) && $_GET['id']) {
            switch ($_GET['id']) {
                case 'DEPARTAMENTO':
                        var_dump($_GET);
                        die;
                    $query->select('gid, iddpto, nombdep, SUM("PIA") as "PIA", SUM("PIM") as "PIM"')->from('data');
                    break;
                default:
                    $query->select('iddpto, SUM("PIA") as "PIA", SUM("PIM") as "PIM"')->from('data');
                    break;
            }
        }
        */
        $query->select(null)->from('data');
        
        foreach($_GET as $key => $value) {
            if ($key == 'by') {
                switch ($value) {
                    case 'DEPARTAMENTO':
                        $query->select('iddpto, nombdep,  SUM("PIA") as "PIA", SUM("PIM") as "PIM"')->from('data');
                        $query->addGroupBy(['iddpto', 'nombdep']);
                        break;
                    case 'PROVINCIA':
                        $query->select('idprov, nombprov,  SUM("PIA") as "PIA", SUM("PIM") as "PIM"')->from('data');
                        $query->addGroupBy(['idprov', 'nombprov']);
                        break;
                    default:
                        $query->select(null)->from('data');
                        break;
                } 
            }
            else {
                $val = explode(',', $value);
                $finalvalue = [];
                    foreach($val as $v) {
                        $finalvalue[] = $v;
                    }
                $query->andWhere([$key => $finalvalue]);    
            }
        }


        $data = $query->all();
        $items = ['values' => $data];
        \Yii::$app->response->format = 'json';
        return $items;
        
        return $this->render('index', [
            'items' => $items,
            'sort' => $sort,
            'pages' => $pages,
        ]); 

        // a location parameter is selected
        
        /*
        if (isset($_GET['id']) && $_GET['id']) {
            switch ($_GET['id']) {
                case ''
            }
            
            
        }
        else {

        }
        /*
    }
    
    public function actionIndex()
    {

        
        $query = new Query;
        $query->select(null)->from('data');


        
        foreach($_GET as $key => $value) {
                
            $val = explode(',', $value);
            $finalvalue = [];

                foreach($val as $v) {
                    $finalvalue[] = $v;
                }

            $query->andWhere([$key => $finalvalue]); 
        }
        $sum = $query->sum('"PIA"');
        $average = $query->average('"PIA"');

        $data = $query->all();
        
        
        
        
        $items = ['sum' => $sum, 'values' => $data];
        \Yii::$app->response->format = 'json';
        return $items;
        
        return $this->render('index', [
            'items' => $items,
            'sort' => $sort,
            'pages' => $pages,
        ]);       
        
        /*
        $searchModel = new DataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        */
    }

    /**
     * Displays a single Data model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Data model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Data();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->gid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Data model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->gid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Data model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Data model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Data the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Data::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
