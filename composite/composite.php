<?php

// Component interface
interface Component {
    public function display();
}

// Leaf class
class Leaf implements Component {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function display() {
        echo "Leaf: " . $this->name . "\n";
    }
}

// Composite class
class Composite implements Component {
    private $name;
    private $children = array();

    public function __construct($name) {
        $this->name = $name;
    }

    public function add(Component $component) {
        $this->children[] = $component;
    }

    public function display() {
        echo "Composite: " . $this->name . "\n";
        foreach ($this->children as $child) {
            $child->display();
        }
    }
}

$leaf1 = new Leaf("Leaf 1");
$leaf2 = new Leaf("Leaf 2");

$composite = new Composite("Composite");
$composite->add($leaf1);
$composite->add($leaf2);

$composite->display();
//https://softwarepatterns.com/php/composite-software-pattern-php-example
?>