<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Educatrice extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom_fr',
        'nom_ar',
        'prenom_fr',
        'prenom_ar',
        'cin',
        'etablissement',
        'niveau_scolaire',
        'annees_experience',
        'email',
        'telephone',
        'date_naissance',
        'type_etablissement',
        'status',

    ];
     protected $casts = [
        'date_naissance' => 'date',
    ];

    /**
     * Get the full name in French.
     */
    public function getNomCompletFrAttribute()
    {
        return $this->prenom_fr . ' ' . $this->nom_fr;
    }

    /**
     * Get the full name in Arabic.
     */
    public function getNomCompletArAttribute()
    {
        return $this->prenom_ar . ' ' . $this->nom_ar;
    }
    public function getAgeAttribute()
    {
        return $this->date_naissance 
            ? Carbon::parse($this->date_naissance)->age 
            : null;
    }
}