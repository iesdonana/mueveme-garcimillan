<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Votaciones */

$this->title = 'Create Votaciones';
$this->params['breadcrumbs'][] = ['label' => 'Votaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="votaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
