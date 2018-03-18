<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket';
    protected $primaryKey = 'ticket_id';
    protected $guarded = [
        'ticket_id',
    ];

    public function terminal(){
        return $this->belongsTo(Ticket::Class, '	terminal_id');
    }

}
