<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employes extends Model
{
   use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "Nom",
        "Prénom",
        "Poste",
        "Email",
        "Téléphone",
        "DateEmbauche",
        "Statut",
    ];

    /**
     * retrouve la reservations associee a l'appartements
     */
    public function employe(): HasMany
    {
        return $this->hasMany(Apartements::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employes';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'EmployeID';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
