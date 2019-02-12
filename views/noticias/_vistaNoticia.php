<?php

use yii\helpers\Html;

?>
<table border="0">
    <tr>
        <th class="col-md-1">
            <p style="text-align: center; bottom: 0px">Votos</p>
        </th>
        <th class="col-md-11">
            <h2><?= Html::a(Html::encode($model->titulo), ['noticias/view', 'id' => $model->id]); ?></h2>
        </th>
    </tr>
    <tr>
        <td class="col-md-1">
            <p style="text-align: center; top: 0px"><?= Html::encode($model->votos) ?></p>
        </td>
        <td class="col-md-11">
            <p><?= Html::encode($model->extracto) ?></p>
        </td>
    </tr>
    <tr>
        <td class="col-md-1"></td>
        <td class="col-md-11">
            <p><?= Html::encode($model->categoria->categoria) ?></p>
        </td>
    </tr>
</table>
