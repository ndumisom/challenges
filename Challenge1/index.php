<?php

function sortArrays($firstArray,$secondArray)
{

$mergedArrayResults = array_merge($firstArray,$secondArray);
 //print_r($result);
$removedArrayDuplicateResults= array_unique($mergedArrayResults);

for($i=1;$i< count($removedArrayDuplicateResults);$i++)
{
   for($j=$i;$j>0;$j--)
   {    
       if($removedArrayDuplicateResults[$j] < $removedArrayDuplicateResults[$j-1])
       { 
           $tmp = $removedArrayDuplicateResults[$j];
           $removedArrayDuplicateResults[$j] = $removedArrayDuplicateResults[$j-1];
           $removedArrayDuplicateResults[$j-1] = $tmp ;
       }
   }
}

 print_r($removedArrayDuplicateResults);
	
}

 $first = array('2','4','8','5','1','7','6','9','10','3');
 $second = array('6','9','10','3');

 sortArrays($first,$second);


 ?>