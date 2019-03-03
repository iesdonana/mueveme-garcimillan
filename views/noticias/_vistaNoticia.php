<?php

use yii\helpers\Html;
use yii\helpers\Url;

if (!Yii::$app->user->isGuest) {
    $url = Url::to(['noticias/votar']);
    $usuario_id = Yii::$app->user->identity->id;
    $js = <<<EOF
    $('button[data-noticia]').click(function(e){
        e.preventDefault();
        let noticia_id = $(this).data('noticia');
        let contador = $(this).data('contador');
        $.ajax({
            method: 'GET',
            url: '$url',
            data: {noticia_id: noticia_id, usuario_id: $usuario_id},
            success: function(result){
                if (result) {
                    let x = parseInt($("#votos" + noticia_id).text())+1;
                    $("#votos" + noticia_id).html(x);
                }else {
                    alert('No se puede votar la noticia mas de una vez!');
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
            <button class='btn btn-primary' data-noticia="<?= $model->id ?>">Votar</button>
        </td>
        <td>
            <p><?= Html::encode($model->extracto) ?></p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="text-align: center" id="votos<?= $model->id ?>"><?= Html::encode($model->votos) ?></p>
        </td>
        <td>
            <p class="tag"><?= Html::encode($model->categoria->categoria) ?></p>
        </td>
    </tr>
</table>
