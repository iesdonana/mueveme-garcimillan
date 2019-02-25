<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="noticias-view">

    <table border="0">
        <tr>
            <td>
                <table border="0">
                    <tr>
                        <th>
                            <p style="text-align: center"><?= Html::encode($model->votos) ?></p>
                        </th>
                    </tr>
                    <tr>
                        <th>votos</th>
                    </tr>
                </table>
            </td>
            <td>
                <table border="0">
                    <tr>
                        <td>
                            <h2><?= Html::a(Html::encode($model->titulo), Html::encode($model->url)); ?></h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><?= Html::encode($model->extracto) ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                             <p>Publicado por: <?= Html::encode($model->usuario) ?> el <?= Html::encode($model->created_at) ?></p> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                Categoría: <?= Html::encode($model->categoria->categoria) ?>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>
</div>
