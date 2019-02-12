<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NoticiasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Noticias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticias-index">

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Noticias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_vistaNoticia',
    ]) ?>
</div>
