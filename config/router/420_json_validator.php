<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Style chooser.",
            "mount" => "ipjson",
            "handler" => "\Anax\ipjson\IpJsonController",
        ],
    ]
];
