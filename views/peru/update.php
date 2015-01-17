<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Peru */

$this->title = 'Update Peru: ' . ' ' . $model->gid;
$this->params['breadcrumbs'][] = ['label' => 'Perus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gid, 'url' => ['view', 'id' => $model->gid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="peru-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
