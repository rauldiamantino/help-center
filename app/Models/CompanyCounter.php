<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyCounter extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'entity_type',
        'next_number',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public static function getNextNumber(int $companyId, string $entityType): int
    {
        DB::beginTransaction();

        try {
            $counter = self::where('company_id', $companyId)
                ->where('entity_type', $entityType)
                ->lockForUpdate()
                ->first();

            if (empty($counter)) {
                self::create([
                    'company_id' => $companyId,
                    'entity_type' => $entityType,
                    'next_number' => 2,
                ]);

                DB::commit();
                return 1;
            }

            $nextNumber = $counter->next_number;
            $counter->next_number = $nextNumber + 1;
            $counter->save();

            DB::commit();
            return $nextNumber;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
