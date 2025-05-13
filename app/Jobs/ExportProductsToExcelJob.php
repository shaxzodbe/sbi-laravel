<?php

namespace App\Jobs;

use App\Exports\ProductsExport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Maatwebsite\Excel\Facades\Excel;

class ExportProductsToExcelJob implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $currentDate = date('Y-m-d H:i:s');
        Excel::store(new ProductsExport, "products_{$currentDate}.xlsx");
    }
}
