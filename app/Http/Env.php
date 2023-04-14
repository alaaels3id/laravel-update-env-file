<?php

namespace App\Http;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class Env
{
    public static function update($key, $new, $is_boolean = false): void
    {
        $path = base_path('.env');

        $old = $is_boolean ? (bool)env($key) : env($key);

        if($old === $new) return;

        $new_value = $is_boolean ? ($key . '=' . ($new ? 'true' : 'false')) : $key . "=" . $new;

        $old_value = $is_boolean ? ($key . '=' . ($old ? 'true' : 'false')) : $key . "=" . $old;

        File::put($path, str(File::get($path))->replace($old_value, $new_value));

        Artisan::call('optimize:clear');
    }

    public static function put($key, $value): void
    {
        self::update($key, $value);
    }

    public static function putBool($key, $value): void
    {
        self::update($key, $value,true);
    }
}
