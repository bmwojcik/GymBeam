# GymBeam Recruitment Task

### Description

This module is responsible for integration with custom `gymbeam_attribute` change.

Configuration is available `Stores > GymBeam > General`

### Usage 

POST  example `https://magento.test/rest/V1/gymbeam-attribute` with JSON body
`{
    "value" : "asdxmmecccc",
    "productId": 1
}`

Test 
`vendor/phpunit/phpunit/phpunit -c dev/tests/unit/phpunit.xml.dist app/code/GymBeam/App/Test/Unit/`

### Author notes:
    - di.xml range could be restriced to webapi_rest area, however not specified in task if other area has access access (for example cron, adminhtml)
    -  <resource ref="anonymous"/> could be restricted for example only for registered users, but also not specified in task.
    - API configuration assumed to be global, aswell as attriubute configuration. In live example it should be specified
      if attribute is scope global, and API Endpont could have additional parameter for store_id.
    - According to task description module allows to change only attribute which was added here.

