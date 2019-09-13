<?php

namespace Slavic\MissingPersons\Console\Commands;

use Illuminate\Console\Command;
use Slavic\MissingPersons\Model\PersonProfile;

class RecalculationOfAgeCommand extends Command
{
    public $timeout = 120;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'persons:recalculation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculation of the current age of the missing persons';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $persons = \Slavic\MissingPersons\Model\PersonProfile::getAll();
        
        if (empty($persons)) {
            return $this->info('No records are found.');
        }
        
        foreach ($persons as $person) {
            $person->age = (date('Y') - $person->year_of_birth);
            $person->save();
        }
        
        return $this->info('The current age of ' . $persons->count() . ' persons is recalculated');
    }
}