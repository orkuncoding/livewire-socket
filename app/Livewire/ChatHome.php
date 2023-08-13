<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\ChatMessage;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatHome extends Component
{

    public $message = null;
    public $chatMessages = [];


    public function mount()
    {
        $this->chatMessages = ChatMessage::with('user')->orderBy('created_at', 'DESC')->take(5)->get()->reverse();
    }

    #[On('echo:Messages,MessageSent')]
    public function listenMessages()
    {
        $this->chatMessages = ChatMessage::with('user')->orderBy('created_at', 'DESC')->take(5)->get()->reverse();
    }


    public function addMessage()
    {
       $mesaj = ChatMessage::create([
            'user_id' => auth()->id(),
            'message' => $this->message
        ]);

       MessageSent::dispatch($mesaj);
        $this->message = null;
    }



    public function render()
    {
        return view('livewire.chat-home');
    }
}
