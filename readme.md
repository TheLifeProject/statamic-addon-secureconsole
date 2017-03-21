# Secure Console Statamic Addon

This statamic addon performs the following two actions:

1. Make the statamic control panel `/cp` inaccessible on *production* sites.
2. Make the site content inaccessible to unauthorized users on *non-production* sites.

Production sites are indicated by adding the following variable to the `.env` file in the site root.

    APP_ENV=production

For canonical `<head>` information to be properly included, you must also include the following in your `.env` file.

    APP_BASE_URI=https://your-public-domain.com
    
This will cause the software to point any search engines to the correct URL for the public site.

## Intended Use Case

This addon is intended to be run on statamic installations where the management of the site data (editing
content and the like) is done on a secondary domain such as dev.domain.com. This dev domain can be watched for changes, 
and when changes are published can have the files committed to git and subsequently deployed to the production 
server(s).

Running the site in this way allows for some administrative security, as well as ease of site deployment to multiple
production endpoints.
   
### Followup Notes:

- Please post any issues you experience to 
  https://github.com/TheLifeProject/statamic-addon-secureconsole/issues
  
- Feature requests and suggestions are welcome.
  
- This software package comes with no warranty either stated or implied.
  We do our best to ensure it functions well, but ultimately you use it 
  at your own risk.