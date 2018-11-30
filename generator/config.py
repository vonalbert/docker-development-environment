config = {
    'mysql': {
        'versions': {
            '5.5': 33060,
            '5.7': 33061,
            '8.0': 33062,
        }
    },

    'postgres': {
        'versions': {
            '9.6': 54320,
            '10.0': 54321,
        }
    },

    'phpmyadmin': {
        'port': 8081
    },

    'pgadmin': {
        'port': 8082,
        'email': 'info@example.com',
        'password': 'password'
    }
}


def pippo():
    print('ciao')
