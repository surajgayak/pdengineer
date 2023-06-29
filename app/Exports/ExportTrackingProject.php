<?php

namespace App\Exports;

use App\Models\TrackingProject;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportTrackingProject implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TrackingProject::all();
    }
}
