<?php

namespace App\Support;

class AjhiCalculator
{
    /**
     * Porting Engine.compute() dari prototype/index.html:257-291.
     * $items: ['ITM-001' => 1|0.5|0, ...]
     *
     * @return array{score:int, risk:string, status:string, criticals:array, warns:array, recs:array, has_critical:bool, total_weight:int}
     */
    public function compute(array $items): array
    {
        $checklist = config('ajhi.checklist');
        $earned = 0;
        $total = 0;
        $criticals = [];
        $warns = [];
        $recs = [];

        foreach ($checklist as $item) {
            $total += $item['weight'];
            $factor = isset($items[$item['id']]) ? (float) $items[$item['id']] : 1.0;
            $earned += $item['weight'] * $factor;

            if ($factor === 0.0) {
                if ($item['level'] === 'Critical') {
                    $criticals[] = $item['name'];
                }
                $recs[] = $item['rec'];
            } elseif ($factor === 0.5) {
                $warns[] = $item['name'];
                $recs[] = $item['rec'];
            }
        }

        $score = (int) round(($earned / max($total, 1)) * 100);

        $risk = 'NORMAL';
        $status = 'Sehat / Optimal';

        if (count($criticals) > 0) {
            $risk = 'PRIORITAS KESELAMATAN';
            $status = 'PERLU PERBAIKAN SEGERA';
        } elseif ($score < 75 || count($warns) > 2) {
            $risk = 'PERHATIAN';
            $status = 'Perlu Perawatan Berkala';
        }

        return [
            'score' => $score,
            'risk' => $risk,
            'status' => $status,
            'criticals' => $criticals,
            'warns' => $warns,
            'recs' => $recs,
            'has_critical' => count($criticals) > 0,
            'total_weight' => $total,
        ];
    }

    /** Nilai default meniru Engine.defaultItems() prototype. */
    public function defaultItems(): array
    {
        $items = [];
        foreach (config('ajhi.checklist') as $item) {
            $items[$item['id']] = 1.0;
        }
        $items['ITM-001'] = 0.5;
        $items['ITM-011'] = 0.0;

        return $items;
    }
}
