<?php declare(strict_types=1);

namespace App\Models\Staff\Setters;

use App\Models\User;
use Illuminate\Support\Carbon;

class UserCertificationSetter
{
    use EntityTrait;

    /**
     * @var User
     */
    protected $entity;

    public function __construct(User\UserCertification $certification)
    {
        $this->entity = $certification;
    }

    public function wasCertified(): UserCertificationSetter
    {
        return $this->setCertifiedAt(now());
    }

    public function setCertifiedAt(?Carbon $carbon = null): UserCertificationSetter
    {
        return $this->setAttribute('certified_At', $carbon);
    }

    public function resetCertifiedAt(): UserCertificationSetter
    {
        return $this->setCertifiedAt();
    }

    public function setStatus($status): UserCertificationSetter
    {
        return $this->setAttribute('status', $status);
    }
}