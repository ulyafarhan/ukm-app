<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'file_path', 'document_category_id', 'user_id'];
    public function category(): BelongsTo { /* ... */ }
    public function uploader(): BelongsTo { return $this->belongsTo(User::class, 'user_id'); }
}