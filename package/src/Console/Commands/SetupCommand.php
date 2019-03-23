<?php

namespace InetStudio\Reviews\Console\Commands;

use InetStudio\AdminPanel\Base\Console\Commands\BaseSetupCommand;

/**
 * Class SetupCommand.
 */
class SetupCommand extends BaseSetupCommand
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
     * Инициализация команд.
     *
     * @return void
     */
    protected function initCommands(): void
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
        ];
    }
}
