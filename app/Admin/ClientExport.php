<?php

namespace App\Admin;

use App\Buyer\ClientUsers;
// use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientExport implements FromCollection, WithHeadings
{
    public $collection;
    public function __construct($collection)
    {
        $this->collection = ['SN','Name','Email'];
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
            'Name',
            'Status',
            'Pending Post',
            'Running For Bid',
            'Rejected Post',
            'Handover to Bidder',
            'Delivered Post',

        ];

    }
}
