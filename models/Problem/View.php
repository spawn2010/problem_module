<?php

namespace app\models\Problem;

class View
{
    public static function getClassRating($rating)
    {
        if ($rating === null) {
            return 'no_rating';
        }

        switch ($rating) {
            case 5:
                return 'high_rating';
            case 4:
                return 'average_rating';
            default:
                return 'law_rating';
        }
    }
}