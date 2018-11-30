def add_configuration(compose, config):
    compose['services']['pgadmin'] = {
        'image': 'dpage/pgadmin4',
        'volumes': [
            './var/pgadmin:/var/lib/pgadmin',
        ],
        'ports': [
            '%d:80' % config['port']
        ],
        'environment': {
            'PGADMIN_DEFAULT_EMAIL': config['email'],
            'PGADMIN_DEFAULT_PASSWORD': config['password'],
        },
    }
