This is a list of several code considerations as they accumulated over time, not specifically organized or sorted:

* Avoid referencing classes by string. Use ClassName::class syntax everywhere instead. Reason: refactoring,
  type-hinting, IDE autocompletion, typo avoidance, easy searching, better namespace usage

* Avoid using strings to reference anything, where alternatives can be considered or created. They provide better 
  refactoring capabilities, typo avoidance, easier searching (avoiding false positives), et ce-tera.

* Instantiate classes by Laravel's IoC container, instead of "new". Reason: any class can now use DI.
  See https://code.tutsplus.com/tutorials/digging-in-to-laravels-ioc-container--cms-22167 for details.
  Example: (avoid: ``)
  ```php
  class Product {
      public function __construct(Product $product)
      {
          $this->product = product;
      }
  }
  
  $stock = $this->app->make(Stock::class);
  // Avoid usually (may not always be possible or desirable), especially with unregistered classes:
  // $stock = $this->app->make('Stock');
  ```
  
* Do not use interfaces early nor everywhere. Only use, when the need arises or when it's known, that there will be 
  more than one implementation, or when a class is composed by "concerns" (behaviours).

* Avoid defining values, lists with values, magic values and anything similar in classes/code. They can almost always
  be extracted either in a separate class, in constants, an enum, into configuration or somewhere else (example
  EnvironmentServiceProvider.php uses config, early version had properties). The class or code benefits from it as it
  becomes more generic and may be easier re-used, as well changes are not required deep in but in places more expected
  (ie. config). code. An additional benefit of this can be, that - especially magic values - are not hidden deep inside
  code and are also better described what they represent. If a change is required, all places utilizing the values will 
  be easily modified, instead of missed places. Enums will also provide additional static analysis or
  IDE-specific benefits.

* Make use of advanced bindings and rebinding, where it seems appropriate.
  See https://code.tutsplus.com/tutorials/digging-in-to-laravels-ioc-container--cms-22167 for further explanations and
  examples.

