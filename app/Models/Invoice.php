<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'receiver_name',
        'receiver_phone',
        'receiver_email',
        'receiver_province',
        'receiver_district',
        'receiver_ward',
        'receiver_address',
        'receiver_total',
        'payment',
    ];

    public function getIdAttribute()
    {
        return $this->attributes['id'];
    }

    public static function getTotalRevenues()
    {
        $total = Invoice::sum('total');
        return $total;
    }

    public static function getTotalInvoices()
    {
        $total = Invoice::count();
        return $total;
    }

    public static function getDataStatistics()
    {
        $data = Invoice::select(DB::raw("MONTH(created_at) as month, SUM(total) as revenue"))
            ->where("status", "=", 3)
            ->groupBy("month")
            ->get();

        return $data;
    }

    public static function getRevenueLastWeek()
    {
        $data = [];
        $revenues = Invoice::select(DB::raw("WEEKDAY(created_at) as day, SUM(total) as revenue"))
            ->where("status", "=", 3)
            ->where(DB::raw("yearweek(created_at)"), "=", DB::raw("yearweek(current_date)-1"))
            ->whereYear("created_at", DB::raw("YEAR(current_date)"))
            ->groupBy("day")
            ->get();

        if ($revenues == []) {
            $data = null;
        } else {
            foreach ($revenues as $revenue) {
                $data[$revenue['day']] = $revenue['revenue'];
            }
        }

        return $data;
    }

    public static function getRevenueCurrentWeek()
    {
        $data = [];
        $revenues = Invoice::select(DB::raw("WEEKDAY(created_at) as day, SUM(total) as revenue"))
            ->where("status", "=", 3)
            ->where(DB::raw("yearweek(created_at)"), "=", DB::raw("yearweek(current_date)"))
            ->whereYear("created_at", DB::raw("YEAR(current_date)"))
            ->groupBy("day")
            ->get();

        if ($revenues == []) {
            $data = null;
        } else {
            foreach ($revenues as $revenue) {
                $data[$revenue['day']] = $revenue['revenue'];
            }
        }

        return $data;
    }

    public static function getRevenueLastMonth()
    {
        $data = [];
        $revenues = Invoice::select(DB::raw("DAYOFMONTH(created_at) as date, SUM(total) as revenue"))
            ->where("status", "=", 3)
            ->where(DB::raw("MONTH(created_at)"), "=", DB::raw("MONTH(current_date)-1"))
            ->whereYear("created_at", DB::raw("YEAR(current_date)"))
            ->groupBy("date")
            ->get();

        if ($revenues == []) {
            $data = null;
        } else {
            foreach ($revenues as $revenue) {
                $data[$revenue['date']] = $revenue['revenue'];
            }
        }

        return $data;
    }

    public static function getRevenueCurrentMonth()
    {
        $data = [];
        $revenues = Invoice::select(DB::raw("DAYOFMONTH(created_at) as date, SUM(total) as revenue"))
            ->where("status", "=", 3)
            ->where(DB::raw("MONTH(created_at)"), "=", DB::raw("MONTH(current_date)"))
            ->whereYear("created_at", DB::raw("YEAR(current_date)"))
            ->groupBy("date")
            ->get();

        if ($revenues == []) {
            $data = null;
        } else {
            foreach ($revenues as $revenue) {
                $data[$revenue['date']] = $revenue['revenue'];
            }
        }

        return $data;
    }

    public static function getRevenueLastYear()
    {
        $data = [];
        $revenues = Invoice::select(DB::raw("MONTH(created_at) as month, SUM(total) as revenue"))
            ->where("status", "=", 3)
            ->whereYear("created_at", DB::raw("YEAR(current_date)-1"))
            ->groupBy("month")
            ->get();

        if ($revenues == []) {
            $data = null;
        } else {
            foreach ($revenues as $revenue) {
                $data[$revenue['month']] = $revenue['revenue'];
            }
        }

        return $data;
    }

    public static function getRevenueCurrentYear()
    {
        $data = [];
        $revenues = Invoice::select(DB::raw("MONTH(created_at) as month, SUM(total) as revenue"))
            ->where("status", "=", 3)
            ->whereYear("created_at", DB::raw("YEAR(current_date)"))
            ->groupBy("month")
            ->get();

        if ($revenues == []) {
            $data = null;
        } else {
            foreach ($revenues as $revenue) {
                $data[$revenue['month']] = $revenue['revenue'];
            }
        }

        return $data;
    }
}
