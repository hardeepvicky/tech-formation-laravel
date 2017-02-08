<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends AppModel implements Authenticatable
{
    use SoftDeletes;
    
    protected $fillable = ["role_id", 'first_name', "last_name", "email", "password", "password_confirmation", "remember_token", "permissions", 'is_active'];
    
    public $sortable = ['email', 'first_name', "last_name", "is_active"];
    
    public function beforeSave()
    {
        //only set hash password if confirm_pasword is there
        if (isset($this->attributes["password"]) && isset($this->attributes["password_confirmation"]))
        {
            $this->setAttribute("password", Hash::make(trim($this->attributes["password"])) );      
        }
        
        unset($this->password_confirmation);
        
        return parent::beforeSave();
    }
    
    public function Role()
    {
        return $this->belongsTo("App\Role", "role_id");
    }
    
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }
    
    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return "id";
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return "remember_token";
    }
}