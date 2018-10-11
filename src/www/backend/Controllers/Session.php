<?php

namespace Backend\Controllers;

use Backend\Models\Sessions;

class Session
{
  protected $db;

  public function __construct($container)
  {
    $this->db = $container['db'];

    session_set_save_handler(
                              [$this, '_open'],
                              [$this, '_close'],
                              [$this, '_read'],
                              [$this, '_write'],
                              [$this, '_destroy'],
                              [$this, '_gc']
                            );

    if (session_status() !== PHP_SESSION_ACTIVE)
    {
      session_start();
    }
  }

  public function _open()
  {
    return true;
  }

  public function _close()
  {
    return true;
  }

  public function _read($id)
  {
    $execute = Sessions::select('data')->where('id', $id)->first();

    if(!is_null($execute))
    {
     return $execute->data;
    }else{
     return '';
    }
  }

  public function _write($id, $data)
  {
    $execute = Sessions::updateOrInsert(
        ['id' => $id],
        ['access' => REQUEST_TIME, 'data' => $data]
    );
    if($execute){ return true; }
    return false;
  }

  public function _destroy($id)
  {
    $execute = Sessions::where('id', $id)->delete();
    if($execute){ return true; }
    return false;
  }

  public function _gc($max)
  {
    // Calculate what is to be deemed old
    $old = REQUEST_TIME - $max;
    $execute = Sessions::where('access', '<', $old)->delete();
    if($execute){ return true; }
    return false;
  }

}
