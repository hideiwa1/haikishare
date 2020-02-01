<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\ProductMail;

class MailController extends Controller
{
    public function saleMail(){
        $text = '登録した商品が購入されました。';
        Mail::to($to)->send(new ProductMail($name, $text));
    }
}
