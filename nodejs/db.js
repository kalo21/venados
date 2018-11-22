var mysql = require('mysql');
const dbfunctions = {};

var con = mysql.createConnection({
    host: "Pespeciales.upsin.edu.mx",
    user: "pt1v3n2d0s",
    password: "L4ti9o5s",
    database: "venadospruebas"
  });

function insertPedido(data, fn){
      var sql = `INSERT INTO pedidos (idempresa, idusuario, total, estatus) VALUES ('${data.idEmpresa}', '${data.idUsuario}', '${data.total}', 'Solicitado')`;
      con.query(sql, function (err, result) {
        if (err) throw err;
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
        if (err) throw err;
            var sqlSaldo = `UPDATE clientes, usuarios SET    saldo = saldo - ${data.total} WHERE id_usuario = ${data.idUsuario} AND    clientes.id_usuario = usuarios.id`;
            con.query(sqlSaldo, function (err, result) {
            if (err) throw err;
                console.log("se le desconto al prro");
            });
        });
      });
    
    /*
    var sql = `insert into pedidos (idempresa, idusuario, total, estatus) values ('${data.idEmpresa}', '${data.idUsuario}', '${data.total}', 'Solicitado')`;
    con.connect(sql,function(err, result) {
        if (err) throw err;
        //var lastID = result.insertId;
        console.log("id Insertado: "+result.insertId);
    });

     Example
    var sql = "INSERT INTO customers (name, address) VALUES ('Company Inc', 'Highway 37')";
    con.query(sql, function (err, result) {
    if (err) throw err;
    console.log("1 record inserted");
  });*/
}
function cancelarPedido(idPedido){
    var sql = `UPDATE pedidos SET estatus = 'Cancelado' WHERE pedidos.id = ${idPedido}`;
    con.query(sql, function (err, result) {
    if (err) throw err;
    console.log("1 record inserted");
  });
}

//dbfunctiosn es el objeto que se exporta para poder ser usado en server.js
//Asi que si se agrega una función debe ser agregada a la variable dbfunctions
dbfunctions.insertPedido = insertPedido;
dbfunctions.cancelarPedido = cancelarPedido;
module.exports = dbfunctions;

