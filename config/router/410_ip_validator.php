<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Style chooser.",
            "mount" => "ipval",
            "handler" => "\Anax\ipval\IpValController",
        ],
    ]
];
