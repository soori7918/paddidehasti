<?php

namespace App\Notifications;

use App\Models\Padideh\WasteOrderHead;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateWasteOrder extends Notification
{
    use Queueable;

    protected $order;
    protected $content;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(WasteOrderHead $waste_order,$content)
    {
        $this->waste_order = $waste_order;
        $this->content = $content;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    
    public function toArray($notifiable)
    {
        return [
            'content' => $this->content,
            'waste_id' => $this->waste_order->id, 
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'content' => $this->content,
            'waste_order' => $this->waste_order->id,
        ];
    }


}
