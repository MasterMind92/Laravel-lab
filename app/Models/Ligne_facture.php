<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ligne_facture extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "Description",
        "Quantite",
        "PrixUnitaire",
        "TVA",
        "TotalLigne",
        "TypeLigne",
    ];


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ligne_factures';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'LigneID';

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
