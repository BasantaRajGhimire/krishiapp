<?php

namespace App\Admin;

use App\Buyer\ClientUsers;
// use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiceProviderExport implements FromCollection, WithHeadings
{
    public $collection;
    public function __construct($collection)
    {
        $this->collection = $collection;
    }
    /**

    * @return \Illuminate\Support\Collection

    */
    public function collection()

    {
        return $this->collection;

    }
    public function headings(): array

    {

        return [
            'SN',
            'Company Name',
            'Status',
            'Badge',
            'Stars',
            'Reviews',
            'Completed Bids',
            'Running Won Bids',
            'Pending Bids',
        ];

    }
}
