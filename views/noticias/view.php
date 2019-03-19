<?php

use app\models\Comentarios;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
    <?php
      $newCom = new Comentarios();
      $newCom->noticia_id = $model->id;
      $newCom->usuario_id = Yii::$app->user->id;

      $formCom = ActiveForm::begin([
        'method' => 'POST',
        'action' => Url::to(['comentarios/create']),
      ]);
    ?>
    <?= $formCom->field($newCom, 'opinion') ?>
    <?= $formCom->field($newCom, 'noticia_id')->hiddenInput()->label(false); ?>
    <?= $formCom->field($newCom, 'usuario_id')->hiddenInput()->label(false); ?>
    <?= Html::submitButton('Enviar'); ?>
    <?php $formCom->end(); ?>
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
                <a type="button" data-toggle="modal" data-target="#exampleModal">
                  Responder
                </a>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Respuesta:</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <?php
                          $com = new Comentarios();
                          $com->noticia_id = $model->id;
                          $com->usuario_id = Yii::$app->user->id;
                          $com->padre_id = $comentario->id;

                          $formCom = ActiveForm::begin([
                            'method' => 'POST',
                            'action' => Url::to(['comentarios/create']),
                          ]);
                        ?>
                        <div class="modal-body">
                          <?= $formCom->field($com, 'opinion')->textarea(); ?>
                          <?= $formCom->field($com, 'noticia_id')->hiddenInput()->label(false); ?>
                          <?= $formCom->field($com, 'usuario_id')->hiddenInput()->label(false); ?>
                          <?= $formCom->field($com, 'padre_id')->hiddenInput()->label(false); ?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                        <?php $formCom->end(); ?>
                      </div>
                  </div>
                </div>
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
                    <?= $comentario2->usuario->nombre ?> responde:
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
