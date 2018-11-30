def add_configuration(compose, config):
    pg_hosts = []
    for version in config['versions']:
        port = config['versions'][version]
        host = 'pgsql_'+version.replace('.', '')
        compose['services'][host] = {
            'build': {
                'context': 'docker/postgres',
                'args': { 'VERSION': version }
            },
            'volumes': [
                './var/postgres/%s:/var/lib/postgresql/data' % (version)
            ],
            'ports': [
                '%d:5432' % (port)
            ],
        }

    compose['services']['pgadmin']['links'] = host
