<?php

namespace Austro\Crm;

use Austro\Crm\Http\Controllers\Records\AustroCrmAccountController;
use Austro\Crm\Http\Controllers\Records\AustroCrmAvailabilityController;
use Austro\Crm\Http\Controllers\Records\AustroCrmExcessController;
use Austro\Crm\Http\Controllers\Records\AustroCrmInvoiceController;
use Austro\Crm\Http\Controllers\Records\AustroCrmLeadController;
use Austro\Crm\Http\Controllers\Records\AustroCrmManufactureController;
use Austro\Crm\Http\Controllers\Records\AustroCrmProductController;
use Austro\Crm\Http\Controllers\Records\AustroCrmQuoteController;
use Austro\Crm\Http\Controllers\Records\AustroCrmRFQController;
use Austro\Crm\Http\Controllers\Records\AustroCrmSaleOrderController;
use Austro\Crm\Http\Controllers\Records\AustroCrmStatementController;
use Austro\Crm\Http\Controllers\Records\AustroCrmTaskController;

class AustroCrm
{
    public static function productsSearch($phrase)
    {
        return AustroCrmProductController::search($phrase);
    }

    public static function getLatestProducts($count)
    {
        return AustroCrmProductController::getLatestProducts($count);
    }

    public static function productsSearchByNameAndManufacturerId($product_name, $manufacture_id)
    {
        return AustroCrmProductController::searchByNameAndManufacturerId($product_name, $manufacture_id);
    }

    public static function productsSearchById($product_id)
    {
        return AustroCrmProductController::productsSearchById($product_id);
    }

    public static function getProductsByIds($ids)
    {
        return AustroCrmProductController::getProductsByIds($ids);
    }

    public static function getProductAvailability($product_id, $days)
    {
        return AustroCrmProductController::getProductAvailability($product_id, $days);
    }

    public static function getProductAvailabilityCondition($product_id, $created_at = null, $fields = null, $conditions = null)
    {
        return AustroCrmProductController::getProductAvailabilityCondition($product_id, $created_at, $fields, $conditions);
    }

    public static function getProductExcesses($product_id, $days)
    {
        return AustroCrmProductController::getProductExcesses($product_id, $days);
    }

    public static function createSingleProduct($data)
    {
        return AustroCrmProductController::createSingleProduct($data);
    }

    public static function getProductLookUp($data)
    {
        return AustroCrmProductController::getProductLookUp($data);
    }

    public static function manufacturesSearch($name)
    {
        return AustroCrmManufactureController::search($name);
    }

    public static function createManufacture($data)
    {
        return AustroCrmManufactureController::create($data);
    }

    public static function getLeadByEmailAddress($email)
    {
        return AustroCrmLeadController::getLeadByEmailAddress($email);

    }

    public static function createLead($email)
    {
        return AustroCrmLeadController::create($email);

    }

    public static function excessSearchById($excess_id)
    {
        return AustroCrmExcessController::excessSearchById($excess_id);
    }

    public static function createSingleExcess($data)
    {
        return AustroCrmExcessController::createSingleExcess($data);
    }

    public static function availabilitySearchById($excess_id)
    {
        return AustroCrmAvailabilityController::availabilitySearchById($excess_id);
    }

    public static function createSingleAvailability($data)
    {
        return AustroCrmAvailabilityController::createSingleAvailability($data);
    }

    public static function createSingleRFQ($data)
    {
        return AustroCrmRFQController::createSingleRFQ($data);

    }

    public static function rfqSearchById($rfq_id)
    {
        return AustroCrmRFQController::rfqSearchById($rfq_id);
    }

    public static function createRfqFromBom($masterBomId, $masterBomItemDetails, $contact)
    {
        return AustroCrmRFQController::createRfqFromBom($masterBomId, $masterBomItemDetails, $contact);

    }

    public static function createSingleRFQAlternative($rfq_id, $product_id)
    {
        return AustroCrmRFQController::createSingleRFQAlternative($rfq_id, $product_id);

    }

    public static function saleOrderSearchById($salesorder_id)
    {
        return AustroCrmSaleOrderController::saleOrderSearchById($salesorder_id);
    }

    public static function getSaleOrderPDF($salesorder_id)
    {
        return AustroCrmSaleOrderController::getSaleOrderPDF($salesorder_id);
    }

    public static function invoiceSearchById($invoice_id)
    {
        return AustroCrmInvoiceController::invoiceSearchById($invoice_id);
    }

    public static function getInvoicePDF($invoice_id)
    {
        return AustroCrmInvoiceController::getInvoicePDF($invoice_id);
    }

    public static function getAustroCrmAccount($account_id)
    {
        return AustroCrmAccountController::getCrmAccountById($account_id);
    }

    public static function getAccountRFQs($account_id, $fields = null, $conditions = null)
    {
        return AustroCrmAccountController::getAccountRFQs($account_id, $fields, $conditions);
    }

    public static function getAccountQuotes($account_id, $fields = null, $conditions = null)
    {
        return AustroCrmAccountController::getAccountQuotes($account_id, $fields, $conditions);
    }

    public static function getAccountSaleOrders($account_id, $fields = null, $conditions = null)
    {
        return AustroCrmAccountController::getAccountSaleOrders($account_id, $fields, $conditions);
    }

    public static function getAccountInvoices($account_id, $fields = null, $conditions = null)
    {
        return AustroCrmAccountController::getAccountInvoices($account_id, $fields, $conditions);
    }

    public static function getQuoteById($quote_id)
    {
        return AustroCrmQuoteController::getCrmQuoteById($quote_id);
    }

    public static function getQuotePDF($quote_id)
    {
        return AustroCrmQuoteController::getQuotePDF($quote_id);
    }

    public static function createSingleTask($data)
    {
        return AustroCrmTaskController::createSingleTask($data);
    }

    public static function panelStatistics()
    {
        return AustroCrmStatementController::panelStatistics();
    }

    public static function panelRfqStatisticsMonthly()
    {
        return AustroCrmStatementController::panelRfqStatisticsMonthly();
    }
}
