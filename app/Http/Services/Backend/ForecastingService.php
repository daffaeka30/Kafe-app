<?php

namespace App\Http\Services\Backend;

use App\Models\Backend\ForecastingResult;
use App\Models\Backend\RawMaterial;
use App\Models\Backend\RawMaterialUsage;
use Illuminate\Support\Facades\DB;

class ForecastingService
{
    public function getRecentForecasts($limit = 10)
    {
        return ForecastingResult::with(['rawMaterial.category'])
            ->latest('date')
            ->limit($limit)
            ->get();
    }

    public function getForecastHistory($paginate = null, $rawMaterialId = null, $dateFrom = null, $dateTo = null)
    {
        $query = ForecastingResult::with(['rawMaterial.category'])
            ->when($rawMaterialId, function ($q) use ($rawMaterialId) {
                return $q->where('raw_material_id', $rawMaterialId);
            })
            ->when($dateFrom, function ($q) use ($dateFrom) {
                return $q->whereDate('date', '>=', $dateFrom);
            })
            ->when($dateTo, function ($q) use ($dateTo) {
                return $q->whereDate('date', '<=', $dateTo);
            })
            ->latest('date');

        return $paginate ? $query->paginate($paginate) : $query->get();
    }

    public function generateForecast($rawMaterialId, $period = 3)
    {
        DB::beginTransaction();
        try {
            $rawMaterial = RawMaterial::findOrFail($rawMaterialId);

            // Cek stock
            if ($rawMaterial->stock <= 0) {
                throw new \Exception('Cannot forecast for material with no stock.');
            }

            // Data yang ditampilkan berdasarkan periode dalam hitungan bulan
            $usages = RawMaterialUsage::where('raw_material_id', $rawMaterialId)
                ->whereDate('date', '>=', now()->subMonths($period))
                ->selectRaw('DATE(date) as date, SUM(quantity_used) as total_usage')
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->get();

            if ($usages->count() < 3) {
                throw new \Exception('Not enough data for forecasting. Need at least 3 months of usage data.'); // Sesuaikan pesan
            }

            // Weighted Moving Average dengan bobot: 3, 2, 1
            $weights = [3, 2, 1];
            $weightedSum = 0;
            $totalWeight = array_sum($weights);

            for ($i = 0; $i < 3; $i++) {
                $weightedSum += $usages[$i]->total_usage * $weights[$i];
            }

            $predictedAmount = $weightedSum / $totalWeight;

            // Hitung actual usage dan error rate
            $actualUsage = $usages[0]->total_usage;
            $errorRate = abs(($actualUsage - $predictedAmount) / $actualUsage) * 100;

            // Simpan hasil forecast
            ForecastingResult::create([
                'raw_material_id' => $rawMaterialId,
                'date' => now()->addDay(),
                'predicted_amount' => $predictedAmount,
                'forecasting_method' => 'Weighted Moving Average',
                'actual_usage' => $actualUsage,
                'error_rate' => $errorRate,
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function getAccuracyAnalysis($rawMaterialId, $dateFrom = null, $dateTo = null)
    {
        $forecasts = ForecastingResult::where('raw_material_id', $rawMaterialId)
            ->when($dateFrom, function ($q) use ($dateFrom) {
                return $q->whereDate('date', '>=', $dateFrom);
            })
            ->when($dateTo, function ($q) use ($dateTo) {
                return $q->whereDate('date', '<=', $dateTo);
            })
            ->get();

        if ($forecasts->isEmpty()) {
            return null;
        }

        return [
            'total_forecasts' => $forecasts->count(),
            'average_error' => round($forecasts->avg('error_rate'), 1),
            'min_error' => round($forecasts->min('error_rate'), 1),
            'max_error' => round($forecasts->max('error_rate'), 1),
            'accuracy_trend' => $forecasts->map(function ($f) {
                return [
                    'date' => $f->date->format('d M Y'),
                    'error_rate' => round($f->error_rate, 1),
                    'actual' => round($f->actual_usage, 1),
                    'forecast' => round($f->predicted_amount, 1),
                ];
            })->values(),
        ];
    }
}
