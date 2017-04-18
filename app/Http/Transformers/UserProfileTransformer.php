<?php
namespace App\Http\Transformers;

use App\Models\UserProfile;
use League\Fractal\TransformerAbstract;

class UserProfileTransformer extends TransformerAbstract
{
    public function transform(UserProfile $profile)
    {
        return [
            'user_id' => $profile->user_id,
            'card_id' => $profile->card_id,
            'real_name' => $profile->real_name,
            'gender' => $profile->gender,
            'address' => $profile->address
        ];
    }
}