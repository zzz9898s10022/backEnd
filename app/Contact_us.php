<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property int $phone
 * @property string $message
 * @property string $created_at
 * @property string $updated_at
 */
class Contact_us extends Model
{

    protected $table = 'Contact_us';
    protected $fillable = ['name', 'email', 'phone', 'message', 'created_at', 'updated_at'];
    protected $keyType = 'integer';




}
