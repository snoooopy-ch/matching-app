'use strict';

const Express = require('express');
const cors = require('cors');
const router = require('./lib');
const https = require('https');
// const http = require('http');
const fs = require("fs");

const app = Express();
const port = process.env.PORT || 5000;

app.use(cors());
app.use('/api/', router);

const key = fs.readFileSync('/etc/letsencrypt/live/machiapp.com/privkey.pem');
const cert = fs.readFileSync('/etc/letsencrypt/live/machiapp.com/fullchain.pem');

const server = https.createServer({key, cert}, app);
// const server = http.createServer(app);

server.listen(port, function() {
   console.log('Server started on port', port);
});
