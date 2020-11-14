<?php

namespace App\Wax\Shop\Validators;

use App\Wax\Shop\Models\Coupon;
use App\Wax\Shop\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Wax\Shop\Validators\AbstractValidator;

class OrderCouponValidator extends AbstractValidator
{
    /**
     * @var Order
     */
    private Order $order;
    /**
     * @var Coupon
     */
    private Coupon $coupon;

    public function __construct(Order $order, Coupon $coupon)
    {
        $this->order = $order;
        $this->coupon = $coupon;
    }

    public function passes(): bool
    {
        $this->messages = new MessageBag();

        $this->validateSingleUse();
        $this->validateLoggedIn();
        $this->validateNotExpired();
        $this->validateOrderMinimum();
        $this->validateNumberOfUses();
        $this->validateUserHasNotUsedBefore();
        $this->validateCategoryMatches();

        return $this->messages->isEmpty();
    }

    protected function validateSingleUse()
    {
        if (! $this->coupon->one_time) {
            return;
        }

        if ($this->coupon->uses === 0) {
            return;
        }

        $this->errors()->add(
            'general',
            __('shop::coupon.validation_too_many_uses')
        );
    }

    protected function validateLoggedIn()
    {
        if ($this->coupon->one_time) {
            return;
        }

        if (! Auth::check()) {
            $this->errors()->add(
                'general',
                __('shop::coupon.validation_not_logged_in')
            );
        }
    }

    protected function validateNotExpired()
    {
        //validate expiration
        if (!is_null($this->coupon->expired_at) && $this->coupon->expired_at->isPast()) {
            $this->errors()->add(
                'general',
                __('shop::coupon.validation_expired')
            );
        }
    }

    protected function validateOrderMinimum()
    {
        // validate minimum order
        if ($this->order->discountable_total < $this->coupon->minimum_order) {
            $this->errors()->add(
                'general',
                __('shop::coupon.validation_minimum')
            );
        }
    }

    protected function validateNumberOfUses()
    {
        if (is_null($this->coupon->permitted_uses)) {
            return;
        }

        if ($this->coupon->uses >= $this->coupon->permitted_uses) {
            $this->errors()->add(
                'general',
                __('shop::coupon.validation_too_many_uses')
            );
        }
    }

    public function validateUserHasNotUsedBefore()
    {
        if ($this->coupon->one_time) {
            return;
        }

        if (! Auth::check()) {
            $this->errors()->add(
                'general',
                __('shop::coupon.validation_not_logged_in')
            );

            return;
        }

        $hasUsedBefore = Auth::user()
            ->orders()
            ->with('coupon')
            ->placed()
            ->whereHas('coupon')
            ->get()
            ->pluck('coupon.code')
            ->contains($this->coupon->code);

        if ($hasUsedBefore) {
            $this->errors()->add(
                'general',
                __('shop::coupon.validation_user_used_before')
            );
        }
    }

    public function validateCategoryMatches()
    {
        if (is_null($this->coupon->category_id)) {
            return;
        }

        $categoryIds = $this->order
            ->items
            ->map(fn($item) => $item->listing)
            ->pluck('categories')
            ->flatten()
            ->pluck('id');

        if ($categoryIds->contains($this->coupon->category_id)) {
            return;
        }

        $this->errors()->add(
            'general',
            __('shop::coupon.validation_category', ['breadcrumb' => $this->coupon->category->breadcrumb])
        );
    }
}
