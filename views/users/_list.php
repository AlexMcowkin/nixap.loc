<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use rmrevin\yii\fontawesome\FA;
?>

<?php Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered'
    ],
    'layout'=>"{pager}\n{summary}\n{items}",
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'child_name',
        [
           'label' => 'Count Ancestors',
           'format' => 'text',
           'value' => function ($model) {
              $cnt = $model->countUserParents($model->id);
              return \Yii::t('app', '{a, spellout} {n, plural, one{ancestor} other{ancestors}}', ['a' => $cnt, 'n' => $cnt]);
           }
        ],
        'parent_name',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'headerOptions' => ['width' => '180'],
            'buttons' => [
                'update' => function ($url) {
                    return Html::a(FA::i('pencil'), $url, ['style'=>'margin-left:10px;', 'title'=>'update']);
                },
                'delete' => function ($url) {
                    return Html::a(FA::i('trash'), $url, [
                        'data-confirm' => 'Are you sure want to delete this record?',
                        'data-method' => 'post',
                        'style'=>'margin-left:10px;',
                        'title'=>'delete',
                    ]);
                },
                'addparent' => function ($url, $model) {
                    if(!$model->checkIfHasGrandfather($model->id))
                        return Html::a(FA::i('plus'), $url, ['style'=>'margin-left:10px;', 'title'=>'add parent']);
                    return;
                },
                'viewparent' => function ($url) {
                    return Html::a(FA::i('eye'), $url, ['style'=>'margin-left:10px;', 'title'=>'view parents']);
                },
                'addchild' => function ($url, $model) {
                    if($model->checkIfHasGrandson($model->id))
                        return Html::a(FA::i('plus-square-o '), $url, ['style'=>'margin-left:10px;', 'title'=>'add child']);
                    return;
                },
                'viewchild' => function ($url) {
                    return Html::a(FA::i('eye-slash'), $url, ['style'=>'margin-left:10px;', 'title'=>'view child']);
                },
            ],
            'template' =>'{update}{delete} | {addparent}{viewparent} | {addchild}{viewchild}',
        ],
    ],
]); ?>
<?php Pjax::end(); ?>