<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keahlian extends Model
{
    use HasFactory;

    protected $table = 'keahlian';

    protected $fillable = [
        'name',
        'ic_number',
        'email',
        'phone',
        'address',
        'postcode',
        'city',
        'state',
        'occupation',
        'employer',
        'previous_membership_number',
        'previous_membership_year',
        'physical_card',
        'document_path',
        'status',
        'no_ahli',
    ];

    protected $casts = [
        'physical_card' => 'boolean',
    ];

    public function getDisplayIdAttribute(): string
    {
        if ($this->status === 'disahkan' && $this->no_ahli) {
            return $this->no_ahli;
        }
        return 'P' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }

    public function getNamaNegeriAttribute(): string
    {
        $negeri = [
            'johor' => 'Johor',
            'kedah' => 'Kedah',
            'kelantan' => 'Kelantan',
            'melaka' => 'Melaka',
            'negeri_sembilan' => 'Negeri Sembilan',
            'pahang' => 'Pahang',
            'perak' => 'Perak',
            'perlis' => 'Perlis',
            'pulau_pinang' => 'Pulau Pinang',
            'sabah' => 'Sabah',
            'sarawak' => 'Sarawak',
            'selangor' => 'Selangor',
            'terengganu' => 'Terengganu',
            'wp_kuala_lumpur' => 'WP Kuala Lumpur',
            'wp_labuan' => 'WP Labuan',
            'wp_putrajaya' => 'WP Putrajaya',
        ];
        return $negeri[$this->state] ?? ucfirst($this->state);
    }

    public static function namaNegeri(string $state): string
    {
        $negeri = [
            'johor' => 'Johor',
            'kedah' => 'Kedah',
            'kelantan' => 'Kelantan',
            'melaka' => 'Melaka',
            'negeri_sembilan' => 'Negeri Sembilan',
            'pahang' => 'Pahang',
            'perak' => 'Perak',
            'perlis' => 'Perlis',
            'pulau_pinang' => 'Pulau Pinang',
            'sabah' => 'Sabah',
            'sarawak' => 'Sarawak',
            'selangor' => 'Selangor',
            'terengganu' => 'Terengganu',
            'wp_kuala_lumpur' => 'WP Kuala Lumpur',
            'wp_labuan' => 'WP Labuan',
            'wp_putrajaya' => 'WP Putrajaya',
        ];
        return $negeri[$state] ?? ucfirst($state);
    }
}
