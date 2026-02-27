<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fournisseurs extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "Nom",
        "Type",
        "Contact",
        "Téléphone",
        "Email",
        "Adresse",
        "etat",
        "created_at",
        "updated_at",
        "deleted_at",
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fournisseurs';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'FournisseurID';

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
