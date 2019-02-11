<?php

use yii\helpers\Html;

?>

<div class="col-md-12">

    <table>
        <tr>
            <th class="col-md-1">
                <p style="text-align: center">Votos</p>
            </th>
            <th class="col-md-11">
                <h2><?= Html::a(Html::encode($model->titulo), ['noticias/view', 'id' => $model->id]); ?></h2>
            </th>
        </tr>
        <tr>
            <td class="col-md-1">
                <p><?= Html::encode($model->votos) ?></p>
            </td>
            <td class="col-md-11">
                <p class="col-md-8"><?= Html::encode($model->extracto) ?></p>
            </td>
        </tr>
    </table>
</div>
