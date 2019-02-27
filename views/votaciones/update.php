<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Votaciones */

$this->title = 'Update Votaciones: ' . $model->usuario_id;
$this->params['breadcrumbs'][] = ['label' => 'Votaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->usuario_id, 'url' => ['view', 'usuario_id' => $model->usuario_id, 'noticia_id' => $model->noticia_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="votaciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
