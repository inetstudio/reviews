<?php

namespace InetStudio\Reviews\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

/**
 * Class SetupCommand.
 */
class SetupCommand extends Command
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $name = 'inetstudio:reviews:setup';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Setup reviews package';

    /**
     * Список дополнительных команд.
     *
     * @var array
     */
    protected $calls = [];

    /**
     * Запуск команды.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->initCommands();

        foreach ($this->calls as $info) {
            if (! isset($info['command'])) {
                continue;
            }

            $params = (isset($info['params'])) ? $info['params'] : [];

            $this->line(PHP_EOL.$info['description']);

            switch ($info['type']) {
                case 'artisan':
                    $this->call($info['command'], $params);
                    break;
                case 'cli':
                    $process = new Process($info['command']);
                    $process->run();
                    break;
            }
        }
    }

    /**
     * Инициализация команд.
     *
     * @return void
     */
    private function initCommands(): void
    {
        $this->calls = [
            [
                'type' => 'artisan',
                'description' => 'Reviews sites setup',
                'command' => 'inetstudio:reviews:sites:setup',
            ],
            [
                'type' => 'artisan',
                'description' => 'Reviews messages setup',
                'command' => 'inetstudio:reviews:messages:setup',
            ],
            [
                'type' => 'cli',
                'description' => 'Composer dump',
                'command' => 'composer dump-autoload',
            ],
        ];
    }
}
