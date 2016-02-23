<?php

namespace Hcapi\Services;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class ProductsAvailability extends AbstractService
{

    const KEY_PRODUCTS = 'products';
    const KEY_PRICE_SUM = 'priceSum';
    const KEY_RELATED = 'related';
    const KEY_PARAMS = 'params';

    const PRODUCT_ID = 'id';
    const PRODUCT_COUNT = 'count';
    const PRODUCT_AVAILABLE = 'available';
    const PRODUCT_DELIVERY = 'delivery';
    const PRODUCT_NAME = 'name';
    const PRODUCT_PRICE = 'price';
    const PRODUCT_PRICE_TOTAL = 'priceTotal';

    const RELATED_TITLE = 'title';

    const PARAMS_TYPE = 'type';
    const PARAMS_NAME = 'name';
    const PARAMS_UNIT = 'unit';
    const PARAMS_VALUES = 'values';

    const VALUES_ID = 'id';
    const VALUES_DEFAULT = 'default';
    const VALUES_VALUE = 'value';
    const VALUES_PRICE = 'price';

    const PARAMS_TYPE_INPUT = 'input';
    const PARAMS_TYPE_TEXT = 'text';
    const PARAMS_TYPE_SELECTBOX = 'selectbox';
    const PARAMS_TYPE_MULTISELECTBOX = 'multiselectbox';

    public function __construct()
    {
        $this->validator = new \Hcapi\Validators\ProductsAvailability();
    }

}
