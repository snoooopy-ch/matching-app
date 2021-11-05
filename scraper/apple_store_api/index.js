const express = require("express");
const cors = require('cors');
const app = express();
const router = require('./router');
const fs = require("fs");
const https = require('https');
// const http = require('http');

const port = process.env.PORT || 5001;

app.use(cors());
app.use('/api/', router);

const key = fs.readFileSync('/etc/letsencrypt/live/machiapp.com/privkey.pem');
const cert = fs.readFileSync('/etc/letsencrypt/live/machiapp.com/fullchain.pem');

const server = https.createServer({key, cert}, app);
// const server = http.createServer(app);

server.listen(port, function () {
    console.log('Server started on port', port);
});
