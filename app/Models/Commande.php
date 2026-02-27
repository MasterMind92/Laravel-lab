<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
   use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "DateCommande",
        "DateLivraisonPrévue",
        "DateLivraisonRéelle",
        "Statut",
        "MontantTotal",
        "Etat",
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'commandes';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'CommandeID';

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
