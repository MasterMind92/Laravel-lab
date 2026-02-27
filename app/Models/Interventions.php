<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interventions extends Model
{   
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "DateDemande",
        "DateIntervention",
        "Type",
        "Description",
        "Priorite",
        "CoutMateriel",
        "CoutMainOeuvre",
        "Statut",
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    /**
     * retrouve la reservations associee a l'appartements
     */
    public function employe(): HasMany
    {
        return $this->hasMany(Employes::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'interventions';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'InterventionID';

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
