<?php 


require __DIR__ . '/vendor/autoload.php';
use PHPJasper\PHPJasper;
$input =  __DIR__ . '/reporte.jrxml';  
$jasper = new PHPJasper;

$output = __DIR__ .'/generated';

$data_file = [
        "contacts" => [
          "person" => [
            [
              "cedula"=> "1234",
              "nombre"=> "Armando"
            ],
            [
              "cedula"=> "456",
              "nombre"=> "Jose"
            ],
            [
              "cedula"=> "789",
              "nombre"=> "Rojas"
            ]
          ]
        ]
];

$json =  "data.json";
file_put_contents($json, json_encode($data_file) );

$options = [
    'format' => [ 'pdf', 'xlsx'],
    'db_connection' => [
        'driver' => 'json',
        'data_file' =>  __DIR__ .'/'.$json,
        'json_query' => 'contacts.person'
    ]
];

$jasper = new PHPJasper;
$jasper->process($input,$output,$options)->execute();
unlink($json); 
?>

<br>
<a href="generated.pdf">File PDF </a>
<br>
<a href="generated.xlsx">File Excel </a>