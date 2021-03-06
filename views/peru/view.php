<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Peru */

$this->title = $model->gid;
$this->params['breadcrumbs'][] = ['label' => 'Perus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peru-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->gid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->gid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gid',
            'objectid',
            'iddist',
            'iddpto',
            'idprov',
            'nombdist',
            'nombprov',
            'nombdep',
            'nom_cap',
            'geom',
        ],
    ]) ?>

</div>
