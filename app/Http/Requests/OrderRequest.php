<?php declare(strict_types=1);

namespace App\Http\Requests;

use App\Enum\OrderDeliveryTypeEnum;
use App\Enum\OrderPaymentTypeEnum;
use Illuminate\Validation\Rule;

class OrderRequest extends AbstractRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'string|required|max:255',
            'phone' => 'max:25',
            'delivery_type' => ['required', Rule::in(OrderDeliveryTypeEnum::$enums)],
            'payment_type' => ['required', Rule::in(OrderPaymentTypeEnum::$enums)],
            'street' => 'max:255',
            'porch' => 'max:255',
            'building' => 'max:255',
            'flat_num' => 'max:15',
            'floor' => 'max:255',
            'delivery_data' => 'max:255',
            'persons' => 'max:255',
            'comment' => 'max:255',
        ];

        return $rules;
    }

}
