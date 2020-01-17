<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'slug'
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOfLoggedInUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    // public function totalExpense()
    // {
    //     return $this->expenses()
    //         ->selectRaw('sum(expense_amount) as expense_amount, category_id')->groupBy('category_id');
    // }
}
