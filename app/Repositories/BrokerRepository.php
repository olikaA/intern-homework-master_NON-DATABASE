<?php

namespace App\Repositories;

use App\Interfaces\BrokerRepositoryInterface;
use App\Models\Broker;
use DateTime;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class BrokerRepository Implements BrokerRepositoryInterface
{
    /**
     * @return Collection|Broker[]
     */

    public function getBrokers()
    {
        // DO NOT MODIFY THIS METHOD'S IMPLEMENTATION!
        return collect([
            new Broker('Interactive Brokers', 'Stock', 4.9, false, new DateTime('2021-03-19T00:00:00')),
            new Broker('DEGIRO', 'Stock', 4.3, false, new DateTime('2021-09-01T00:00:00')),
            new Broker('eToro', 'CFD', 4.7, false, new DateTime('2021-04-28T00:00:00')),
            new Broker('Revolut', 'Stock', 4.2, false, new DateTime('2020-06-22T00:00:00')),
            new Broker('flatex', 'Other', 3.2, true, new DateTime('2021-09-13T00:00:00')),
            new Broker('Trading 212', 'CFD', 2.1, false, new DateTime('2021-01-07T00:00:00')),
            new Broker('TradeStation', 'CFD', 4.8, true, new DateTime('2020-11-17T00:00:00')),
            new Broker('Questrade', 'Stock', 3.6, false, new DateTime('2020-02-26T00:00:00')),
            new Broker('Swissquote', 'Stock', 4.1, false, new DateTime('2020-07-06T00:00:00')),
            new Broker('Saxo Bank', 'Other', 4.6, true, new DateTime('2021-12-12T00:00:00')),
            new Broker('Capital.com', 'Stock', 3.9, false, new DateTime('2021-08-03T00:00:00')),
            new Broker('XTB', 'Stock', 3.8, true, new DateTime('2021-04-12T00:00:00')),

        ]);
    }

    public function getAllBrokers()
    {
        return  $this->getBrokers()->where('brokerType','=','Stock')->sort(function ($a, $b) {
            return ($a->overallScore > $b->overallScore) ? -1 : 1;
        });

    }

    public function getRandomBroker()
    {
        return $this->getBrokers()->random(1);
    }

    public function top_3_2020()
    {
        return $this->getBrokers()->filter(function ($value) {
            return $value->reviewDate->format('Y') == 2020; // assuming, that your timestamp gets converted to a Carbon object.
        })->sort(function ($a, $b) {
            return ($a->overallScore > $b->overallScore) ? -1 : 1;
        })->forPage(1, 3);

    }

    public function with_no_fee()
    {
        return $this->getBrokers()->where('hasInactivityFee','=',false)->sort(function ($a, $b) {
            return ($a->overallScore > $b->overallScore) ? -1 : 1;
        });
    }
}
