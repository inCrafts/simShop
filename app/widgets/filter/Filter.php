<?php


namespace app\widgets\filter;

use simFW\Cache;

class Filter {

    public $groups;
    public $attrs;
    public $tpl;

    public function __construct() {

        $this->tpl = __DIR__ . '/filter_tpl.php';
        $this->run();
    }

    public function run() {

        $cache = Cache::instance();
        $this->groups = $cache->get('filter_group');
        if (!$this->groups) {
            $this->groups = $this->getGroups();
            $cache->set('filter_group', $this->groups, 3600);
        }
        $this->attrs = $cache->get('filter_attrs');
        if (!$this->attrs) {
            $this->attrs = $this->getAttrs();
            $cache->set('filter_attrs', $this->attrs, 3600);
        }
        echo $filters = $this->getHtml();
//        echo $filters;
    }

    protected function getHtml() {

        ob_start();
        require_once $this->tpl;
        return ob_get_clean();

    }

    protected function getGroups() {
        return \R::getAssoc('SELECT id, title FROM attribute_group');
    }

    protected function getAttrs() {
        $data = \R::getAssoc('SELECT * FROM attribute_value');
        $attrs = [];
        foreach ($data as $key => $val) {
            $attrs[$val['attr_group_id']][$key] =$val['value'];
        }
        return $attrs;
    }
}