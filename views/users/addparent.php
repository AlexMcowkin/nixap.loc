<?php

use yii\helpers\Html;

$this->title = 'Add Parent for ' . $model->child_name;
$this->params['breadcrumbs'][] = 'Add Parent';
?>
<div class="users-update">

    <h3><?= Html::encode($this->title) ?></h3>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
