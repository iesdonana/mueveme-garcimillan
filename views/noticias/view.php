<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="noticias-view">

    <table border="0">
        <tr>
            <th><?= Html::encode($model->votos) ?></th>
            <th><?= Html::encode($model->titulo) ?></th>
        </tr>
        <tr>
            <td><?= Html::encode($model->titulo) ?></td>
        </tr>
    </table>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'titulo',
            'votos',
            'extracto:ntext',
            'url:ntext',
            'categoria_id',
            'usuario_id',
            'created_at',
        ],
    ]) ?>

</div>
