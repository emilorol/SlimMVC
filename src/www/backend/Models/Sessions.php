<?php

namespace Backend\Models;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{

  protected $table = 'sessions';

  protected $primaryKey = 'id'; // or null

  public $incrementing = false;

  protected $fillable = [
                          'access',
                          'data',
                        ];
}
