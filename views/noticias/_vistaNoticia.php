<?php

use yii\helpers\Html;

?>
<table border="0">
    <tr>
        <th>
            <p style="text-align: center">Votos</p>
        </th>
        <th>
            <h2><?= Html::a(Html::encode($model->titulo), ['noticias/view', 'id' => $model->id]); ?></h2>
        </th>
    </tr>
    <tr>
        <td><?= Html::a('Votar', ['noticias/votar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?></td>
        <td>
            <p><?= Html::encode($model->extracto) ?></p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="text-align: center"><?= Html::encode($model->votos) ?></p>
        </td>
        <td>
            <p><?= Html::encode($model->categoria->categoria) ?></p>
        </td>
    </tr>
</table>
