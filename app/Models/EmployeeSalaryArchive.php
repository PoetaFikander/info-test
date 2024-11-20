<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmployeeSalaryArchive extends Model
{
    use HasFactory;

    protected $fillable = [
        'basis_net',
        'basis_gross',
        'basis_valid_from',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
