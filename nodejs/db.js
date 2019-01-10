var mysql = require('mysql');
var config = require('./config.js');
var con;
/**
 * Para conecar y recuperar la conexión si se cae.
 */
function handleDisconnect() {
    con = mysql.createConnection(config.dbConfig); // Recreate the connection, since
                                                    // the old one cannot be reused.
  
    con.connect(function(err) {              // The server is either down
      if(err) {                                     // or restarting (takes a while sometimes).
        console.log('error when connecting to db:', err);
        setTimeout(handleDisconnect, 2000); // We introduce a delay before attempting to reconnect,
      }                                     // to avoid a hot loop, and to allow our node script to
      else{
        console.log('Conectado')
      }                                     
    });                                     // process asynchronous requests in the meantime.
                                            // If you're also serving http, display a 503 error.
    con.on('error', function(err) {
      console.log('db error', err);
      if(err.code === 'PROTOCOL_CONNECTION_LOST' || err.code === 'ECONNRESET') { // Connection to the MySQL server is usually
        handleDisconnect();                         // lost due to either server restart, or a
      } else {                                      // connnection idle timeout (the wait_timeout
        throw err;                                  // server variable configures this)
      }
    });
  }
  
  handleDisconnect();

function insertPedido(data, callback){
        con.beginTransaction(function(err) {
        if (err) { 
            console.log(err)
            return callback(false) 
        }
        var sql = `INSERT INTO pedidos (idempresa, idusuario, total, estatus) VALUES ('${data.idEmpresa}', '${data.idUsuario}', '${data.total}', 'Solicitado')`;
        con.query(sql, function (err, result) {
        if(err) {
            console.log(err)
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
                return callback(false);
            }
            var sqlSaldo = `UPDATE clientes, usuarios SET saldo = saldo - ${data.total} WHERE id_usuario = ${data.idUsuario} AND clientes.id_usuario = usuarios.id`;
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
                    
                });
            });
        });
    })
}
function cancelarPedido(data, callback){
    con.beginTransaction(function(err) {
        if(err){
            return callback(false);
        }
        var sql = `UPDATE pedidos SET estatus = 'Cancelado' WHERE pedidos.id = ${data.idPedido} AND estatus = 'Solicitado'`;
        con.query(sql, function (err, result) {
            if(err){
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

