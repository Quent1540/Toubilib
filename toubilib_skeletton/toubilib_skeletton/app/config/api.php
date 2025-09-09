<?php
use src\api\actions\getAllPraticiensAction;

return [
    'getAllPraticiensAction' => function($container) {
        return new getAllPraticiensAction($container->get('servicePraticien'));
    },
];