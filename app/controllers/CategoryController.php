<?php


namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Category;
use simFW\App;
use simFW\libs\Pagination;

class CategoryController extends AppController {

    public function viewAction() {
        $alias = $this->route['alias'];
        $category = \R::findOne('category', 'alias = ?', [$alias]);
        if (!$category) {
            throw new \Exception('Страница не найдена', 404);
        }

        // Хлебные крошки
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category->id);

        $cat_model = new Category();
        $ids = $cat_model->getIds($category->id);
        $ids = !$ids ? $category->id : $ids . $category->id;

        // Пагинация
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = App::$app->getProperty('pagination');
        $total = \R::count('product', "category_id IN ($ids)");
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        // Выборка товаров
        $products = \R::find('product', "category_id IN ($ids) LIMIT $start, $perpage");
        $this->setMeta($category->title, $category->description, $category->keywords);
        $this->set(compact('products', 'breadcrumbs', 'pagination', 'total'));
    }
}