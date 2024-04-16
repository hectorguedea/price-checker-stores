<?php 
require '../vendor/autoload.php';
if (isset($_POST['table'])) {

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
$spreadsheet = $reader->loadFromString($_POST['table']);

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
 $writer->save('../files/resultado.xls'); 

}
?>