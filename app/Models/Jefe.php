<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Helpers\Helper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Jefe extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'jefe';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rubrica_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function departamento($departamento){
        return $this->hasMany(Departamento::class)
            ->where('departamento.abreviatura_departamento', '=', $departamento)
            ->first()
            ;
    }

    public function departamentos(){
        return $this->hasMany(Departamento::class);
    }

    public function abreviaturaDepartamentos(){
        return $this->hasMany(Departamento::class)
            ->select('departamento.abreviatura_departamento')
        ;
    }

    public function getNombreCompletoConTitulo(){
        return ucwords($this->titulo . ". " . $this->user->getNombreCompleto());
    }
}
