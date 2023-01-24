<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = ['new_id','comment', 'name', 'user_id'];

    public function blogPost(){
        return $this->BelongsTo(BlogPost::class);
    }

}
