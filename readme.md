# Secure Console Statamic Addon

This statamic addon performs the following two actions:

1. Make the statamic control panel `/cp` inaccessible on *production* sites.
2. Make the site content inaccessible to unauthorized users on *non-production* sites.

Production sites are indicated by adding the following variable to the `.env` file in the site root.

    APP_ENV=production

