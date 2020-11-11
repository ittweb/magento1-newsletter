# Magento 1 Newsletter API
## Module for Vue Storefront 1.x

This module gives the ability to connect the Magento 1 newsletter with Vue Storefront.

## IMPORTANT

To work correctly this module needs the installation of the module for the [Vue Storefront API](https://github.com/ittweb/vsfapi-magento1-newsletter)

### API Endpoint
The structure for all the endpoints is: `/ittweb_newsletter/index/METHOD_NAME`.

The `email` parameter is always request, as a BODY in JSON format.

### Methods name

check => returns 200 if the user is subscribed, 501 otherwise

subscribe => returns 500 if the operation fail

unsubscribe => like above

## Module for Magento 2
The same module for Magento 2 is available on [GitHub](https://github.com/ittweb/magento2-newsletter-api). Also the "bridge" between Magento 2 and VSF-API is on [GitHub](https://github.com/ittweb/vsfapi-magento2-newsletter).