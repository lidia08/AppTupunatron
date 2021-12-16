const mysql = require('mysql');
const mqtt = require('mqtt');
var con = mysql.createConnection({

    host: "localhost", 
    user: "root",//  "tupunat1_root",// "root",
    password: "",// "2021tupunat1_bd",//"",
    database: "tt_basedatos"// "tupunat1_tt_basedatos"//"tt_basedatos"

});

con.connect(function(err){  

    if (err) throw err;
    console.log("Conexion a MySql OK");
});

var options = {

    port: 8083,
    host: '35.199.82.78',
    clientId: 'Mqtt_node',
    username:'equipo1',
    password: '123456789',
    keeplive: 60,

}

var client = mqtt.connect("ws://35.199.82.78:8083/mqtt",options);

client.on('connect',function(){

    console.log("Conexión al MQTT");

    client.subscribe('+/#',function(err){

        console.log("Suscripción Exitosa");
        
    })

});

client.on('message', function (topic, message) {
    console.log("Mensaje recibido desde -> " + topic + "\n Mensaje -> " + message.toString());
    
    if (topic == "/equipo1/pesaje"){

        setTimeout(function(){

            var msg = message.toString();
            var sp = msg.split("/");

            var GNUM = parseInt(sp[0]);
            var GRWG = parseInt(sp[1]);
            var TRWG = parseInt(sp[2]);
            var NTWG = parseInt(sp[3]);
            var GRTO = parseInt(sp[4]);
            var TRTO = parseInt(sp[5]);
            var NTTO = parseInt(sp[6]);

            console.log(msg);
            
            con.query("INSERT INTO `pesaje` (`id_pesaje`, `num_grupo`, `peso_bruto`, `peso_tara`, `peso_neto`, `bruto_total`, `tara_total`, `neto_total`, `fecha`) VALUES (NULL, '"+GNUM+"', '"+GRWG+"', '"+TRWG+"', '"+NTWG+"', '"+GRTO+"', '"+TRTO+"', '"+NTTO+"', current_timestamp())", function (err, result){

                if (err) {
                    console.log("err:", err);
                } else {
                    console.log(result);
                } 
            });

        }, 500);
    }

});