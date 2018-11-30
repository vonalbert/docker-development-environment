def add_configuration(compose, config):
    compose['services']['phpmyadmin'] = {
        'image': 'phpmyadmin/phpmyadmin',
        'ports': [
            '%d:80' % config['port']
        ],
        'environment': {
            'PMA_ARBITRARY': '1',
            'PMA_USER': 'root',
            'PMA_PASSWORD': 'password',
        },
    }