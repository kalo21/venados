var mysql = require('mysql');
var config = require('./config.js');
var con = mysql.createConnection(config.dbConfig);

con.connect(function(err) {
    if (err) console.log("Error al conectar con la base de datos");
    else{
        console.log("Connected!");
    }

});
function insertPedido(data, callback){
    con.beginTransaction(function(err) {
        if (err) { 
            con.end();   
            return callback(false) 
        }
        var sql = `INSERT INTO pedidos (idempresa, idusuario, total, estatus) VALUES ('${data.idEmpresa}', '${data.idUsuario}', '${data.total}', 'Solicitado')`;
        con.query(sql, function (err, result) {
        if(err) {
            con.end();   
            return callback(false);
        }
        var lastId = result.insertId;
        var detalles = [];
        var dtlSql = "INSERT INTO detallepedidos (idpedido, idproducto, precio, cantidad) VALUES ?";

        for (var i = 0; i < data.pedido.length; i++) {
            var detail = [  lastId,
                            data.pedido[i].producto.id,
                            data.pedido[i].producto.precio,
                            data.pedido[i].cantidad];
            detalles.push(detail);
        }
        con.query(dtlSql, [detalles], function (err, result) {
            if(err) {
                con.end();      
                return callback(false);
            }
            var sqlSaldo = `UPDATE clientes, usuarios SET saldo = saldo - ${data.total} WHERE id_usuario = ${data.idUsuario} AND    clientes.id_usuario = usuarios.id`;
            con.query(sqlSaldo, function (err, result) {
                    if(err) {
                        con.rollback(function(){
                            console.log("No se pudo hacer rollback")
                        })
                        callback(false);
                    }
                    else if(result){
                        con.commit(function(err){
                            if(err){
                                callback(false);
                            }
                            else{    
                                callback(true);
                            }
                        })
                    }
                    con.end();   
                });
            });
        });
    })
}
function cancelarPedido(data, callback){
    con.beginTransaction(function(err) {
        if(err){
            con.end();   
            return callback(false);
        }
        var sql = `UPDATE pedidos SET estatus = 'Cancelado' WHERE pedidos.id = ${data.idPedido} AND estatus = 'Solicitado'`;
        con.query(sql, function (err, result) {
            if(err){
                con.end();   
                return callback(false);
            }
            var sql2 = `UPDATE clientes SET saldo = saldo + ${data.total} WHERE id = ${data.usuario}`;
            con.query(sql2, function (err, result) {
                if(err) {
                    con.rollback();
                    callback(false);
                }
                else if(result){
                    con.commit(function(err){
                        if(err){
                            callback(false);
                        }
                        else{
                            callback(true);
                        }
                    })
                }
                con.end(); 
            });     
        });
    });
}

//dbfunctiosn es el objeto que se exporta para poder ser usado en server.js
//Asi que si se agrega una función debe ser agregada a la variable dbfunctions
var dbfunctions = [];
dbfunctions.insertPedido = insertPedido;
dbfunctions.cancelarPedido = cancelarPedido;
module.exports = dbfunctions;

