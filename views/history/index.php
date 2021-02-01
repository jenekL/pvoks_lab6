<?php

use yii\helpers\Html;
use yii\grid\GridView;
use sjaakp\gcharts\PieChart;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $pieDataProvider yii\data\ActiveDataProvider */
/* @var $data array */
/* @var $sortedByCategory */

$this->title = 'Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-index">

    <h1><?= 'Ваша статистика за все время' ?></h1>

    <?= DetailView::widget([
        'model' => $data,
        'template' => "<tr><th style='width: 15%;'>{label}</th><td>{value} %</td></tr>"
    ]) ?>

    <h1><?= 'Текущие дела в холодильнике' ?></h1>

    <?= GridView::widget([
        'dataProvider' => $sortedByCategory,
        'columns' => [
            [
                'attribute' => 'categoryName',
                'label' => 'Имя категории',
                'value' => function ($d) {
                    $result = '';
                    $categoryArray = $d->getCategory();
                    foreach ($categoryArray as $item => $value) {
                        $categoryName = $value->name;
                        $result .= "$categoryName ($item %)";
                    }
                    return $result;
                },
                'contentOptions' => ['style' => 'width: 15%;'],
            ],
            [
                'attribute' => 'products',
                'format' => 'html',
                'label' => 'Продукты',
                'value' => function ($d) {
                    $result = '<table style="width: 100%"><colgroup>
                                                          <col span="1" style="width: 10%;">
                                                          <col span="1" style="width: 50%;">
                                                          </colgroup>
                                                          <thead>
                                                          <tr><th>Наименование</th><th>Кол-во</th></tr>
</thead><tbody>';
                    $products = $d->getProducts();
                    foreach ($products as $product) {
                        $result .= '<tr><td>' . $product->name . '</td><td>' . $product->amount . '</td></tr>';
                    }
                    $result .= '</tbody></table>';
                    return $result;
                },
                'contentOptions' => ['style' => 'width: 40%;'],
            ],
        ],
    ]) ?>

</div>
