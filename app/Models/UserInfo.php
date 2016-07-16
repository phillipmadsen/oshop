<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
	protected $table = "userinfo";

	protected $fillable = [
		'user_id', 'firstname', 'lastname', 'display_name', 'slug', 'photo', 'website', 'company', 'gender', 'about_me', 'note', 'address', 'state', 'city', 'zipcode', 'country', 'phone', 'skypeid', 'githubid', 'twitter_username', 'instagram_username', 'facebook_username', 'facebook_url', 'linked_in_url', 'google_plus_url', 'birth_date', 'dob_month', 'dob_day', 'dob_year'
		];

	public function user()
	{
		return $this->belongsTo(App\User::class);
	}
}
