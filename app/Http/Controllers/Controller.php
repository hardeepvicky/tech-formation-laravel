<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use App\EmailLog;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function email($from, $to, $subject, $content = [], $view = "emails.default", $attachments = [])
    {
        $data['content'] = $content;
        
        Mail::queue($view, $data, function ($message) use($from, $to, $subject, $content, $attachments)
        {
            EmailLog::create([
                'from_email' => $from['email'],
                'to_email' => $to['email'],
                'subject' => $subject,
                'body' => $content
            ]);

            $message->subject($subject);
            
            $message->from($from['email'], $from['name']);
            $message->from($to['email'], $to['name']);
            
            foreach($attachments as $file)
            {
                $message->attach($file);
            }
        });
    }
}
