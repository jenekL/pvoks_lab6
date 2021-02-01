<?php

namespace app\services;

use app\models\Category;
use app\models\CategoryProduct;
use app\models\History;
use app\models\Product;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;

class HistoryService
{
    /**
     * Finds the History model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return History the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
        if (($model = History::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public static function getAllTimeStatistic($userId)
    {
        $userHistories = History::findAll(['user_id' => $userId]);
        $products = [];
        foreach ($userHistories as $userHistory) {
            $product = Product::findOne(['id' => $userHistory->product_id])->getCategory()->one();
            if (!array_key_exists($product->name, $products)) {
                $products[$product->name] = $userHistory->amount;
            } else {
                $products[$product->name] += $userHistory->amount;
            }
        }

        $allProductsAmount = array_sum(array_column($userHistories, 'amount'));

        foreach ($products as $key => $value) {
            $products[$key] = $value / $allProductsAmount * 100;
        }
        return $products;
    }

    public static function getCurrentStatistic()
    {
        $products = [];

        $existingCategories = Category::find()->all();

        foreach ($existingCategories as $category) {
            $productsByCategory = Product::findAll(['category_id' => $category->id]);
            if (empty($productsByCategory)) {
                continue;
            }
            $products[$category->name] = sizeof($productsByCategory);
        }

        $totalAmount = array_sum(array_values($products));

        foreach ($products as $k => $v) {
            $products[$k] = $v / $totalAmount * 100;
        }

        return $products;
    }

    public static function getSortedProducts()
    {
        $sortedProducts = [];

        $existingCategories = Category::find()->all();

        $currentStatistic = self::getCurrentStatistic();

        foreach ($existingCategories as $category) {
            $productsByCategory = Product::findAll(['category_id' => $category->id]);
            if (empty($productsByCategory)) {
                continue;
            }
            $percent = number_format( $currentStatistic[$category->name], 0, '', '' );
            $categoryProduct = new CategoryProduct();
            $categoryProduct->setCategory([$percent => $category]);
            $categoryProduct->setProducts($productsByCategory);
            $sortedProducts[] = $categoryProduct;
        }

        $provider = new ArrayDataProvider([
            'allModels' => $sortedProducts,
        ]);

        return $provider;
    }
}