<?php
if ($ccgpa <= 1.49){
    $remarks ="ATW";
}
else
if ($ccgpa >= 1.49 and $ccgpa <= 1.59){

        $remarks ="WARNING";
    }else

    if ($ccgpa >= 1.6 and $ccgpa <= 2.49){

        $remarks ="PASS";
    }
    else
        if ($ccgpa >= 2.5 and $ccgpa <= 2.99){

            $remarks ="LOWER CREDIT";
        }
        else
            if ($ccgpa >= 3.00 and $ccgpa <= 3.49){

                $remarks ="UPPER CREDIT";
            }
            else
                if ($ccgpa >= 3.5 and $ccgpa <= 4){

                    $remarks ="DISTINCTION";
                }?>