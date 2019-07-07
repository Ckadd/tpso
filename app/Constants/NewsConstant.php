<?php

namespace App\Constants;

class NewsConstant
{
    /**
     * News status.
     *
     * @param mixed $status
     *
     * @return mixed
     */
    public static function status($status = null)
    {
        $defaultStatus = [
            'pending'   => 0,
            'published' => 1,
        ];

        if (!empty($status) || 0 === $status || '0' === $status) {
            $defaultStatus = array_flip($defaultStatus);

            return in_array($status, array_keys($defaultStatus)) ? $defaultStatus[$status] : null;
        }

        return $defaultStatus;
    }
}
