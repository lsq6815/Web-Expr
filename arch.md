# Architecture

## Login with user/pass

login.js -> validate.php -> login.js -> login.php

## Login with phone/sms

get_code.js -> validate_phone.php -> get_code.js -> login.php

```
.
├── arch.md            # describe project architecture
├── images             # store images
├── index.html         # for pass/user login
├── index_phone.html   # for phone/sms login
├── login.php          # final login in page, verify login status via SESSION
├── README.md          # readme file
├── scripts
│   ├── eye.js         # anime for show password as plain text of dots
│   ├── get_code.js    # process phone/sms login
│   ├── login.js       # process user/pass login
│   └── slides.js      # anime for slides
├── styles
│   ├── base.css       # base.css
│   └── style.css      # true CSS file
├── sync.sh            # sync project to /var/www/html
├── validate_phone.php # process phone/sms login
├── validate.php       # process user/sms login
└── Web-Expr.pdf       # Expr requirements
```
