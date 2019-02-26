<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VotacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Votaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="votaciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Votaciones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->usuario_id), ['view', 'usuario_id' => $model->usuario_id, 'noticia_id' => $model->noticia_id]);
        },
    ]) ?>
</div>
