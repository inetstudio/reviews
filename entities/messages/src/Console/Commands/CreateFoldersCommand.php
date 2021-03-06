<?php

namespace InetStudio\Reviews\Messages\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class CreateFoldersCommand.
 */
class CreateFoldersCommand extends Command
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $name = 'inetstudio:reviews:messages:folders';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Create package folders';

    /**
     * Запуск команды.
     */
    public function handle(): void
    {
        $folders = [
            'reviews_messages',
        ];

        foreach ($folders as $folder) {
            if (config('filesystems.disks.'.$folder)) {
                $path = config('filesystems.disks.'.$folder.'.root');
                $this->createDir($path);
            }
        }
    }

    /**
     * Создание директории.
     *
     * @param $path
     */
    protected function createDir($path): void
    {
        if (! is_dir($path)) {
            mkdir($path, 0777, true);
            $this->info($path.' Has been created.');

            return;
        }

        $this->info($path.' Already created.');
    }
}
