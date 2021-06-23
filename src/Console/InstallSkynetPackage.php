<?php


namespace Claassenmarius\LaravelSkynet\Console;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallSkynetPackage extends Command
{
    protected $signature = "skynetpackage:install";

    protected $description = "Install the laravel-skynet Package";

    public function handle()
    {
        $this->info("Installing laravel-skynet Package...");
        $this->info("Publishing configuration file...");

        if (! $this->configExists('skynetpackage.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration file.');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration(true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        $this->info('Installed laravel-skynet Package');
    }

    private function configExists(string $fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Claassenmarius\Skynet\SkynetServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = '';
        }

        $this->call('vendor:publish', $params);
    }
}
