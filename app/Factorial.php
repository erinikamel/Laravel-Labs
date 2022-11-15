<?php
namespace App;

use Ramsey\Uuid\Type\Integer;

// PHP code to get the factorial of a number
// function to get factorial in iterative way
class Factorial
{
    function Factorial($number){
        if (!is_integer($number) || is_bool($number)) {
            return null;
        }
        
        if($number > 1)
        {
            return $number * $this->Factorial($number - 1);
        }
        if ($number==0 || $number ==1){
            return 1;
        }


}
}
?>
