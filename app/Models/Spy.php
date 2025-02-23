<?php

namespace App\Models;

use App\Traits\Filterable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Spy extends Model
{
    use Filterable, HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'date_of_death' => 'date',
        ];
    }

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }

    public function getFullNameAttribute(): string
    {
        return $this->name.' '.$this->surname;
    }

    public function getOperationalPeriodAttribute(): string
    {
        $dateOfBirth = Carbon::parse($this->date_of_birth);

        $dateOfDeath = $this->date_of_death ? Carbon::parse($this->date_of_death) : Carbon::now();

        $difference = $dateOfBirth->diff($dateOfDeath);

        return sprintf(
            '%d years, %d months, %d days',
            $difference->y,
            $difference->m,
            $difference->d
        );
    }
}
