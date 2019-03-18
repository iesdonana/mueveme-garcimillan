<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

// $url = Url::to(['noticias/comentar']);
// $js = <<<EOF
// $("#newCom button").on('click', function(){
//     var cuerpoComentario = $("#newCom textarea").val();
//     $.ajax({
//         method: 'GET',
//         url: '$url',
//         data: {textoCom: cuerpoComentario, noticia_id: $model->id},
//         success: function(data){
//             if (data) {
//                 alert("comentado con exito"+data);
//             }else {
//                 alert('ERROR: comentario fallido!');
//             }
//         }
//     });
// });
// EOF;
$this->registerJs($js);
?>
<style media="screen">
    #comentariosTodos, .comentario {
      background-color: rgb(44, 117, 234, 0.2);
      padding: 10px;
    }

    #newCom textarea{
      resize: none;
      display: inline-block;
    }

    #newCom p{
      background-color: rgb(44, 117, 234, 0.2);
      padding: 5px;
      display: inline-block;
    }

    .comentario{
        padding: 10px;
        width: 100%;
    }

    .comentario th, .respuesta th{
        padding: 5px;
    }

    .comentarioTiempo{
        position: absolute;
        right: 25px
    }

    .comentarioTexto{
        padding: 10px;
        width: 100%
    }

    .respuesta table{
        width: 98%;
        position: relative;
        left: 2%;
    }
</style>

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
                            <h2><?= Html::a(Html::encode($model->titulo),
                            Html::encode($model->url)); ?></h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><?= Html::encode($model->extracto) ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                             <p>Publicado por:
                                 <?= Html::encode($model->usuario->nombre) ?>
                                  el <?= Html::encode($model->created_at) ?></p>
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

    <?php if(Yii::$app->user->id === 1 || Yii::$app->user->id === $model->usuario->id ) { ?>

    <p>
        <?= Html::a('Borrar noticia', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro de que quieres borrar la noticia?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Actualizar Noticia', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php } ?>
</div>

<br><br>

<div id="comentariosTodos" class="col-md-8">
  <div id="newCom">
    <p>Envía un comentario</p>
    </br>
    <textarea name="textoCom" rows="4" cols="80"></textarea>
    </br>
    <?php
    
     ?>
  </div>
    <br><br>
  <div>
    <?php foreach ($model->comentarios as $comentarioId => $comentario) {
        if($comentario->padre_id === null){
        ?>
            <table class="comentario" border="0">
                <tr>
                    <th>
                        <?= $comentario->usuario->nombre ?> dice:
                    </th>
                </tr>
                <tr>
                    <td class="comentarioTexto">
                        <?= $comentario->opinion ?>
                        <span class="comentarioTiempo"><?= Yii::$app->formatter->asRelativeTime($comentario->created_at) ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= Html::a("Responder") ?>
                    </td>
                </tr>
            </table>
        <?php } ?>
        <?php foreach ($model->comentarios as $comentarioId2 => $comentario2){
            if($comentario->id == $comentario2->padre_id && $comentario->id != $comentario2->id){ ?>
                <span class="respuesta">
                    <table border="0">
                        <tr>
                            <th>
                                <?= $comentario2->usuario->nombre ?> dice:
                            </th>
                        </tr>
                        <tr>
                            <td class="comentarioTexto">
                                <?= $comentario2->opinion ?>
                                <span class="comentarioTiempo"><?= Yii::$app->formatter->asRelativeTime($comentario2->created_at) ?></span>
                            </td>
                        </tr>
                    </table>
                </span>
        <?php }
        } ?>
        <?php } ?>
  </div>
</div>
