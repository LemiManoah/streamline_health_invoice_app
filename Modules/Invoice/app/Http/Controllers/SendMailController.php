<?php

namespace Modules\Invoice\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Modules\Invoice\Emails\InvoiceMail;

class SendMailController extends Controller
{
    public function sendMailWithAttachment(Request $request){
        $mailData = [
            'title' => 'This is Test Mail',
            'files' => [
                public_path('attachments/test_image.jpeg'),
                public_path('attachments/test_pdf.pdf'),
            ]
        ];
           
        Mail::to('mazemelo110@gmail.com')->send(new InvoiceMail($mailData));
             
        echo "Mail send successfully !!";
    }
    
}
