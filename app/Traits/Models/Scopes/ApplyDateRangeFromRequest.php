<?php


namespace App\Traits\Models\Scopes;


use Illuminate\Database\Eloquent\Builder;

trait ApplyDateRangeFromRequest
{
    /**
     * @param Builder $builder
     * @param $dateRangeFromRequest
     * @param string $field
     * @return Builder
     */
    public function scopeApplyDateRange(Builder $builder, $dateRangeFromRequest, $field = 'created_at'): Builder
    {
        $delimiter = ' to ';
        $dates = explode($delimiter, $dateRangeFromRequest);
        if (!$dates) {
            return $builder;
        }
        if (count($dates) === 1) {
            return $builder->where($field, $dates[0]);
        }
        [$from, $to] = $dates;
        $from = dateFrom($from);
        $to = dateTo($to);

        return $builder->whereBetween($field, [$from, $to]);
    }

}
