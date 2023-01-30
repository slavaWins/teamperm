<?php

namespace Teamperm\Console\Commands;

use Teamperm\Library\TeampermHelper;
use Teamperm\Models\Teamperm;
use Teamperm\Models\TeampermSetting;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExampleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teamperm:example';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Заготовка команды teamperm';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {

        $this->info("teamperm - Команда выполнена");
    }
}
