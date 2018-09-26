<?php

namespace Tests\Feature;

use App\User;
use DateTime;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PassportTestCase extends TestCase
{
    use DatabaseTransactions;
    protected $header = [];
    protected $user;
    protected $baseUrl = '127.0.0.1:8000';

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client', $this->baseUrl
        );
        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        //Create user factory
        $this->user = factory(User::class)->create();

        //Assign user a token
        $token = $this->user->createToken('Unit Test Token')->accessToken;
        $this->header['Accept'] = 'application/json';
        $this->header['Authorization'] = 'Bearer '.$token;
    }

    public function getJson($uri, $header = []){
        return parent::getJson($uri, array_merge($this->header, $header));
    }

    public function postJson($uri, $data = [], $header = []){
        return parent::postJson($uri, $data, array_merge($this->header, $header));
    }
}