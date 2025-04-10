<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryAccess extends Model
{
    use HasFactory;

    protected $fillable = ['owner_id', 'viewer_id'];
}
