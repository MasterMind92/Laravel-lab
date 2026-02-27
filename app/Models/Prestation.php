<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "HeureDebut",
        "HeureFin",
        "Statut",
        "Satisfaction",
        "created_at",
        "updated_at",
        "deleted_at",
    ];
    /**
     * retrouve la reservations associee a l'appartements
     */
    public function appartement(): HasOne
    {
        return $this->hasOne(Apartements::class);
    }


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prestations';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'PrestationID';

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
