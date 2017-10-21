<?php

namespace App\Repositories;

use App\Models\Mail;
use InfyOm\Generator\Common\BaseRepository;

class MailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'from',
        'cc',
        'bcc',
        'replyto',
        'subject',
        'content'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Mail::class;
    }
}
