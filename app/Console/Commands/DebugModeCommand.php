<?php

namespace App\Console\Commands;

use App\Http\Env;
use Illuminate\Console\Command;

class DebugModeCommand extends Command
{
    protected $signature = 'debug:mode {value}';

    protected $description = 'Change Debug Mode Command description';

    public function handle()
    {
        $value = strtolower($this->argument('value'));

        if(!in_array($value, ['on', 'off']))
        {
            $this->components->error('The value must be in "on" or "off"');
            return;
        }

        $new = $value == 'on';

        $app_env = $new ? 'local' : 'production';

        Env::putBool('APP_DEBUG', $new);

        Env::put('APP_ENV', $app_env);

        $this->components->info('Env file updated successfully');
    }
}
