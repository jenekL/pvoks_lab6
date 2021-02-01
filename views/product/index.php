<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create', 'user_id' => 1], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'amount',
            [
                'attribute' => 'categoryName',
                'label' => 'Имя категории',
                'value' => function ($d) {
                    return $d->getCategory()->one()->name;
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'product',
            ],
        ],
    ]); ?>


</div>
