<?php
require 'vendor/autoload.php';

$settings = require 'toubilib_skeletton/app/config/settings.php';
$services = require 'toubilib_skeletton/app/config/services.php';

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