<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaires extends Model
{
    // use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "Reference",
        "Libelle",
        "Categorie",
        "QuantiteStock",
        "SeuilMin",
        'fkAppart',
        'fkCommande',
        "Localisation",
        "Etat",
    ];

    /**
     * retrouve la reservations associee a l'appartements
     */
    public function appartement(): BelongsTo
    {
        return $this->belongsTo(Appartements::class,'fkAppart');
    }


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventaires';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ArticleID';

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
