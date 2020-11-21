<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $fillable = [
        'address', 'phone_number', 'birthday', 'profile_photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profileImage()
    {
        $imagePath = ($this->profile_photo) ? $this->profile_photo : 'profile/No-Photo-Available.jpg';
        return '/storage/' . $imagePath;
    }
}