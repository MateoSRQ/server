<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Peru */

$this->title = 'Create Peru';
$this->params['breadcrumbs'][] = ['label' => 'Perus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peru-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
