<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeruSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peru-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Peru', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'gid',
            'objectid',
            'iddist',
            'iddpto',
            'idprov',
            // 'nombdist',
            // 'nombprov',
            // 'nombdep',
            // 'nom_cap',
            // 'geom',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
