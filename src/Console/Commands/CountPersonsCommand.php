<?php

namespace Slavic\MissingPersons\Console\Commands;

use Illuminate\Console\Command;
use Slavic\MissingPersons\Model\PersonProfile;
use DB;

class CountPersonsCommand extends Command
{
    public $timeout = 120;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'count:persons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Count missing persons for each area';

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
        /* Calculate peoples for each region */
        $persons_by_regions = DB::table('person_profile')
                 ->select('region_id', DB::raw('count(*) as total'))
                 ->groupBy('region_id')
                 ->get();
        
        if (empty($persons_by_regions)) {
            return $this->info('No records are found.');
        }
        
        foreach ($persons_by_regions as $region) {
            DB::table('regions')->where('id', $region->region_id)->update(['people' => $region->total]);
        }
        
        /* Calculate peoples for each settlement */
        $persons_by_settlements = DB::table('person_profile')
                 ->select('settlement_id', DB::raw('count(*) as total'))
                 ->groupBy('settlement_id')
                 ->get();
        
        if (empty($persons_by_settlements)) {
            return $this->info('No records are found.');
        }
        
        foreach ($persons_by_settlements as $settlement) {
            DB::table('settlements')->where('id', $settlement->settlement_id)->update(['people' => $settlement->total]);
        }
    }
}