<?php

namespace App\Mail;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarCorreoLinkCaido extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Link Caido';
    public $lesson;
    public $section;
    public $course;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Lesson $lesson, Section $section, Course $course)
    {
        //
        $this->lesson = $lesson;
        $this->section = $section;
        $this->course = $course;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.linkCaido');
    }
}
