var mysql = require('mysql');
const dbfunctions = {};

var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: ""
  });

function insertPedido(){
    con.connect(function(err) {
        if (err) throw err;
        //console.log("Connected!");
    });
    /* Example
    var sql = "INSERT INTO customers (name, address) VALUES ('Company Inc', 'Highway 37')";
    con.query(sql, function (err, result) {
    if (err) throw err;
    console.log("1 record inserted");
  });*/
}

//dbfunctiosn es el objeto que se exporta para poder ser usado en server.js
//Asi que si se agrega una función debe ser agregada a la variable dbfunctions
dbfunctions.insertPedido = insertPedido;
module.exports = dbfunctions;

