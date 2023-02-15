<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Translation\HasLocalePreference;

class Client extends Authenticatable implements HasLocalePreference
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $guard ='client';
    protected $fillable = [
        'name',
        'email',
        'password',
        'locale',
        'code_number',
        'phone',
        'status',
        'country',
        'address',
        'id_photo',

    ];



    protected $hidden = [

        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_path',
    ];


    public function preferredLocale()
    {
        return $this->locale;
    }



    public function tracking()
    {
       return $this->hasMany(Tracking::class,'code_number','code_number');
   }

   public function Invoices()
   {
      return $this->hasMany(ClientInvoices::class,'code_number','code_number');
  }
  public function ClientAccount()
  {
     return $this->belongsTo(ClientAccount::class,'id','client_id');
 }

 public function ClientPayment()
 {
    return $this->belongsTo(Payment::class,'id','client_id');
}


}
