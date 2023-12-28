<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'note', 'attachment', 'is_recurring', 'is_installment', 'recurring_period', 'installment_period', 'category_id', 'spending', 'total', 'type', 'category_id'];
}
