import json
import os

from config import config
import phpmyadmin, pgadmin, mysql, postgres


compose = {
    'version': '3.7',
    'services': {},
}

phpmyadmin.add_configuration(compose, config['phpmyadmin'])
pgadmin.add_configuration(compose, config['pgadmin'])
mysql.add_configuration(compose, config['mysql'])
postgres.add_configuration(compose, config['postgres'])


with open(os.path.dirname(__file__)+'/../docker-compose.json', 'w') as outfile:
    json.dump(compose, outfile)
