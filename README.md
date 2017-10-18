API dictionary

###development

  1. git clone https://<username>@bitbucket.org/deX_team/erevna-dictionary-php.git

  2. install composer https://getcomposer.org/doc/00-intro.md

  3. git clone https://<username>@bitbucket.org/deX_team/erevna-dictionary-php.git

  4. cd erevna-dictionary-php

  5. composer install

###deploy

  deploy di mesin elasticsearch

###Endpoint

  - /index.php?text=apt&trxunixtime=423232&country=id&keyfrom=dictionaryPropertycategory

    response:

      {"status":true,"text":"apt","meaning":"apartment","trxunixtime":"423232","country":"id"}

  e.g:

    http://51.15.12.153:4002/index.php?text=rmassss&trxunixtime=423232&country=id&keyfrom=dictionaryPropertycategory
