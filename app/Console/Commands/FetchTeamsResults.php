<?php

namespace App\Console\Commands;

use App\Service\FoldingApiService;
use App\Team;
use App\TeamResult;
use Illuminate\Console\Command;

class FetchTeamsResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teams:fetch-results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetches current results of all teams in database';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $service = new FoldingApiService();
        $teams = Team::all();
        $time = now()->setSecond(0)->toDateTime();

        foreach ($teams as $team)
        {
            $this->getOutput()->write("Loading score of [$team->name]\n");

            $score = $service->fetchScoreOfTeam($team);

            if ($score !== null)
            {
                $this->getOutput()->write("[$team->name] has currently [$score] points\n");

                $record = new TeamResult([
                    'team_id' => $team->id,
                    'datetime' => $time,
                    'score' => $score,
                ]);

                $record->save();
            }
        }
    }
}
