from os import environ

'''
VERIFY_REMOTE_IP should be True if you want to include the client ip address in the verification step.
'''
VERIFY_REMOTE_IP = False

def config(app):
    '''
    RECAPTCHA_SECRET is the secret key provided to you by Google for reCaptcha
    You may either set the RECAPTCHA_SECRET env variable or save it here in this file
    '''
    app.config['RECAPTCHA_SECRET'] = environ.get('RECAPTCHA_SECRET', '6LcZ20AUAAAAAI5DGdW2NP0SArrCXttqIGDR_V2T')

    '''
    RECAPTCHA_SITE_KEY is the public site key provided to you by Google for reCaptcha
    Needed if `RECAPTCHA_INSERT_TAGS` is True
    You may either set the RECAPTCHA_SITE_KEY env variable or save it here in this file
    '''
    app.config['RECAPTCHA_SITE_KEY'] = environ.get('RECAPTCHA_SITE_KEY', '6LcZ20AUAAAAAK_2YasnP1CVU0SMtdgdvLZS9UFq')

    '''
    RECAPTCHA_INSERT_TAGS determines if the plugin should automatically attempt to insert tags (i.e. the script and check box)
    This works well if the registration template is not heavily modified, but set this to false if you want to control where the
    check box appears
    '''
    app.config['RECAPTCHA_INSERT_TAGS'] = True


    if VERIFY_REMOTE_IP:
        app.config['RECAPTCHA_VERIFY_URL'] = 'https://www.google.com/recaptcha/api/siteverify?secret={secret:s}&response={response:s}&remoteip={remoteip:s}'
    else:
        app.config['RECAPTCHA_VERIFY_URL'] = 'https://www.google.com/recaptcha/api/siteverify?secret={secret:s}&response={response:s}'
