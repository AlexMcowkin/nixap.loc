<?php

use yii\helpers\Html;

$this->title = 'Create Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h3><?= Html::encode($this->title) ?></h3>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
