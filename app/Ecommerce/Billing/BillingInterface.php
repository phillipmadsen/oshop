<?php namespace Ecommerce\Billing;

interface BillingInterface
{
    public function charge(array $data);
}
