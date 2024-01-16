<?php

use App\Models\Company;
use App\Models\Invoice;
use App\Models\LineItem;

test('company has one invoice', function() {
    $company = Company::factory()->create();
    $invoice = Invoice::factory()
        ->recycle($company)
        ->create();
    
    expect($company->invoices->count())->toBe(1);
});

test('invoice total is 22.76', function() {
    $invoice = Invoice::factory()->create();
    LineItem::factory()
        ->count(2)
        ->sequence(
            ['amount' => 1.50],
            ['amount' => 21.26]
        )
        ->recycle($invoice)
        ->create();

    expect($invoice->total)->toBe(22.76);
    
});

