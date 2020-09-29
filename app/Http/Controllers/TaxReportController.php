<?php

namespace App\Http\Controllers;

use App\Wax\Shop\Models\Order;

class TaxReportController extends Controller
{
    protected $earliestYear = 2020;
    protected $earliestMonth = 9;

    public function index()
    {
        return redirect()
            ->route('dashboard.tax.report.month', [
                'year' => date('Y'),
                'month' => date('m'),
            ]);
    }

    public function year($year)
    {
        $zones = Order::placedYear($year)
            ->get()
            ->map
            ->shipments
            ->flatten()
            ->filter(fn($shipment) => $shipment->tax_amount > 0)
            ->groupBy('tax_desc')
            ->map(fn($group) => $group->sum('tax_amount'));

        return view('dashboard.tax.report.year', [
            'year' => $year,
            'zones' => $zones,
            'nextYearUrl' => $this->getNextYearUrl($year),
            'prevYearUrl' => $this->getPrevYearUrl($year),
        ]);
    }

    public function month($year, $month)
    {
        $zones = Order::placedMonth($year, $month)
            ->get()
            ->map
            ->shipments
            ->flatten()
            ->filter(fn($shipment) => $shipment->tax_amount > 0)
            ->groupBy('tax_desc')
            ->map(fn($group) => $group->sum('tax_amount'));

        return view('dashboard.tax.report.month', [
            'year' => $year,
            'month' => $month,
            'zones' => $zones,
            'yearUrl' => $this->getYearLink($year),
            'nextMonthUrl' => $this->getNextMonthUrl($year, $month),
            'prevMonthUrl' => $this->getPrevMonthUrl($year, $month),
        ]);
    }

    protected function getYearLink($year)
    {
        return route('dashboard.tax.report.year', ['year' => $year]);
    }

    protected function getNextMonthUrl($year, $month)
    {
        //
    }

    protected function getPrevMonthUrl($year, $month)
    {
        //
    }

    protected function getNextYearUrl($year)
    {
        //
    }

    protected function getPrevYearUrl($year)
    {
        //
    }
}
