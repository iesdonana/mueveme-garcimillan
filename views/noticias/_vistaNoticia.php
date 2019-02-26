<?php

use yii\helpers\Html;
use yii\helpers\Url;

if (!Yii::$app->user->isGuest) {
    $url = Url::to(['noticias/votar']);
    $usuario_id = Yii::$app->user->identity->id;
    $js = <<<EOF
    $('#botonVotar').click(function(e){
        e.preventDefault();
        let noticia_id = $(this).data('noticia');
        let contador = $(this).data('contador');
        $.ajax({
            method: 'GET',
            url: '$url',
            data: {usuario_id: $usuario_id, noticia_id: noticia_id, contador: contador},
            success: function(result){
                if (result > contador) {
                    $("#numeroVotos").html(result);
                }else {
                    alert('No se puede votar la pelicula mas de una vez!');
                }
            }
        });
    });
EOF;
    $this->registerJs($js);
}
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
        <td>
            <button id="botonVotar" class='btn btn-primary' data-noticia="<?= $model->id ?>">Votar</button>
        </td>
        <td>
            <p><?= Html::encode($model->extracto) ?></p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="text-align: center" id="numeroVotos"><?= Html::encode($model->votos) ?></p>
        </td>
        <td>
            <p><?= Html::encode($model->categoria->categoria) ?></p>
        </td>
    </tr>
</table>
