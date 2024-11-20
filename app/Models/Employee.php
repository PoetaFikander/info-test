<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeeSalaryArchive;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'altum_id',
        'activity',
        'code',
        'name',
        'surname',
        'phone',
        'email',
        'is_active',
        'department_id',
        'workplace_id',
        'section_id',
        'salary_basis_net',
        'salary_basis_gross',
        'salary_basis_valid_from',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function workplace(): BelongsTo
    {
        return $this->belongsTo(Workplace::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function salaries()
    {
        return $this->hasMany(EmployeeSalaryArchive::class);
    }


    /**
     * list of active employees at Altum
     * @return array
     */
    static function getAltumEmployees(): array
    {
        return DB::connection('sqlsrv')->select(
            "SELECT * FROM [dbo].[getAltumEmployees] () order by [name_surname]"
        );
    }

    /**
     * @param int $altumEmployeeId
     * @return array
     */
    static function getAltumEmployee(int $altumEmployeeId): array
    {
        return DB::connection('sqlsrv')->select(
            "SELECT * FROM [dbo].[getAltumEmployees] () WHERE [id] = :id",
            ['id' => $altumEmployeeId]
        );
    }

}
