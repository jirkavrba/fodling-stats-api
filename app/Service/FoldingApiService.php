<?php


namespace App\Service;


use App\Team;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

final class FoldingApiService
{
    private const API_URL = "https://stats.foldingathome.org/api/";

    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchScoreOfTeam(Team $team)
    {
        $url = self::API_URL . $team->type . '/' . $team->folding_id;
        $response = $this->client->get($url);

        try
        {
            $json = json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
        }
        catch (Exception $exception)
        {
            Log::alert($exception);
            return null;
        }

        return $json->credit;
    }
}
