<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'expense_name',
        'expense_details',
        'expense_amount',
        'expense_date'
    ];

    protected $casts = [
        'expense_amount' => 'integer'
    ];

    protected $dates = ['expense_date'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOfLoggedInUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }
}
