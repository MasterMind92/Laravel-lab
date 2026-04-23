<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservations extends Model
{
    // use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "Numero",
        "DateArrivee",
        "DateDepart",
        "NbAdultes",
        "NbEnfants",
        "Statut",
        'fkClient',
        'fkAppart',
        "Source",
        "Notes",
    ];
    
    /**
     * retrouve la reservations associee a l'appartements
     */
    public function appartement(): BelongsTo
    {
        return $this->belongsTo(Appartements::class,'fkAppart');
    }

    /**
     * retrouve la reservations associee a l'appartements
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Clients::class,'fkClient');
    }


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reservations';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ReservationID';

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
