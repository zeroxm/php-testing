<?php 

return [
    "application" => [
        "directory" => APPLICATION_PATH ."/application",
        "dispatcher" => [
              "catchException" => true,
        ],
        "view" => [
               "ext" => "phtml",
        ],
    ],
];