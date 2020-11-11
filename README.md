# Magento 1 Newsletter API
## Modulo per Vue Storefront 1.x

Questo modulo nasce per integrare la funzionalità della newsletter di Vue Storefront con Magento 1.
Ciò non toglie che possa essere usato anche per altri scopi, dal momento che questa API è agnostica e sganciata da VSF.

### Struttura endpoint
Gli endpoint che vengono creati sono tutti formati così: `/ittweb_newsletter/index/NOME_METODO`.

Ai vari endpoint va passato il parametro `email`, come BODY in formato JSON.

### Metodi a disposizione

check => restituisce 200 se l'utente è iscritto, 501 in caso negativo

subscribe => restituisce 500 se l'operazione fallisce

unsubscribe => come sopra

## Modulo per Magento 2
Il modulo equivalente per Magento 2, sempre realizzato da ITTweb, è disponibile su [GitHub](https://github.com/ittweb/magento2-newsletter-api). Il relativo "aggancio" tra Magento 2 e VSF-API è anch'esso presente su [GitHub](https://github.com/ittweb/vsfapi-magento2-newsletter).