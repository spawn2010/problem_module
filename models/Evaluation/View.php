<?php

namespace app\models\Evaluation;

class View
{

    public static function getClassEvaluation($button, $value = '')
    {
        if ($value === '') {
            return 'enabled';
        }

        if ($button == 'up'){
            return ($value == 1) ? 'disabled' : 'enabled';
        }

        if ($button == 'down'){
            return ($value == 1) ? 'enabled' : 'disabled';
        }
    }

}