<?php

namespace app\controllers;

use Yii;
use app\models\Data;
use app\models\DataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\filters\PageCache;
use yii\caching\DbDependency;
/**
 * DataController implements the CRUD actions for Data model.
 */


 
 
class DataController extends Controller
{
    public $layout = 'json';
    

    public function behaviors()
    {
        return [
            /*
            'pageCache' => [
                'class' => 'yii\filters\PageCache',
                //'only' => ['location'],
                'duration' => 60,

                'variations' => [
                    \Yii::$app->language,
                    $_GET
                ]
            ],
            */
            [
                'class' => 'yii\filters\HttpCache',
                //'only' => ['location'],
                'etagSeed' => function ($action, $params) {
                    return serialize(date('Y-m-d:H'));
                },

            ],
        ];
    }

    

    public function actionLocation() {
        
        
        
        
        $query = new Query;
        $query->select(null)->from('data');
        
        $axis = null;        
        
        foreach($_GET as $key => $value) {
            if ($key == 'by') {
                switch ($value) {
                    case 'DEPARTAMENTO':
                        $query->select('data.iddpto, data.nombdep, ST_AsGEOJSON("geom") as geometry, SUM("PIA") as "PIA", SUM("PIM") as "PIM"')->from('data');
                        $query->addGroupBy(['data.iddpto', 'data.nombdep', 'geom']);
                        $query->join('INNER JOIN','departamentos','data.iddpto = departamentos.first_iddp');
                        $axis = 'DEPARTAMENTO';
                        break;
                    case 'PROVINCIA':
                        $query->select('data.idprov, data.nombprov, ST_AsGEOJSON("geom") as geometry,  SUM("PIA") as "PIA", SUM("PIM") as "PIM"')->from('data');
                        $query->addGroupBy(['data.idprov', 'data.nombprov', 'geom']);
                        $query->join('INNER JOIN','provincias','data.idprov = provincias.first_idpr');
                        $axis = 'PROVINCIA';
                        break;
                    default:
                        $query->select('data.iddist, data.nombdist, ST_AsGEOJSON("geom") as geometry,  SUM("PIA") as "PIA", SUM("PIM") as "PIM"')->from('data');
                        $query->addGroupBy(['data.iddist', 'data.nombdist', 'geom']);
                        $query->join('INNER JOIN','distritos','data.iddist = distritos.iddist');
                        $axis = 'DISTRITO';
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
        $result = [];
        foreach ($data as $datum) {
            $r['properties']['type']   = 'Feature';

            $r['properties']['pia' ]   = $datum['PIA'];
            $r['properties']['pim']    = $datum['PIM'];
            switch ($axis) {
                case 'DEPARTAMENTO':
                    $r['properties']['id']     = $datum['iddpto'];
                    $r['properties']['nombre'] = $datum['nombdep'];
                    break;
                case 'PROVINCIA':
                    $r['properties']['id']     = $datum['idprov'];
                    $r['properties']['nombre'] = $datum['nombprov'];
                    break;
                default:
                    $r['properties']['id']     = $datum['iddist'];
                    $r['properties']['nombre'] = $datum['nombdist'];                    
                    break;
            }
            $r['geometry']              = json_decode($datum['geometry']);
            $result[] = $r;
        }
        
        $items = [
            'type'      =>  'FeatureCollection',       
            'crs'       =>  ['type' => 'name', 'properties' => [ 'name' => 'urn:ogc:def:crs:EPSG::3857']],
            'features'  =>  $result
        ];
        
        $items = json_encode($items);
        //echo $items;
        
        
        //return $items;
        //Yii::$app->response->format = 'json';
        $items = (\yii\helpers\Json::encode($items, JSON_UNESCAPED_SLASHES ));
        //return $items;
        return $this->renderPartial('index', ['items' => $items]);
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
