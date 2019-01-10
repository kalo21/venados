var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var db = require ('./db.js');
var config = require('./config.js');
var jwt = require('jsonwebtoken');
var empresas = [];

//Se pasa el directorio de donde se va a usar express.
app.use(express.static('public'));
app.use(function (req, res, next) {
    var token = req.headers['Authorization'];
    if (token) {
        jwt.verify(token, config.jwtSecretKey, function (err, decoded) {
            if (err) {
                return res.json({
                    success: false,
                    message: 'Failed to authenticate token.'
                });
            } else {
                req.user = decoded;
                next();
            }
        });
    }
    else{
        return res.json({
            success: false,
            message: 'Failed to authenticate token.'
        }); 
    }
});
//Cuando reciba un get en la ruta raiz
app.get('/', function(req, res){
    //Retorna un status 200 con el mensaje "Hola mundo"
    res.status(200).send("Hello world")
});

io.on("connection", function(socket){
    console.log("Alguien se ha conectado con sockets: "+socket.id);
    /**
     * Función para enviar un pedido a la empresa
     */
    socket.on('send-pedido',function(data){
        
    });

    socket.on('add-pedido',function(data, callback){
        db.insertPedido(data, function(res){
            if(!res){
                callback(false);
            } 
            else{
                callback(true);
                updateStore(data);
            }
        });
    });

    socket.on('cancelar-pedido',function(data, callback){
        db.cancelarPedido(data, function(res){
            if(!res){
                callback(false);
            } 
            else{
                callback(true);
                updateStore(data);
            }
        });
    });

    /**
     * Esta función es para agregar un usuario.
     */
    socket.on('add-user',function(data){
        var empresa = {
            idEmpresa: data.idEmpresa,
            idSocket: socket.id
        };
        empresas.push(empresa);
        console.log(empresas);
    });

    socket.on('disconnect', (reason) => {
        console.log("Alguien se ha desconectado");
        for(var x = 0; x < empresas.length; x++){
            if(empresas[x].idSocket == socket.id){
                empresas.splice(x,1);
                break;
            }
        }
    });
});
   
function updateStore(data){
    for(var x = 0; x < empresas.length; x++){
        if (empresas[x].idEmpresa == data.idEmpresa){
            io.sockets.connected[empresas[x].idSocket].emit("pedido", data);
        }
    }
}
server.listen(3006, function(){
    console.log("Servidor corriendo en http://localhost:3006")
})  
