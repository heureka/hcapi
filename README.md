**Heureka cart API**
----------
Hcapi is a tool created for easier connection between shopping adviser Heureka.cz and shops which users of these services and shopping cart want.

**Usage**
-------

**Install by composer:**

    composer require heureka/hcapi


**Implementation**
------------
In this section you will find the manual for hcapi implementation to your project. 

Connection via Callables
------------------------

First way how to connect your shop by HCAPI is using Callable callback.

In your code must create functions (for all services), which receive data from Heureka (array), process them and return 
required data (array). Structure of required data you can find [there](http://sluzby.heureka.cz/napoveda/kosik-api/). 
 
Example of function for **Payment/Status**:

    //PaymentStatus.php
    
    public function setPaymentStatus($receiveData)
        {
            //set payment status for order
    
            return [
                'status' => false,
            ];
        }
        
In second step you must connect these functions with your routing. You must use specific service for every from API methods.
For example **Payment/Status**:
    
    //Router.php
    
    if ($_SERVER['REQUEST_URI'] === 'https://www.example.com/api/1/payment/status') {
                $service = new PaymentStatus();
                return $service->processData(
                    [
                        'Hcapi\Example\CallableExample\PaymentStatus',
                        'setPaymentStatus',
                    ],
                    $receiveData);
            }

Services are located in /src/Services/ 
More examples are located in /example/InterfaceExample/

Implementation via Interfaces
------------------------------

Second way how to connect your shop by HCAPI is via Interfaces. In folder /scr/Interfaces/ is located interface IShopImplementation.php.
You must implement this interface for all classes which work with data from Heureka.

Example:
    
    class OrderCancel implements IShopImplementation
    {
        /**
         * @param array $receiveData
         *
         * @return array
         */
        public function getResponse($receiveData)
        {
            //Do something with receive data
    
            return [
                'status' => true,
            ];
        }
    
    }
    
In second step you must connect this functions to your routing. You must use specific service for every from API methods.
For example **Order/Cancel**:

    if ($_SERVER['REQUEST_URI'] === 'https://www.example.com/api/1/order/cancel') {
        $service = new OrderCancel();
        $orderCancel = new \Hcapi\Example\InterfaceExample\OrderCancel();

        return $service->processData($orderCancel, $receiveData);
    }

More examples are located in /example/CallableExample/
