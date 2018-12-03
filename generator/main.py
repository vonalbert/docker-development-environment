import json, os, shutil
import phpmyadmin, pgadmin, mysql, postgres

root = os.path.normpath(os.path.dirname(__file__) + '/../')
confile = root + '/config.json'

if not os.path.exists(confile):
    print '- Configuration file %s not found' % (confile)
    shutil.copyfile(confile + '.dist', confile)
    print '- Default configuration copied from %s.dist' % (confile)

with open(confile, 'r') as fp:
    config = json.load(fp)

compose = {
    'version': '3.7',
    'services': {},
}

phpmyadmin.add_configuration(compose, config['phpmyadmin'])
pgadmin.add_configuration(compose, config['pgadmin'])
mysql.add_configuration(compose, config['mysql'])
postgres.add_configuration(compose, config['postgres'])


outfile = root + '/docker-compose.json'
with open(outfile, 'w') as fp:
    json.dump(compose, fp)
    print '- Docker Compose configuration generated at %s' % (outfile)
