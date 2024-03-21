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


### Author notes:
    - Scope for attribute was not specified (if store, website)
    - di.xml range could be restriced to webapi area, however not specified in task if frontend access
    -  <resource ref="anonymous"/> could be restricted for example only for registered users, but also not specified in task.
    - API configuration assumed to be global
    - According to task description module allows to change only attribute which was added here.

