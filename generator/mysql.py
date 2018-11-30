def add_configuration(compose, config):
    mysql_hosts = []
    for version in config['versions']:
        port = config['versions'][version]
        host = 'mysql_'+version.replace('.', '')
        mysql_hosts.append(host)

        compose['services'][host] = {
            'build': {
                'context': 'docker/mysql',
                'args': { 'VERSION': version }
            },
            'volumes': [
                './var/mysql/%s:/var/lib/mysql' % (version)
            ],
            'ports': [
                '%d:3306' % (port)
            ],
        }

    compose['services']['phpmyadmin']['links'] = mysql_hosts
    compose['services']['phpmyadmin']['environment']['PMA_HOSTS'] = ','.join(mysql_hosts)
