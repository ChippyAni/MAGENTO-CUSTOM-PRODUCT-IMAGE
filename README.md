# Azquards_ProductType Module

## Introduction
This module, Azquards_ProductType, set product type value Custom/Standard. By default product type value is Standard.
If product type value is Custom , the product image is replaced by an external url image

## API Endpoint
The API endpoint for setting the product type is:
POST {{baseUrl}}/rest/V1/set-product-type

## Request Parameters
- `sku`: The SKU of the product for which you want to set the type.
- `type`: The type of product to be set. (e.g., Standard)

## Authorization
To access the API and make changes, you need to provide an admin bearer token in the request header.

