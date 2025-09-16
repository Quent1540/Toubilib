<?php
require __DIR__ . '/../vendor/autoload.php';

$settings = require __DIR__ . '/app/config/settings.php';
$services = require __DIR__ . '/app/config/services.php';

$container = new class($settings, $services) {
    private $settings;
    private $factories;
    private $instances = [];
    public function __construct($settings, $factories) {
        $this->settings = $settings;
        $this->factories = $factories;
        $this->instances['settings'] = $settings;
    }
    public function get($id) {
        if (isset($this->instances[$id])) return $this->instances[$id];
        if (isset($this->factories[$id])) {
            $this->instances[$id] = $this->factories[$id]($this);
            return $this->instances[$id];
        }
        throw new Exception("Service $id not found");
    }
};

$servicePraticien = $container->get('servicePraticien');

$praticiens = $servicePraticien->listerPraticiens();
var_dump($praticiens);