<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GrahamCampbell\Markdown\Facades\Markdown;

class ClientSay extends Model
{
    use HasFactory;
    //protected $fillable = [ ];
    protected $guarded = ['id'];

    public function getExcerptHtmlAttribute($value){
        
        return $this->client_quote ? Markdown::convertToHtml(e($this->client_quote)):NULL;
      }
}
