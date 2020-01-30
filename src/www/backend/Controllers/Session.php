<?php

namespace Backend\Controllers;

use Backend\Models\Sessions;

class Session
{
  protected $dbaccess;

  public function __construct($container)
  {
    $this->dbaccess = $container->get('db');

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

  public function _read($session_id)
  {
    $execute = Sessions::select('data')->where('id', $session_id)->first();

    if(!is_null($execute))
    {
     return $execute->data;
    }
    return '';
  }

  public function _write($session_id, $data)
  {
    $execute = Sessions::updateOrInsert(
        ['id' => $session_id],
        ['access' => REQUEST_TIME, 'data' => $data]
    );
    if($execute){ return true; }
    return false;
  }

  public function _destroy($session_id)
  {
    $execute = Sessions::where('id', $session_id)->delete();
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
