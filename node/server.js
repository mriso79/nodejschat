/**
 * Created by @mriso_dev on 21/11/16.
 * node server
 */
var app = require('express')();

/*

// THOSE ARE FOR SECURE HTTPS VERSION

var fs = require('fs');

var pkey = fs.readFileSync('/etc/ssl/private/your.key');
var pcert = fs.readFileSync('/etc/ssl/certs/yourcertificate.crt')

var options = {
    key: pkey,
    cert: pcert
};


var http = require('https').Server(options, app);
*/

var http = require('http').Server(app);

var io = require('socket.io')(http);

app.get('/', function(req, res){
    res.send('<span style="color: green">My Chat server 1.0</span>');
});

io.on('connection', function(socket){

    var room = socket.handshake['query']['r_var'];

    socket.join(room);

    socket.on('disconnect', function() {
        socket.leave(room);
    });

    socket.on('chat message', function(msg){
        io.to(room).emit('chat message', msg);
    });

});

http.listen(3000, function(){
    console.log('listening on *:3000');
});