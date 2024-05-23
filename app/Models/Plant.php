<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Web3\Web3;
use Web3\Contract;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;

class Plant extends Model
{
    use HasFactory;

    protected $table = "plants";
    protected $fillable = ['name', 'notes', 'money'];

    protected $web3;
    protected $contract;
    protected $contractAddress;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->web3 = new Web3(new HttpProvider(new HttpRequestManager('https://mainnet.infura.io/v3/' . env('INFURA_PROJECT_ID'))));
        $this->contractAddress = env('PLANT_LOG_CONTRACT_ADDRESS');
        $this->contract = new Contract($this->web3->provider, $this->getAbi());
    }

    protected function getAbi()
    {
        // Используем base_path для получения корневого пути приложения
        $path = base_path('app/Contracts/PlantLogABI.json');
        return json_decode(file_get_contents($path), true);
    }

    public function addPlant($name, $notes, $money)
    {
        $result = null;
        $this->contract->at($this->contractAddress)->send('addPlant', $name, $notes, $money, function ($err, $transaction) use (&$result) {
            if ($err !== null) {
                throw new \Exception('Error: ' . $err->getMessage());
            }
            $result = $transaction;
        });
        return $result;
    }

    public function getPlant($id)
    {
        $plantData = null;
        $this->contract->at($this->contractAddress)->call('getPlant', $id, function ($err, $plant) use (&$plantData) {
            if ($err !== null) {
                throw new \Exception('Error: ' . $err->getMessage());
            }
            $plantData = $plant;
        });
        return $plantData;
    }

    public function purchasePlant($plantId, $quantity, $money)
    {
        $result = null;
        $this->contract->at($this->contractAddress)->send('purchasePlant', $plantId, $quantity, $money, function ($err, $transaction) use (&$result) {
            if ($err !== null) {
                throw new \Exception('Error: ' . $err->getMessage());
            }
            $result = $transaction;
        });
        return $result;
    }
}
