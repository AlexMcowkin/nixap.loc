<?php

use yii\helpers\Html;

$this->title = 'Add Child for: ' . $model->parent_name;
$this->params['breadcrumbs'][] = 'Add Child';
?>
<div class="users-update">

    <h3><?= Html::encode($this->title) ?></h3>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
