<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends BaseModel
{
  protected $table = 'books';
  protected $primaryKey = 'id';
  protected $keyType = 'string';
}
