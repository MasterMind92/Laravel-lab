<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appartements extends Model
{
    // use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "Code",
        "Type",
        "Surface",
        "Etage",
        "CapaciteMax",
        "Etat",
        "DernierNettoyage",
        'DateDerniereRenovation',
        'Observations',
    ];

    /**
     * retrouve la reservations associee a l'appartements
     */
    public function reservation(): HasOne
    {
        return $this->hasOne(Reservation::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'apartements';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'AppartementID';

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
