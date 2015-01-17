<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Data', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'periodo',
            // 'PIA',
            // 'PIM',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
