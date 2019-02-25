<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(Yii::$app->user->id === 1 || Yii::$app->user->id === $model->id ) { ?>
    <p>
        <?= Html::a('Actualizar perfil', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>
    <?php } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'created_at',
            'token',
            'email:email',
        ],
    ]) ?>

    <?php if(Yii::$app->user->id === 1 || Yii::$app->user->id === $model->id ) { ?>
    <p>
        <?= Html::a('Borrar Perfil', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro de que quieres borrar el perfil?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php } ?>
</div>
