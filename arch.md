# Architecture

## Login with user/pass

login.js -> validate.php -> login.js -> login.php

## Login with phone/sms

get_code.js -> validate_phone.php -> get_code.js -> login.php

```bash
.
├── account_delete.php  # for account delete(extra)
├── arch.md             # describe project architecture
├── change_account.php  # for account change(extra)
├── images              # store images
├── index.html          # for user/pass login
├── index_phone.html    # for phone/sms login
├── login.php           # final login page, check login status via token
├── lookup.html         # front-end for account lookup(extra)
├── lookup.php          # back-end for account lookup(extra)
├── new_user.html       # front-end for account add(extra)
├── new_user.php        # back-end for account add(extra)
├── password_change.php # for password change(extra)
├── README.md           # readme file
├── scripts
│   ├── eye.js          # anime for display password as plain text or dots
│   ├── get_code.js     # for phone/sms login
│   ├── login.js        # for user/pass login
│   ├── lookup.js       # for account lookup(extra)
│   ├── send_code.js    # for account add(extra)
│   └── slides.js       # anime for slides
├── styles
│   ├── base.css        # base.css
│   └── style.css       # true CSS file
├── sync.sh             # sync project to /var/www/html
├── validate_phone.php  # back-end for phone/sms login
├── validate.php        # back-end for user/pass login
└── Web-Expr.pdf        # Expr requirements
```
