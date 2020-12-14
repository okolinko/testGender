/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * @api
 */
define([
	'jquery',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/shipping-save-processor'
], function ($, quote, shippingSaveProcessor) {
    'use strict';

    return function () {
        var shippingAddress = quote.shippingAddress();
        if (shippingAddress['extension_attributes'] === undefined) {
shippingAddress['extension_attributes'] = {};
        }
        shippingAddress['extension_attributes']['gender_toppik'] = $('.gender_toppik :checked').val();

        quote.shippingAddress(shippingAddress);

        return shippingSaveProcessor.saveShippingInformation(quote.shippingAddress().getType());
    };
});

