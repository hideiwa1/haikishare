<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $text;
    
    public function __construct($title, $name='テスト名前', $text='テスト本文', $product, $visit="", $url)
    {
        $this->title = $title;
        $this->name = 'こんにちは、'.$name.'さん';
        $this->text = $text;
        $this->product = $product;
        $this->visit = $visit;
        $this->url = $url;
    }

    public function build()
    {
        return $this->view('email.productEmail')
            ->subject($this->title)
            ->with([
                'title' => $this->title,
                'name' => $this->name,
                'text' => $this->text,
                'product' => $this->product,
                'visit' => $this->visit,
                'url' => $this->url,
            ]);
    }
}
