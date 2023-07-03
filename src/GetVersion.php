<?php

namespace App;
use Symfony\Component\HttpKernel\KernelInterface;

class GetVersion
{
    public static function get_current_commit(string $branch = 'develop', bool $pretty = false): bool|string
    {
        if (file_get_contents(sprintf('../.git/refs/heads/%s', $branch))) {
            $hash = file_get_contents(sprintf('../.git/refs/heads/%s', $branch));

            if ($pretty) {
                return substr($hash, 0, 7);
            } else {
                return $hash;
            }
        } else {
            return false;
        }
    }
}