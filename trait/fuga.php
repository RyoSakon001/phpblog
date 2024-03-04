<?php
// 参考になった
// https://qiita.com/khsk/items/086ca7a0c9e06b46d0c5

include_once 'hoge.php';

class Fuga {
    use Hoge;
    public function sayFuga() {
        echo 'Fuga';
    }
    public function sayFugaHoge() {
        $this->sayHoge();
    }
}

$fuga = new Fuga();
$fuga->sayHoge();
$fuga->sayFugaHoge();