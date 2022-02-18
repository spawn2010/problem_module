<?php

namespace app\models\Evaluation;

class View
{

    public static function getClassEvaluation($button, $value = '')
    {
        switch ($button) {
            case 'up':
                return ($value == 1);
            case 'down':
                return ($value == -1);
            default:
                return false;
        }

    }
}