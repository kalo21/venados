var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var db = require ('./db.js');
var clients = {};

//Se pasa el directorio de donde se va a usar express.
app.use(express.static('public'));
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
        //db.insertPedido(data.algo)

        //Si el receptor existe
        if (clients[data.idEmpresa]){
            io.sockets.connected[clients[data.idEmpresa]].emit("pedido", data);
            //socket.disconnect();
        }
        //Si no existe el receptor
        else{
            console.log("User does not exist: " + data.idEmpresa); 
            //socket.disconnect();
        }
    });

    socket.on('add-pedido',function(data, fn){
        db.insertPedido(data, fn);
        console.log(data.idEmpresa);
        console.log(clients);
        //Si el receptor existe
        if (clients[data.idEmpresa]){
            io.sockets.connected[clients[data.idEmpresa]].emit("pedido", data);
            //socket.disconnect();
            fn(true);
        }
        //Si no existe el receptor
        else{
            fn("No se encontró la tienda");
            //socket.disconnect();
        }
    });

    socket.on('cancelar-pedido',function(data, fn){
        console.log("IDEMPRESA: "+data.idEmpresa);

        db.cancelarPedido(data.idPedido);
        //Si el receptor existe
        console.log(clients);
        console.log(clients[data.idEmpresa]);
        if (clients[data.idEmpresa]){
            io.sockets.connected[clients[data.idEmpresa]].emit("pedido", data);
            fn(true);
            //socket.disconnect();
        }
        //Si no existe el receptor
        else{
            fn("No se encontró la tienda");
            //socket.disconnect();
        }
    });

    /**
     * Esta función es para agregar un usuario.
     */
    socket.on('add-user',function(data){
        clients[data.idEmpresa] = socket.id;
        console.log(clients);
    });

    socket.on('disconnect', (reason) => {
        console.log("A client disconnected. "+socket.id);
        var length = Object.keys(clients).length;
        for( var key in clients ) {
            if(socket.id == clients[key]){
                delete clients[key];
            }
        }
    })
});

server.listen(3000, function(){
    console.log("Servidor corriendo en http://localhost:3000")
})  
