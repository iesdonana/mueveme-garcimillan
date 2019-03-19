<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Comentarios;


foreach ($comentarios as $comentarioId => $comentario) {
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
          <div>
            <span>
              <a type="button" data-toggle="modal" data-target="#exampleModal">
                Responder
              </a>
            </span>
              <?= Html::a('Borrar', ['comentarios/delete', 'id' => $comentario->id], [
                'data' => [
                'confirm' => '¿Estas seguro de que quieres borrar el comentario?',
                'method' => 'post',
              ],
              ]) ?>
            <span>
            </span>
          </div>
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
                    $com->noticia_id = $comentario->noticia_id;
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
  <?php foreach ($comentarios as $comentarioId2 => $comentario2){
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
