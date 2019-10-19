<?php


namespace app\controllers;


use mysql_xdevapi\Exception;

class ProductController extends AppController {

    public function viewAction() {

        $alias = $this->route['alias'];
        $product = \R::findOne('product', "alias = ? AND status = '1'", [$alias]);
        if (!$product) {
            throw new \Exception('Страница не найдена', 404);
        }

//        Хлебные крошки


//        Связанные товары

//        Просмотренные товары(запись в куки)

//        Просмотренные товары

//        Галерея

//        Модификации товаров

        $this->setMeta($product->title, $product->description, $product->keywords);
        $this->set(compact('product'));

    }

}