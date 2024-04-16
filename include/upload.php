<?php
require '../vendor/autoload.php';

if (!file_exists('../files')) {
        mkdir('../files', 0777);
    }

    $tiendas_archivos = array ("tienda1" => '../files/'. $_FILES['tienda1']['name'], "tienda2" => '../files/'. $_FILES['tienda2']['name']);

    move_uploaded_file($_FILES['tienda1']['tmp_name'], $tiendas_archivos["tienda1"]);
    move_uploaded_file($_FILES['tienda2']['tmp_name'], $tiendas_archivos["tienda2"]);

 
$diferencia = $_POST["diferencia"]; 
$inputFileType = 'Xls';
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
$reader->setReadDataOnly(true);



$rows_tienda1 = [];
$rows_tienda2 = [];
$columns = [];
$count = 0; 

foreach ($tiendas_archivos as $tienda => $archivo):

$spreadsheet = $reader->load($archivo);
$worksheetData = $reader->listWorksheetInfo($archivo);



$worksheet = $spreadsheet->getActiveSheet();


    foreach ($worksheet->getRowIterator() AS $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
       
        $cells = [];
        foreach ($cellIterator as $cell) {
            $cells[] = $cell->getValue();
        }

        // Columnas y filas 
        if($count === 0){
           $columns[] = $cells; 
           $count++; 
        }else{
           $cells[2] = (double) str_replace("$","", $cells[2]);
           $cells[3] = (double) str_replace("$","", $cells[3]);
        
           if($tienda == "tienda1"){
            $rows_tienda1[] = $cells;
           }else{
            $rows_tienda2[] = $cells; 
           }
           
        }
    }


$spreadsheet->disconnectWorksheets();
unset($spreadsheet);

endforeach;

$counter = 0; 
$rows_total = []; 


foreach ($rows_tienda1 as $row_tienda1 => $value_tienda1){
    $cells_total = []; 
    foreach ($rows_tienda2 as $row_tienda2 => $value_tienda2){
        if($value_tienda1[0] == $value_tienda2[0]){
            if ($value_tienda1[2] > $value_tienda2[2] && abs($value_tienda1[2] - $value_tienda2[2]) > $diferencia){
                $cells_total[] = $value_tienda1[0];
                $cells_total[] = $value_tienda1[1];
                $cells_total[] = $value_tienda1[2]; 
                $cells_total[] = $value_tienda2[2]; 
                $cells_total[] = abs($value_tienda1[2] - $value_tienda2[2]);
                $cells_total[] = "Tienda 2";
                $cells_total[] = "Tienda 1";
                $cells_total[] = $value_tienda1[3];
                $counter++; 
                $rows_total[] = $cells_total;
               
            }
            if ($value_tienda1[2] < $value_tienda2[2]  && abs($value_tienda1[2] - $value_tienda2[2]) > $diferencia){
               
                $cells_total[] = $value_tienda1[0];
                $cells_total[] = $value_tienda1[1];
                $cells_total[] = $value_tienda1[2]; 
                $cells_total[] = $value_tienda2[2]; 
                $cells_total[] = abs($value_tienda1[2] - $value_tienda2[2]);
                $cells_total[] = "Tienda 1";
                $cells_total[] = "Tienda 2";
                $cells_total[] = $value_tienda2[3];
                $counter++; 
                $rows_total[] = $cells_total; 
            }
           
        }
    }
}


echo '
<div class="top_bar">
    <div class="counter">
    <h4>Resultaron <strong>'. $counter  . ' </strong> diferencias por cambiar </h4>
    </div>
    <div class="export">
    <a class="btn btn-md  btn-success excel" type="button">Exportar Excel</a>
    </div>
</div>
';


// Imprimir Tabla por Archivo
echo '<table class="table"> <thead> <tr>';

 echo '<th scope="col">Código</th>
       <th scope="col">Producto</th>
       <th scope="col">Costo T1</th>
       <th scope="col">Costo T2</th>
       <th scope="col">Diferencia</th>
       <th scope="col">Menor Costo</th>
       <th scope="col">Mayor Costo</th>
       <th scope="col">Precio Venta</th>
   ';
echo '</tr>
</thead>
<tbody>'; 

    foreach ($rows_total as $row) {
        echo '<tr>';
        foreach ($row as $data => $value){
            echo '<td>'; 
            echo $value;    
            echo    '</td>' . PHP_EOL;
        }
        echo '</tr>'; 
    }

echo ' </tbody>'; 
echo '</table>' . PHP_EOL;


?>