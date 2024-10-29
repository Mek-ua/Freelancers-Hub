<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
        'proposals_id',
        'start_date',
        'end_date',
        'term_and_conditions',
        'file',
        'pro_is_finished',
        'client_is_finished',
        'service_fee_status',
        'acceptance_status',
        'user_id',
        'service_fee_id',
    ];

    // Relationship to Proposal
    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposals_id');
    }

    // Relationship to User (the owner of the contract)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to ServiceFee
    public function serviceFee()
    {
        return $this->belongsTo(ServiceFee::class, 'service_fee_id');
    }
}
