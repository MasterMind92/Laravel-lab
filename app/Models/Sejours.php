<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sejours extends Model
{
   use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "DateCheckIn",
        "HeureCheckIn",
        "DateCheckOut",
        "HeureCheckOut",
        "NbOccupantsReels",
        "CleRemise",
        "CautionVersee",
        "MontantCaution",
        "CautionRemboursée",
        "created_at",
        "updated_at",
        "deleted_at",
    ];
    
    /**
     * retrouve la reservations associee a l'appartements
     */
    public function facture(): HasMany
    {
        return $this->hasMany(Facture::class);
    }


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sejours';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'SejourID';

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
