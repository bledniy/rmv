<?php


namespace App\Models\Staff\Setters;


use App\Models\User;
use Illuminate\Support\Carbon;

class UserSetter
{
    use EntityTrait;

    /**
     * @var User
     */
    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function setLastSeen(?Carbon $carbon = null)
    {
        $carbon = $carbon ?? now();

        return $this->setAttribute('last_seen_at', $carbon);
    }

    public function setAuthenticatedAt(?Carbon $carbon = null)
    {
        $carbon = $carbon ?? now();

        return $this->setAttribute('authenticated_at', $carbon);
    }

    public function setPhone($attr)
    {
        $this->setAttribute('phone', $attr);

        return $this;
    }

    public function setEmail($attr)
    {
        $this->setAttribute('email', $attr);

        return $this;
    }

    public function setType($attr)
    {
        $this->setAttribute('type', $attr);

        return $this;
    }

    public function setPerformerReviewsCount($count)
    {
        return $this->setAttribute('reviews_count', $count);
    }

    public function setCustomerReviewsCount($count)
    {
        return $this->setAttribute('customer_reviews_count', $count);
    }

    public function setPhoneVerifiedAt(Carbon $at)
    {
        $this->setAttribute('phone_verified_at', $at);

        return $this;
    }

    public function setEmailVerifiedAt(Carbon $at)
    {
        $this->setAttribute('email_verified_at', $at);

        return $this;
    }

    public function setLanguageId($value)
    {
        $this->setAttribute('language_id', $value);

        return $this;
    }


}