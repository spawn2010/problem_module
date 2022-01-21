<?php

namespace app\models\Evaluation;

class View
{
    public static function getClassEvaluationUp($value = '')
    {
        if ($value === null) {
            return 'enabled';
        }

        switch ($value) {
            case 1:
                return 'disabled';
            case -1:
                return 'enabled';
        }
    }

    public static function getClassEvaluationDown($value = '')
    {
        if ($value === null) {
            return 'enabled';
        }
        switch ($value) {
            case 1:
                return 'enabled';
            case -1:
                return 'disabled';
        }
    }
}