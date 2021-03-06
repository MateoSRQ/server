<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PeruSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peru-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'gid') ?>

    <?= $form->field($model, 'objectid') ?>

    <?= $form->field($model, 'iddist') ?>

    <?= $form->field($model, 'iddpto') ?>

    <?= $form->field($model, 'idprov') ?>

    <?php // echo $form->field($model, 'nombdist') ?>

    <?php // echo $form->field($model, 'nombprov') ?>

    <?php // echo $form->field($model, 'nombdep') ?>

    <?php // echo $form->field($model, 'nom_cap') ?>

    <?php // echo $form->field($model, 'geom') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
