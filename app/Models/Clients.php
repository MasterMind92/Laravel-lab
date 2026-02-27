<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "Nom",
        "Prenom",
        "Email",
        "Telephone",
        "Adresse",
        "DateNaissance",
        "TypeClient",
        "Statut",
        "PointsFidelite",
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    /**
     * retrouve la reservations associee a l'appartements
     */
    // public function appartement(): HasOne
    // {
    //     return $this->hasOne(Apartements::class);
    // }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ClientID';

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
