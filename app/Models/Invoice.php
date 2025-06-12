<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {
    protected $fillable = ['user_id', 'number', 'description', 'amount', 'status', 'due_date'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    


    // Invoice.php

public function service()
{
    return $this->belongsTo(services_table::class, 'service_id');
}

public function solution()
{
    return $this->belongsTo(SolutionTable::class, 'solution_id');
}

}


