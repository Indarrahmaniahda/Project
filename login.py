from flask import Flask, redirect, url_for, session
from authlib.integrations.flask_client import OAuth

app = Flask(__name__)
app.secret_key = 'your_secret_key'  # Ganti dengan kunci rahasia yang aman
oauth = OAuth(app)

# Konfigurasi OAuth untuk Google
oauth.register(
    name='google',
    client_id='329500161153-3ah68d5lk3gedbfoevvmel0a9vb0dopu.apps.googleu',         # Ganti dengan ID Klien Google Anda
    client_secret='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', # Ganti dengan Rahasia Klien Google Anda
    authorize_url='https://accounts.google.com/o/oauth2/auth',
    authorize_params=None,
    authorize_params=None,
    token_url='https://accounts.google.com/o/oauth2/token',
    client_kwargs={'scope': 'openid profile email'},
)

@app.route('/login')
def login():
    return oauth.google.authorize_redirect(redirect_uri=url_for('auth', _external=True))

@app.route('/auth')
def auth():
    token = oauth.google.authorize_access_token()
    user = oauth.google.parse_id_token(token)
    # Lakukan sesuatu dengan data pengguna, seperti menyimpannya dalam database
    return 'Logged in as: ' + user['name']

if __name__ == '__main__':
    app.run()
