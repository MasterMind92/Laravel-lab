<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occupant extends Model
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
        "DateNaissance",
        "LienClientPrincipal",
        "Etat",
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
    protected $table = 'occupants';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'OccupantID';

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
