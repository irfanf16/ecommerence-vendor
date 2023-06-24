<?php
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotifyEvent implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $name;

  public function __construct($name)
  {
      $this->name = $name;
  }

  public function broadcastOn()
  {
      return new channel('notify-user');
  }

  public function broadcastAs()
  {
      return 'notify-event';
  }
}