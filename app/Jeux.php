<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jeux extends Model
{
    protected $table = "jeux";

    protected $fillable = ["nom", "editeur", "prix", "description"];
}
