<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Peru */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peru-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'objectid')->textInput() ?>

    <?= $form->field($model, 'iddist')->textInput(['maxlength' => 8]) ?>

    <?= $form->field($model, 'iddpto')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'idprov')->textInput(['maxlength' => 4]) ?>

    <?= $form->field($model, 'nombdist')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'nombprov')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'nombdep')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'nom_cap')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'geom')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
