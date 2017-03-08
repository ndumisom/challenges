<?php
function transposeMatrix($matrixData)
{
  $emptyArray = array();
    foreach ($matrixData as $row => $columns) {
      foreach ($columns as $row2 => $column2) {
          $emptyArray[$row2][$row] = $column2;
      }
    }
  return $emptyArray;
}
$matrixToTranspose = array(
  array(1,2,3), 
  array(4,5,6), 
  array(7,8,9)
);

$transposedMatrix = transposeMatrix($matrixToTranspose);

?>
<table border='1'>
<?php for($i=0; $i< count($transposedMatrix); $i++)  { ?>
<tr><td><?php echo $transposedMatrix[$i][0]?></td><td><?php echo $transposedMatrix[$i][1]?></td><td><?php echo $transposedMatrix[$i][2]?></td></tr>

<?php }?>


</table>