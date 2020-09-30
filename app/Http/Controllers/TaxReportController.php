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

    protected function getPrevMonthUrl($year, $month)
    {
        $prevYear = $year;
        if ($month == 1) {
            $prevMonth = 12;
            $prevYear = $year - 1;
        } else {
            $prevMonth = 1;
        }

        if (
            $prevYear < $this->earliestYear
            || $prevYear == $this->earliestYear && $prevMonth < $this->earliestMonth
        ) {
            return null;
        }

        $prevMonth =  str_pad($prevMonth, 2, '0', STR_PAD_LEFT);

        return route('dashboard.tax.report.month', [
            'year' => $prevYear,
            'month' => $prevMonth,
        ]);
    }

    protected function getNextMonthUrl($year, $month)
    {
        $nextYear = $year;
        if ($month == 12) {
            $nextMonth = 1;
            $nextYear = $year + 1;
        } else {
            $nextMonth = $month + 1;
        }

        if (
            $nextYear > date('Y')
            || $nextYear == date('Y') && $nextMonth > date('m')
        ) {
            return null;
        }

        $nextMonth =  str_pad($nextMonth, 2, '0', STR_PAD_LEFT);

        return route('dashboard.tax.report.month', [
            'year' => $nextYear,
            'month' => $nextMonth,
        ]);
    }

    protected function getNextYearUrl($year)
    {
        $nextYear = $year + 1;

    }

    protected function getPrevYearUrl($year)
    {
        //
    }
}
