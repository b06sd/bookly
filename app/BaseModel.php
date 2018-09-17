<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class BaseModel extends Model implements Authenticatable
{

    use Notifiable, AuthenticableTrait, Uuids;

    public $incrementing = false;
}
