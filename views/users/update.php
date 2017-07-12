<?php

use yii\helpers\Html;

$this->title = 'Update Users: ' . $model->child_name;
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-update">

    <h3><?= Html::encode($this->title) ?></h3>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
